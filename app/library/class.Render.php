<?php

class Render extends Influx {

    public $menu_itens = array();

    public $settings;

    public $sliders;

    public $text;

    /* Function para compilar o template junto com os parametros */

    public function template($template = null, $parameters = null) {

        if (count($parameters) > 1):
            $templatePath = $parameters["templatePath"];
        else:
            $templatePath = $parameters;
        endif;

        $twigloader = new Twig_Loader_Filesystem('../src/Bundles/Resources/views');
        $twig = new Twig_Environment($twigloader, array(
            'cache' => '../src/Bundles/Cache/',
            'debug' => true,
            'auto_reload' => true
        ));

        $twig->addExtension(new Twig_Extension_Debug());
        $twig->addFilter(new Twig_SimpleFilter('ebase64', 'base64_encode'));
        $twig->addFilter(new Twig_SimpleFilter('dbase64', 'base64_decode'));

        $twig->addFunction(new Twig_SimpleFunction('asset', function ($asset) {
            return sprintf(SitePath . '%s', ltrim($asset, '/'));
        }));

        $twig->addFunction(new Twig_SimpleFunction('path', function ($path) {
            return sprintf(Site . '%s', ltrim($path, '/'));
        }));

        $twig->addFunction(new Twig_SimpleFunction('nomemes', function ($mes) {
            return FiltersClass::mespornumero((int) $mes);
        }));

        $session = new SecureSessionHandler(__PHP_KEY_COOKIE);


        if (!empty($template)):

            print $twig->render($template, array(
                        'route' => $this->route(),
                        'referer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
                        'path_route' => substr($_SERVER['REQUEST_URI'], 1),
                        'selfChannel' => $this->returnParentAction(),
                        'settings' => $this->loadSettings(),
                        'user_site_authenticate' => $session->get('__fingerKey.data'), //isset($_SESSION[__PHP_KEY_COOKIE]['__SESSION_USERSITE_AUTHENTICATE_USERSITEDATA']) ? $_SESSION[__PHP_KEY_COOKIE]['__SESSION_USERSITE_AUTHENTICATE_USERSITEDATA'] : NULL,
                        'REQUEST' => isset($_REQUEST) ? $_REQUEST : NULL,
                        'Recordset' => isset($parameters["Recordset"]) ? $parameters["Recordset"] : '',
                        'attrib' => $this->getGUID(),
//                        'feed' => $this->feedAction(),
                        'menu' => $this->loadMenuStructure(1),
                        'fnews' => $this->loadFooterNews(),
                        'setFlash' => isset($parameters["setFlash"]) ? $parameters["setFlash"] : '',
            ));

        else:

            header("Location: " . self::path() . "/");

        endif;
    }

    /*
     * LOAD ERRORS CONTROLLERS
     */

    public function ErrorAction($numError = false) {
        switch ($numError):
            case 505:
                self::renderTwigTemplate('404.html.twig', 'Erro', array('Message' => 'Rota não definida.', 'link' => '/'));
                self::renderTwigTemplate('404.html.twig', 'Erro', array('Message' => 'Rota não definida.', 'link' => '/'));
                break;
        endswitch;
    }

    /*
     * LOAD FILTERS FUNCTIONS
     */

    public function path($args = false) {

        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        unset($scriptName[sizeof($scriptName) - 1]);
        $scriptName = array_values($scriptName);

        return 'http://' . $_SERVER['SERVER_NAME'] . implode('/', $scriptName) . '/' . $args;
    }

    public function assetPath($args = false) {

        return $this->path('assets/' . $args);
    }

    private function returnParentAction($arrPosition = null) {

        $arrPosition = $arrPosition ? $arrPosition : 0;

        $requestURI = explode('/', $_SERVER['REQUEST_URI']);
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        for ($i = 0; $i < sizeof($scriptName); $i++) {
            if ($requestURI[$i] == $scriptName[$i]) {
                unset($requestURI[$i]);
            }
        }
        $libmodule = array_values($requestURI);

        if ($arrPosition == 0 || empty($arrPosition)):

            return $libmodule[0];

        else:

            return $libmodule[$arrPosition][0];

        endif;
    }

