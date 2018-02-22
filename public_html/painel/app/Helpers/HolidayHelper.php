<?php
/*
*   Holiday API: a RESTful service for obtaining holiday data
*   API Key: 9f865f90-9a54-4956-afee-8b0341055146   
*/

use App\RMCalendario;

class HolidayHelper
{
    private $parameters = array();

    public function __set($variable, $value)
    {
        $this->parameters[$variable] = $value;
    }

    public function __construct($key = '9f865f90-9a54-4956-afee-8b0341055146')
    {
        if ($key) {
            $this->key = $key;
        }
    }


    /**
     * holidays
     *
     * Faz integração com a Holiday API
     *
     * @param  Array
     * @return Array
     */
    public function holidays($parameters = array())
    {
        $parameters = array_merge($this->parameters, $parameters);
        $parameters = http_build_query($parameters);
        $url  = 'https://holidayapi.com/v1/holidays?' . $parameters;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if ($error = curl_error($ch)) {
            return false;
        }
        curl_close($ch);
        $response = json_decode($response, true);
        if (!$response) {
            return false;
        }
        return $response;
    }

    /**
     * feriadosNacionais
     *
     * Chamada que obtem os feriados nacionais do ano atual
     *
     * @param  Array
     * @return Array
     */
    public static function feriadosNacionais()
    {
        $url  = 'http://dadosbr.github.io/feriados/nacionais.json';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if ($error = curl_error($ch)) {
            return false;
        }
        curl_close($ch);
        $response = json_decode($response, true);
        if (!$response) {
            return false;
        }
        return $response;
    }

