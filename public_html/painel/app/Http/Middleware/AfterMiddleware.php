<?php

namespace App\Http\Middleware;

use Closure;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $queries = DB::getQueryLog();
        $logData = '';

        for ($i=0;$i<count($queries);$i++) {
            $query =  $queries[$i]['query'].'';
         
            $time =  date('Y-m-d H:i:s', time());
            //loop through all bindings
            for($j=0; $j<sizeof($queries[$i]['bindings']); $j++)
            {
                $queries[$i]['bindings'][$j] = $queries[$i]['bindings'][$j] == '' ? "''" : $queries[$i]['bindings'][$j];
                //replace ? with actual value
                $query = str_replace_first($query,'?',$queries[$i]['bindings'][$j]);
            }
            
            //remove all new lines
            $query = trim(preg_replace( "/\r\n|\n/", "", $query));
            $newArr = array(date('Y-m-d H:i:s'), $query);
            $logData .= implode("\t",$newArr) . "\n";
        }
         
        //write if any new data
        if($logData != ''){
            //open logs file if exists or create a new one
            $logFile = fopen('/tmp/query_logs/'.date('Y-m-d').'_query.log', 'a+');
            //write log to file
            fwrite($logFile, $logData);
            fclose($logFile);
        }
         
        //return response
        return $response;
    }
}
