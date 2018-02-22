<?php

class FiltersClass {

    public static function getMac() {
        $mac = "";
        $cmd_info = "";
        $mac_address = "";


        ob_start();
        system("ipconfig /all");
        $cmd_info = ob_get_contents();
        ob_clean();
        $mac = strpos($cmd_info, 'Physical');
        $mac_address = substr($cmd_info, ($mac + 36), 17); //MAC Address 
        return $mac_address;
    }

    public static function getUserIP() {

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

    public static function returnMacAddress() {

        // This code is under the GNU Public Licence 
        // Written by michael_stankiewicz {don't spam} at yahoo {no spam} dot com 
        // Tested only on linux, please report bugs 
        // WARNING: the commands 'which' and 'arp' should be executable 
        // by the apache user; on most linux boxes the default configuration 
        // should work fine 
        // Get the arp executable path 
        $location = 'which arp';
        $location = rtrim($location);

        // Execute the arp command and store the output in $arpTable 
        $arpTable = '$location -n';

        // Split the output so every line is an entry of the $arpSplitted 
        //array $arpSplitted = split("\n",$arpTable); 
        $arpSplitted = explode("\n", $arpTable);

        // Get the remote ip address (the ip address of the client, the browser) 
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $remoteIp = str_replace(".", "\\.", $remoteIp);

        // Cicle the array to find the match with the remote ip address 
        foreach ($arpSplitted as $value) {
            // Split every arp line, this is done in case the format of the arp 
            // command output is a bit different than expected 
            $valueSplitted = explode(" ", $value);
            foreach ($valueSplitted as $spLine) {
                if (preg_match("/$remoteIp/", $spLine)) {
                    $ipFound = true;
                }

                // The ip address has been found, now rescan all the string
                // to get the mac address
                if (isset($ipFound) && $ipFound) {
                    // Rescan all the string, in case the mac address, in the string
                    // returned by arp, comes before the ip address
                    // (you know, Murphy's laws)
                    reset($valueSplitted);
                    foreach ($valueSplitted as $spLine) {
                        if (preg_match("/[0-9a-f][0-9a-f][:-]" .
                                        "[0-9a-f][0-9a-f][:-]" .
                                        "[0-9a-f][0-9a-f][:-]" .
                                        "[0-9a-f][0-9a-f][:-]" .
                                        "[0-9a-f][0-9a-f][:-]" .
                                        "[0-9a-f][0-9a-f]/i", $spLine)) {
                            return $spLine;
                        }
                    }
                }
                $ipFound = false;
            }
        }
        return false;
    }

    public static function ConvertGroupArraytoArray($array = null) {

        $array = isset($array) ? $array : NULL;
        foreach ($array as $arr_subarray) {

            $arr_subarray = isset($arr_subarray) ? $arr_subarray : NULL;
            foreach ($arr_subarray as $key => $value) {
                $arr_horarios[$key] = $value;
            }
        }
        return isset($arr_horarios) ? $arr_horarios : NULL;
    }

    public function partition($list, $p) {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }
        return $partition;
    }