    public function loadSettings() {

        $this->select()->from('dbo_application_settings')->where('id = 1')->execute();

        if ($this->check()):
            //$this->settings = $this->data[0];
            return $this->data[0];
        endif;
    }

    /*
     * Route /Noticias
     * @Param Feed RSS
     * */

    public function loadFooterNews() {
        $this->select()
                        ->from('dbo_application_content')
                        ->where('content_type = 2 and ___D_E_L_E_T_E_D___ = 0')
                        ->orderby('publicated_at desc')
                        ->limit(0,2)
                        ->execute();
        if ($this->check()):
            return $this->data;
        endif;

    }



    public function loadMenuStore($level = null) {

        switch ($level):
            case 1:
                $this->select('c.*, (SELECT COUNT(*) AS total FROM dbo_application_brands_group AS g WHERE g.id_category = c.id) AS subitens')
                        ->from('dbo_application_category as c')
                        ->where('c.___D_E_L_E_T_E_D___ = 0')
                        ->orderby('c.position ASC')
                        ->execute();
                if ($this->check()):
                    return $this->data;
                endif;

                break;
            case 2:
                $this->select('g.*, (SELECT COUNT(*) AS total FROM dbo_application_brands AS b WHERE b.id_bgroup = g.id) AS subitens')
                        ->from('dbo_application_brands_group as g')
                        ->where('g.___D_E_L_E_T_E_D___ = 0')
                        ->orderby('g.position ASC')
                        ->execute();
                if ($this->check()):
                    return $this->data;
                endif;

                break;
            case 3:
                $this->select()
                        ->from('dbo_application_brands')
                        ->where('___D_E_L_E_T_E_D___ = 0')
                        ->orderby('position ASC')
                        ->execute();
                if ($this->check()):
                    return $this->data;
                endif;

                break;

                return false;

        endswitch;
    }

    public function route() {

        $link = "//" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');

        return $escaped_link;
    }



    /*
     * Carrega Estrutura de Menu
     * */

    public function loadMenuStructure($id = null) {

        ## LOAD MENUS LEVEL 0
        $this->select()->from('dbo_application_channel')
                ->where('___D_E_L_E_T_E_D___ <> 1 AND level = 0 AND id_menu = ' . $id)
                ->orderby('position ASC')
                ->execute();

        if ($this->check()):

            $returnData = $this->data;

            ## LOAD MENUS LEVEL 1
            foreach ($returnData as $key => $value) {

                $this->select()->from('dbo_application_channel as c')
                        ->join('dbo_application_channel_relationship as r', 'c.id = r.id_filho', 'LEFT')
                        ->where('___D_E_L_E_T_E_D___ <> 1 AND r.id_pai = ' . $returnData[$key]['id'])
                        ->orderby('c.position ASC')
                        ->execute();

                if ($this->check()):

                    $returnData[$key]['subchannel'] = $this->data;

                    ## LOAD MENUS LEVEL 2
                    foreach ($returnData[$key]['subchannel'] as $k => $v) {

                        $this->select()->from('dbo_application_channel as c')
                                ->join('dbo_application_channel_relationship as r', 'c.id = r.id_filho', 'LEFT')
                                ->where('___D_E_L_E_T_E_D___ <> 1 AND r.id_pai = ' . $returnData[$key]['subchannel'][$k]['id_filho'])
                                ->orderby('c.position ASC')
                                ->execute();

                        if ($this->check()):
                            $returnData[$key]['subchannel'][$k]['subchannel0'] = $this->data;
                        endif;
                    }


                endif;
            }
           // print_r($returnData); exit;
            $a = new ExtendController();
            foreach($returnData as $key=>$valor){
                if(isset($valor['subchannel'])){
                   foreach($valor['subchannel'] as $chave=>$val){
                        $returnData[$key]['subchannel'][$chave]['name'] = $a->t[$val['slug']];
                   }
                }
                if( isset ( $a->t[ $valor[ 'slug' ] ]) ){
                    $returnData[$key]['name'] = $a->t[$valor['slug']];
                }
            }

            // $this->printr($returnData);
            //die();
            return $returnData;

        endif;
    }

    public function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"
            return $uuid;
        }
    }

}
