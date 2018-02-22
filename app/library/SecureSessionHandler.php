<?php

class SecureSessionHandler  {

  protected $key, $name, $cookie;

  public function __construct($key, $name = 'MY_SESSION', $cookie = array()) {
    $this->key = $key;
    $this->name = $name;
    $this->cookie = $cookie;
    $this->cookie=array(
      'lifetime' => 0,
      'path' => ini_get('session.cookie_path'),
      'domain' => ini_get('session.cookie_domain'),
      'secure' => isset($_SERVER['HTTPS']),
      'httponly' => true
    );
    $this->setup();
  }

  private function setup() {
    ini_set('session.use_cookies', 1);
    ini_set('session.use_only_cookies', 1);
    session_name($this->name);
    }

    public function start() {
      if (session_id() === '') {
        if (session_start()) {
          return mt_rand(0, 4) === 0 ? $this->refresh() : true; // 1/5
        }
      }
      return false;
    }

    public function forget() {
      if (session_id() === '') {
        return false;
      }
      $_SESSION = array();
      setcookie(
        $this->name, '', time() - 42000, $this->cookie['path'], $this->cookie['domain'], $this->cookie['secure'], $this->cookie['httponly']
      );
      return session_destroy();
    }

    public function refresh() {
      return session_regenerate_id(true);
    }

    public function read($id) {
      return mcrypt_decrypt(MCRYPT_3DES, $this->key, parent::read($id), MCRYPT_MODE_ECB);
    }

    public function write($id, $data) {
      return parent::write($id, mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB));
    }

    public function isExpired($ttl = 30) {
      $last = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;
      if ($last !== false && time() - $last > $ttl * 60) {
        return true;
      }
      $_SESSION['_last_activity'] = time();
      return false;
    }

    public function isFingerprint() {
      $hash = md5(
        $_SERVER['HTTP_USER_AGENT'] .
        (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
      );
      if (isset($_SESSION['_fingerprint'])) {
        return $_SESSION['_fingerprint'] === $hash;
      }
      $_SESSION['_fingerprint'] = $hash;
      return true;
    }

    public function isValid() {
      return !$this->isExpired() && $this->isFingerprint();
    }

    public function get($name) {
      $parsed = explode('.', $name);
      $result = $_SESSION;
      while ($parsed) {
        $next = array_shift($parsed);
        if (isset($result[$next])) {
          $result = $result[$next];
        } else {
          return null;
        }
      }
      return $result;
    }

    public function put($name, $value) {
      $parsed = explode('.', $name);
      $session = & $_SESSION;
      while (count($parsed) > 1) {
        $next = array_shift($parsed);
        if (!isset($session[$next]) || !is_array($session[$next])) {
          $session[$next] = array();
        }
        $session = & $session[$next];
      }
      $session[array_shift($parsed)] = $value;
    }

  }
  /*
  $session = new SecureSessionHandler('cheese');
  ini_set('session.save_handler', 'files');
  session_set_save_handler($session, true);
  session_save_path(__DIR__ . '/sessions');
  $session->start();
  if (!$session->isValid(5)) {
  $session->destroy();
}
$session->put('hello.world', 'bonjour');
echo $session->get('hello.world'); // bonjour*/