    /**
     * Função converter HEXADECIAL em RGB
     * Formato de entrada da $data: #000000
     * Formato de saida da $data: rgb(0, 149, 142)
     */
    public static function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    /**
     * Função converter RGB em HEXADECIAL
     * Formato de entrada da $data: #rgb(0, 149, 142)
     * Formato de saida da $data: #000000
     */
    public static function rgb2hex($rgb) {

        $rgb = str_replace('rgb(', '', $rgb);
        $rgb = str_replace(')', '', $rgb);
        $rgbArr = explode(',', $rgb);

        $hex = "#";
        $hex .= str_pad(dechex($rgbArr[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgbArr[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgbArr[2]), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }

    /**
     * Função para calcular o próximo dia útil de uma data
     * Formato de entrada da $data: AAAA-MM-DD
     */
    public static function proximoDiaUtil($data, $saida = 'd/m/Y') {
        // Converte $data em um UNIX TIMESTAMP
        $timestamp = strtotime($data);

        // Calcula qual o dia da semana de $data
        // O resultado será um valor numérico:
        // 1 -> Segunda ... 7 -> Domingo
        $dia = date('N', $timestamp);
        if (date('H') < 14):
            $sum_day = 2;
        else:
            $sum_day = 3;
        endif;

        // Se for sábado (6) ou domingo (7), calcula a próxima segunda-feira
        if ($dia >= 6) {
            $timestamp_final = $timestamp + ((8 - $dia) * 3600 * 24 * $sum_day);
        } else {
            // Não é sábado nem domingo, mantém a data de entrada
            $timestamp_final = $timestamp + ( 3600 * 24 * $sum_day );
        }

        return date($saida, $timestamp_final);
    }

    //==========================================================================================
    public static function formata_print_cpf($valor) {

        $nbr_cpf = $valor;

        $parte_um = substr($nbr_cpf, 0, 3);
        $parte_dois = substr($nbr_cpf, 3, 3);
        $parte_tres = substr($nbr_cpf, 6, 3);
        $parte_quatro = substr($nbr_cpf, 9, 2);

        $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

        return $monta_cpf;
    }

    //==========================================================================================
    public static function sanear_valor($valor) {
        // Pega apenas as partes numéricas
        $partes = array_filter(preg_split("/([\D])/", $valor), 'strlen');

        // Separa a fração do inteiro
        $frac = count($partes) > 1 ? array_pop($partes) : "0";
        $inteiro = implode("", $partes);

        // Junta tudo, converte para ponto-flutuante e arredondanda
        return round((float) ($inteiro . "." . $frac), 2);
    }

    //==========================================================================================
    public static function removeAcento($var) {

        $var = strtolower($var);

        $var = str_replace("á", "a", $var);
        $var = str_replace("à", "a", $var);
        $var = str_replace("â", "a", $var);
        $var = str_replace("ã", "a", $var);
        $var = str_replace("ª", "a", $var);

        $var = str_replace("é", "e", $var);
        $var = str_replace("è", "e", $var);
        $var = str_replace("ê", "e", $var);

        $var = str_replace("í", "i", $var);
        $var = str_replace("ì", "i", $var);
        $var = str_replace("î", "i", $var);

        $var = str_replace("ó", "o", $var);
        $var = str_replace("ò", "o", $var);
        $var = str_replace("ô", "o", $var);
        $var = str_replace("õ", "o", $var);
        $var = str_replace("º", "o", $var);

        $var = str_replace("ú", "u", $var);
        $var = str_replace("ù", "u", $var);
        $var = str_replace("û", "u", $var);

        $var = str_replace("ç", "c", $var);


        return $var;
    }

    //============================================================================================
    public static function fnStringClearToNameRoute($str) {

        $str = str_replace(".", " ", $str);
        $str = str_replace("-", " ", $str);
        $str = str_replace("_", " ", $str);
        $str = str_replace("(", " ", $str);
        $str = str_replace(")", " ", $str);
        #$str = str_replace(" ","_",$str);		
        return $str; //preg_replace('/\s\s+/', ' ', $str);
    }

    //==========================================================================================
    //Calcula idade a partir da data de nascimento.
    public static function calcula_idade($data_nascimento) {

        $data_nasc = explode('-', $data_nascimento);
        $data = date('Y-m-d');
        $data = explode("-", $data);
        $anos = $data[0] - $data_nasc[0];

        if ($data_nasc[1] >= $data[1]) {
            if ($data_nasc[2] <= $data[2]) {
                return $anos;
                break;
            } else {
                return $anos - 1;
                break;
            }
        } else {
            return $anos;
        }
    }

    //==========================================================================================
    public static function SomarData($data, $dias, $meses, $ano) {

        $data = explode("/", $data);
        $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
        return $newData;
    }

    //==========================================================================================
    public static function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y') {

        //$dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    } 

    //==========================================================================================
    public static function diasemana($data) {
        $ano = substr($data, 0, 4);
        $mes = substr($data, 5, -3);
        $dia = substr($data, 8, 9);

        $diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

        switch ($diasemana) {
            case"0": $diasemana = "Domingo";
                break;
            case"1": $diasemana = "Segunda-Feira";
                break;
            case"2": $diasemana = "Terça-Feira";
                break;
            case"3": $diasemana = "Quarta-Feira";
                break;
            case"4": $diasemana = "Quinta-Feira";
                break;
            case"5": $diasemana = "Sexta-Feira";
                break;
            case"6": $diasemana = "Sábado";
                break;
        }

        return $diasemana;
    }

    //==========================================================================================
    public static function mespornumero($month = NULL) {

        $meses = array(
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        );

        return $meses[$month];
    }

    //==========================================================================================
    public static function int_diasemana($data) {
        $ano = substr($data, 0, 4);
        $mes = substr($data, 5, -3);
        $dia = substr($data, 8, 9);

        $diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

        return $diasemana;
    }

    //==========================================================================================
    // Passando data do text box "DD/MM/AAAA" para "AAAA-MM-DD" ================================
    public static function gravaData($data) {
        if ($data != '') {
            return (substr($data, 6, 4) . '-' . substr($data, 3, 2) . '-' . substr($data, 0, 2) );
        } else {
            return false;
        }
    }

    //==========================================================================================
    // Passando data do text box "DD/MM/AAAA HH:MM" para "AAAA-MM-DD HH:MM" ====================
    public static function gravaDataHora($data) {

        $newdata = explode(" ", $data);

        if ($data != '') {
            return (substr($newdata[0], 6, 4) . '-' . substr($newdata[0], 3, 2) . '-' . substr($newdata[0], 0, 2) . ' ' . $newdata[1]);
        } else {
            return '';
        }
    }

    // Passando data do text box "AAAA-MM-DD" para "DD/MM/AAAA" ================================
    public static function mostraData($data) {
        if ($data != '') {
            return (substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4));
        } else {
            return '';
        }
    }

    //==========================================================================================
    //==========================================================================================
    public static function limita_pal($str, $val) {
        $sp = split(' ', $str);
        $n = sizeof($sp);
        for ($i = 0; $i < $val; $i++) {
            $cach .= $sp[$i] . " ";
        }
        for ($i = 0; $i < count($sp); $i++) {
            
        }
        if ($i >= $val) {
            return $cach . "...";
        } else {
            return $cach;
        }
    }

    //============================================================================================
    //============================================================================================
    public static function htmlButTags($str) {
        // Take all the html entities
        $caracteres = get_html_translation_table(HTML_ENTITIES);
        // Find out the "tags" entities
        $remover = get_html_translation_table(HTML_SPECIALCHARS);
        // Spit out the tags entities from the original table
        $caracteres = array_diff($caracteres, $remover);
        // Translate the string....
        $str = strtr($str, $caracteres);
        // And that's it!
        // oo now amps
        $str = preg_replace("/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/", "&amp;", $str);

        return $str;
    }

    //============================================================================================
    //============================================================================================
    public static function filter_string($string, $nohtml = '', $save = '') {
        if (!empty($nohtml)) {
            $string = trim($string);
            if (!empty($save))
                $string = htmlentities(trim($string), ENT_QUOTES, 'ISO-8859-1');
            else
                $string = html_entity_decode($string, ENT_QUOTES, 'ISO-8859-1');
        }
        if (!empty($save))
            $string = mysql_real_escape_string($string);
        else
            $string = stripslashes($string);
        return($string);
    }

    //============================================================================================
    //============================================================================================
    public static function retira_espacos($str) {

        return preg_replace('/\s\s+/', ' ', $str);
    }

    //============================================================================================
    //============================================================================================

    public static function GoodMorning() {

        $hora_do_dia = date("H");

        /* uso de condicionais, poderíamos utilizar o switch também */

        if (($hora_do_dia >= 6) && ($hora_do_dia <= 12))
            echo "Bom Dia";
        if (($hora_do_dia > 12) && ($hora_do_dia <= 18))
            echo "Boa Tarde";
        if (($hora_do_dia > 18) && ($hora_do_dia <= 24))
            echo "Boa Noite";
        if (($hora_do_dia > 24) && ($hora_do_dia < 6))
            echo "Boa Dia";
    }

    //============================================================================================
    //============================================================================================
    public static function fnStringCleartoName($str) {

        $str = str_replace(".", "", $str);
        $str = str_replace("-", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace("[", "", $str);
        $str = str_replace("]", "", $str);
        $str = str_replace(" ", "_", $str);
        return preg_replace('/\s\s+/', ' ', $str);
    }

    //============================================================================================
    //============================================================================================
    public static function fnStringClear($str) {

        $str = str_replace(".", "", $str);
        $str = str_replace("-", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace(" ", "", $str);
        $str = str_replace("[", "", $str);
        $str = str_replace("]", "", $str);
        return preg_replace('/\s\s+/', ' ', $str);
    }

    //============================================================================================
    //============================================================================================
    public static function fnStringClearRoute($str) {

        $str = str_replace(".", "", $str);
        $str = str_replace("-", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace(" ", "", $str);
        $str = str_replace("_", "", $str);
        $str = self::removeAcento($str);

        return preg_replace('/\s\s+/', ' ', $str);
    }

    //============================================================================================
    //============================================================================================

    public static function fnStringRenameFile($str = false) {

        if ($str)
            $str = strtolower($str);
        $str = self::removeAcento($str);
        $str = str_replace(" ", "_", $str);


        return preg_replace('/\s\s+/', ' ', $str);
    }

    //============================================================================================
    //============================================================================================
    private function verifyEmail($email, $checkDNS = false) {
        list($user, $domain) = explode("@", $email);
        if ((@ereg("^([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email))):
            if ($checkDNS):
                if (@checkdnsrr($domain, 'MX')):
                    return(true);
                endif;
            else:
                return true;
            endif;
        endif;
    }

    //============================================================================================
    //============================================================================================
    function exibeDataExtenso($data) {

        // leitura das datas
        $dia = date('d', strtotime($data));
        $mes = date('m', strtotime($data));
        $ano = date('Y', strtotime($data));
        $semana = date('w', strtotime($data));


        // configuração mes	
        switch ($mes) {
            case 1: $mes = "janeiro";
                break;
            case 2: $mes = "fevereiro";
                break;
            case 3: $mes = "março";
                break;
            case 4: $mes = "abril";
                break;
            case 5: $mes = "maio";
                break;
            case 6: $mes = "junho";
                break;
            case 7: $mes = "julho";
                break;
            case 8: $mes = "agosto";
                break;
            case 9: $mes = "setembro";
                break;
            case 10: $mes = "outubro";
                break;
            case 11: $mes = "novembro";
                break;
            case 12: $mes = "dezembro";
                break;
        }


        // configuração semana

        switch ($semana) {
            case 0: $semana = "Dom";
                break;
            case 1: $semana = "Seg";
                break;
            case 2: $semana = "Ter";
                break;
            case 3: $semana = "Qua";
                break;
            case 4: $semana = "Qui";
                break;
            case 5: $semana = "Sex";
                break;
            case 6: $semana = "Sab";
                break;
        }
        //Agora basta imprimir na tela...
        print ("$semana, $dia de $mes de $ano");
    }

    function subMonthDate($date, $day = 0, $month = 0, $year = 0) {

        $data = explode("-", $data);
        $newData = date("Y-m-d", mktime(0, 0, 0, $data[1] - $meses, $data[2] - $dias, $data[0] - $ano));
        return $newData;
    }

    function subDayIntoDate($date, $days) {
        $thisyear = substr($date, 0, 4);
        $thismonth = substr($date, 4, 2);
        $thisday = substr($date, 6, 2);
        $nextdate = mktime(0, 0, 0, $thismonth, $thisday - $days, $thisyear);
        return strftime("%Y%m%d", $nextdate);
    }

    public static function formatMoney($get_valor, $to_calculate = false) {




        /* $source = array('.', ','); 
          $replace = array('', '.');
          $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
          return $valor; //retorna o valor formatado para gravar no banco */
        /* Remove o . (ponto) */
        #$novovalor = str_replace(".", "", $get_valor);
        /* Substitui a , por . (ponto) */
        #$novovalor2 = str_replace(",", ".", $get_valor);

        if ($to_calculate)
            return str_replace(",", ".", number_format($get_valor, 2, ",", ""));
        else
            return number_format($get_valor, 2, ",", "");
        #return $novovalor2;
    }

    /*     * *********************************
     * string_format
     * ********************************* */

    function string_format($format, $string, $placeHolder = "#") {
        $numMatches = preg_match_all("/($placeHolder+)/", $format, $matches);
        foreach ($matches[0] as $match) {
            $matchLen = strlen($match);
            $format = preg_replace("/$placeHolder+/", substr($string, 0, $matchLen), $format, 1);
            $string = substr($string, $matchLen);
        }
        return $format;
    }

    public function loCase($string) {
        $string = strtolower($string);
        $string = str_replace("Â", "â", $string);
        $string = str_replace("Á", "á", $string);
        $string = str_replace("Ã", "ã", $string);
        $string = str_replace("A", "à", $string);
        $string = str_replace("Ê", "ê", $string);
        $string = str_replace("É", "é", $string);
        $string = str_replace("I", "Î", $string);
        $string = str_replace("Í", "í", $string);
        $string = str_replace("Ó", "ó", $string);
        $string = str_replace("Õ", "õ", $string);
        $string = str_replace("Ô", "ô", $string);
        $string = str_replace("Ú", "ú", $string);
        $string = str_replace("U", "û", $string);
        $string = str_replace("Ç", "ç", $string);
        return ($string);
    }

    ###########################################################################################################
    # Trata o nome do arquivo, retirando determinados caracteres
    # Saída: Nome do arquivo sem pontuação, espaço e acentuação.
    ########################################################################################################### 

    public function TratarNomeArquivo($arquivo, $tamanho = 0) {

        //1. Separa a extensão do arquivo
        $extensao = substr($arquivo, strrpos($arquivo, "."));
        //2. Separa apenas o nome do arquivo, sem extensão
        $arquivo = str_replace($extensao, "", $arquivo);
        //3. Retira acentuação
        $arquivo = str_replace("á", "a", $arquivo);
        $arquivo = str_replace("à", "a", $arquivo);
        $arquivo = str_replace("ã", "a", $arquivo);
        $arquivo = str_replace("â", "a", $arquivo);
        $arquivo = str_replace("é", "e", $arquivo);
        $arquivo = str_replace("è", "e", $arquivo);
        $arquivo = str_replace("ê", "e", $arquivo);
        $arquivo = str_replace("í", "i", $arquivo);
        $arquivo = str_replace("ì", "i", $arquivo);
        $arquivo = str_replace("ó", "o", $arquivo);
        $arquivo = str_replace("ô", "o", $arquivo);
        $arquivo = str_replace("ô", "o", $arquivo);
        $arquivo = str_replace("ú", "u", $arquivo);
        $arquivo = str_replace("ù", "u", $arquivo);
        $arquivo = str_replace("ü", "u", $arquivo);

        $arquivo = str_replace("!", "", $arquivo);
        $arquivo = str_replace("@", "", $arquivo);
        $arquivo = str_replace("+", "-", $arquivo);
        $arquivo = str_replace(" ", "_", $arquivo);
        $arquivo = str_replace("___", "_", $arquivo);
        $arquivo = str_replace("__", "_", $arquivo);

        //4. Limita a quantidade de caracteres
        if ($tamanho != 0) {
            $arquivo = substr($arquivo, 0, $tamanho - 1);
        }

        return $arquivo . $extensao;
    }

}

?>