<?php

/*
 * Esta classe foi desenvolvida por Angelo Lima.
 * Refere-se a Classe para integração e geração de boleto bancário com a Intermeio
 * 
 */

class IntermeioApi {

    public $token;
    public $hashboleto;
    private $appkey;
    private $signature;

    public function __get($name) {

        if (ObjectHelper::existsMethod($this, $name)) {
            return $this->$name();
        }

        return null;
    }

    public function __set($name, $value) {

        if (ObjectHelper::existsMethod($this, $name))
            $this->$name($value);
    }

    public function __construct($appkey = null, $signature = null) {

        $this->appkey = $appkey;
        $this->signature = $signature;

        $this->token = $this->getTransitionToken();
    }

    /*
     * Método que gera o token transacional
     * return @boolean 
     * */

    private function getTransitionToken() {

        $url = 'https://sandbox.intermeio.com/v1/Token';
        $data = array(
            'Appkey' => $this->appkey,
            'Signature' => $this->signature,
        );
        $content = json_encode($data);

        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

            $json_response = curl_exec($curl);
            $json_response = json_decode($json_response, true);

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status == 200) {
                return $json_response;
            } else {
                die("Error: Chamada na url: $url falhou com o status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                return false;
            }

            curl_close($curl);
        } catch (Exception $e) {
            throw new Exception();
            die('Error Code. ' . $status . ' - ' . $e->getMessage());
        }
    }

    /*
     * Método que gera o token transacional
     * return @boolean 
     * */

    public function geraBoleto($parameteres = null) {

        $postfields .= utf8_encode($this->token) . ':';
        $postfields .= utf8_encode('Angelo Lima') . ':';
        $postfields .= utf8_encode('30725872802') . ':';
        $postfields .= utf8_encode(245678) . ':';
        $postfields .= utf8_encode('10/02/2016') . ':';
        $postfields .= utf8_encode(2788) . ':';
        $postfields .= utf8_encode('Rua') . ':';
        $postfields .= utf8_encode('Amaral') . ':';
        $postfields .= utf8_encode('41') . ':';
        $postfields .= utf8_encode('Vila Mariana') . ':';
        $postfields .= utf8_encode('São Paulo') . ':';
        $postfields .= utf8_encode('SP') . ':';
        $postfields .= utf8_encode('04110010') . ':';
        $postfields .= utf8_encode('Aqui vem a linha 1 de instruções do boleto bancário.') . ':';
        $postfields .= utf8_encode('Aqui vem a linha 1 de instruções do boleto bancário e escrevendo para testar o tamanho do campo.');


        $content = (string) base64_encode($postfields);

        $header = array(
            'Authorization: Intermeio ' . $content, 
            'Content-Type: application/json' 
        );

        $url = 'https://sandbox.intermeio.com/v1/Transaction';

        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

            $json_response = curl_exec($curl);
            $json_response = json_decode($json_response, true);

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            echo $status.'<br />';
            echo $json_response.'<br />';

            if ($status == 200) {
                echo $json_response;
                $hashboleto = (string) $json_response;
                echo 'URL GERADA: https://sandbox.intermeio.com/Boleto/' . $hashboleto;
                echo ' <iframe src="https://sandbox.intermeio.com/Boleto/' . $hashboleto . '" style="width:100%; height:1000px;"></iframe>';
            } else {
                die("Error: Chamada na url: $url <br />falhou com o status $status, <br />response $json_response, <br />curl_error " . curl_error($curl) . ", <br />curl_errno " . curl_errno($curl));
                return false;
            }

            curl_close($curl);
        } catch (Exception $e) {
            throw new Exception();
            die('Error Code. ' . $status . ' - ' . $e->getMessage());
        }
    }

}