    /**
     * feriadosNacionais
     *
     * Chamada que obtem os feriados nacionais do ano atual
     *
     * @param  Array
     * @return Array
     */
    public static function feriadosRegionais($UF)
    {
        $url  = "http://dadosbr.github.io/feriados/estaduais/$UF.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if ($error = curl_error($ch)) {
            return false;
        }
        curl_close($ch);
        $response = json_decode($response, true);
        if (!$response) {
            return false;
        }
        return $response;
    }

    /**
     * isFeriado
     *
     * Verifica se o dia passado é feriado 
     *
     * @param  String ('Y-m-d')
     * @return Boolean
     */
    public static function isFeriado($dia)
    {   
        $hapi = new \HolidayHelper;

        $data = explode('-', $dia);

        $parameters = array(
          // Required
          'country' => 'BR',
          'year'    => $data[0],
          // Optional
          'month'    => $data[1],
          'day'      => $data[2],
          // 'previous' => true,
          // 'upcoming' => true,
          // 'public'   => true,
          // 'pretty'   => true,
        );

        $holidays = $hapi->holidays($parameters);

        if(isset($holidays['holidays']) && count($holidays['holidays']) > 0) return TRUE;
            else return FALSE;
    }

    /**
     * getFeriados
     *
     * Obtem os feriados em um mês, retornando uma Array indexada pela
     * data do feriado e valor igual ao nome dado ao feriado 
     *
     * @param  String ('Y-m')
     * @return Array
     */
    public static function getFeriados($mes)
    {
        $data = explode('-', $mes);

        $hapi = new \HolidayHelper;

        $parameters = array(
          // Required
          'country' => 'BR',
          'year'    => $data[0],
          // Optional
          'month'    => $data[1],
          //'day'      => $data[2],
          // 'previous' => true,
          // 'upcoming' => true,
          // 'public'   => true,
          // 'pretty'   => true,
        );

        $holidays = $hapi->holidays($parameters);

        $Feriados = array();

        if(isset($holidays['holidays']) && count($holidays['holidays']) > 0)
        {
            foreach ($holidays['holidays'] AS $holiday)
            {
                $Feriados[$holiday['date']] = $holiday['name'];
            }
        }

        return $Feriados;

    }

    /**
     * getFeriados
     *
     * Obtem os feriados em um mês, retornando uma Array indexada pela
     * data do feriado e valor igual ao nome dado ao feriado 
     *
     * @param  String ('Y-m')
     * @return Array
     */
    public static function getFeriadosDoAno($ano)
    {
        $feriadosNacionais = self::feriadosNacionais();

        $feriadosRegionais = self::feriadosRegionais('SP');

        $feriadosRegionais = array();

        $Feriados = array();

        if(count($feriadosNacionais) > 0)
        {  
            foreach ($feriadosNacionais AS $feriado)
            {
                if(count($feriado['variableDates']) > 0)
                {
                    if(isset($feriado['variableDates'][$ano]))
                    {
                        $data = explode('/',$feriado['variableDates'][$ano]);
                        $dia  = $ano.'-'.$data[1].'-'.$data[0];
                        
                        $Feriados[$dia] = $feriado['title'];
                        
                    }
                } else {
                    if(isset($feriado['date']))
                    {   
                        $data = explode('/',$feriado['date']);
                        $dia  = $ano.'-'.$data[1].'-'.$data[0];

                        $Feriados[$dia] = $feriado['title'];
                    }
                }
            }
        }

        if(count($feriadosRegionais) > 0)
        {  
            foreach ($feriadosRegionais AS $feriado)
            {
                if(count($feriado['variableDates']) > 0)
                {
                    if(isset($feriado['variableDates'][$ano]))
                    {
                        $data = explode('/',$feriado['variableDates'][$ano]);
                        $dia  = $ano.'-'.$data[1].'-'.$data[0];
                        
                        $Feriados[$dia] = $feriado['title'];
                        
                    }
                } else {
                    if(isset($feriado['date']))
                    {   
                        $data = explode('/',$feriado['date']);
                        $dia  = $ano.'-'.$data[1].'-'.$data[0];

                        $Feriados[$dia] = $feriado['title'];
                    }
                }
            }
        }

        return $Feriados;
    }

    /**
     * isSemana
     *
     * Verifica se o dia passado é dia de semana ou não
     *
     * @param  String ('Y-m')
     * @return Boolean
     */
    public static function isSemana($dia)
    {
        $diaSemana = date('N',strtotime($dia));

        if($diaSemana <= 5) return TRUE;
            else FALSE;
    }

    /**
     * quantosDiasPassaram
     *
     * Conta quantos dia de semana e dias de final de semana passaram até (inclusive) a data passada
     *
     * @param  String ('Y-m-d')
     * @return array ((int) fds, (int) ds)
     */
    public static function quantosDiasPassaram($data){

        $fds = 0; //Qtd de finais de semana ou feriados
        $ds  = 0; //Qtd de dias de semana

        $feriados = self::getFeriados(date('Y-m', strtotime($data)));


        $dia = date('d',strtotime($data));
        $ano_mes = date('Y-m',strtotime($data));

        for ($i = $dia; $i >= 1; $i --){
            $dia = date("Y-m-d",strtotime($ano_mes.'-'.$i));

            if(!(self::isSemana($dia)) || isset($feriados[$dia]))
                $fds ++;
            else
                $ds ++;
        }

        return ARRAY('fds' => $fds, 'ds' => $ds);

    }


    /**
     * getDiasDoMes
     *
     * Conta os dias do mês, retornando um objeto contendo
     * o total de dias, o número de dias úteis e de dias de
     * fim de semana (os feriados são considerados dias de fim
     * de semana). Caso a função seja chamada sem parâmetro,
     * o cálculo será realizado para o mês corrente.
     *
     * @param  String ('Y-m')
     * @return Object
     */
    public static function getDiasDoMes($mes = false)
    {   
        if(!$mes) $mes = date('Y-m');

        $data   = explode('-', $mes);
        $dias   = date('t',strtotime($mes . '-01'));
        $dia    = date($mes.'-01');
        $semana = 0;
        $fds    = 0;

        $Feriados = self::getFeriados($mes);

        $range = range(1,$dias);
        foreach($range AS $day)
        {
            if (!self::isSemana($dia) || isset($Feriados[$dia])) $fds++;
                else $semana++;
            $dia = date('Y-m-d', strtotime($dia . '+1 days'));  
        }

        $diasDoMes         = new \StdClass();
        $diasDoMes->total  = $fds + $semana;
        $diasDoMes->fds    = $fds;
        $diasDoMes->semana = $semana;

        return $diasDoMes;
    }

     /**
     * getDiasPassados
     *
     * Conta os dias passaos desde o início do mês, retornando um objeto contendo
     * o total de dias de semana, sábados e domingos (feriados contam como domingo).
     *
     * @param  Void
     * @return Object
     */

     public static function getDiasPassados($mes = false)
    {   
        if(!$mes) 
        {
            $mes = date('Y-m');
            $dia   = date('Y-m-d');
            $dias   = (int)date('d');
        } else {
            $dias   = date('t',strtotime($mes . '-01'));
            $dia = ($mes."-$dias");
        } 

        $inicio = date($mes.'-01');
        
        $semana  = 0;
        $sabado  = 0;
        $domingo = 0;

        $Feriados = self::getFeriados($mes);

        $range = range(1,$dias);
        foreach($range AS $day)
        {
            if (date('N',strtotime($dia)) == 7 || isset($Feriados[$dia])) $domingo++;
            elseif(date('N',strtotime($dia)) == 6) $sabado++;
            else $semana++;
            $dia = date('Y-m-d', strtotime($dia . '+1 days'));  
        }

        $diasDoMes          = new \StdClass();
        $diasDoMes->total   = $domingo + $semana + $sabado;
        $diasDoMes->semana  = $semana;
        $diasDoMes->sabado  = $sabado;
        $diasDoMes->domingo = $domingo;

        return $diasDoMes;
    }

     /**
     * getHoje
     *
     * 
     *
     * @param  Void
     * @return Object
     */

     public static function getHoje()
    {   
        $dia = date('Y-m-d');
        if (date('N',strtotime($dia)) == 7 || self::isFeriado($dia)) return 'domingo';
        elseif(date('N',strtotime($dia)) == 6) return 'sabado';
        else return 'semana';
    }

    public static function saveCalendario($Feriados,$ano)
    {   
        $clean = RMCalendario::whereRaw("YEAR(dia) = $ano")->delete();

        $begin = new DateTime( $ano.'-01-01' );
        $end = new DateTime( $ano.'-12-31' );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);

        foreach($daterange as $date)
        {     
            $tipo       = 'semana';
            $titulo     = 'Dia útil normal';
            $dia_semana = $date->format("N");

            $linha = new RMCalendario;

            if(isset($Feriados[$date->format("Y-m-d")]))
            {
                $tipo   = 'FDS';
                $titulo = $Feriados[$date->format("Y-m-d")];
            } else if ($dia_semana > 5) {
                $tipo   = 'FDS';
                $titulo = 'Fim de semana normal';
            }

            $linha->dia        = $date->format("Y-m-d");
            $linha->dia_semana = $dia_semana;
            $linha->tipo       = $tipo;
            $linha->titulo     = $titulo;
            $linha->criado_em  = date('Y-m-d H:i:s');

            $linha->save();           
        }
    }

}