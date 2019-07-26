<?php
 ini_set('display_errors',1);
 
        class stats{

                 function newReg(){
                        $param = '{
                                "query":"SELECT source,EventID,EventReceivedTime,full_message,level  FROM graylog_0  WHERE EventReceivedTime= \'2019-06-28 12:28:47\' "
                        }';
                        /*$header = array(
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8"
                        );*/
                        $url = 'http://192.168.11.67:9200/_xpack/sql';
                        $curl = curl_init($url);
                        //curl_setopt($curl, CURLOPT_URL, "curl -XGET 'http://192.168.11.67:9200/graylog_0/_search'");
                        curl_setopt($curl,CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl,CURLOPT_POSTFIELDS, $param);
                        $res = curl_exec($curl);
                        curl_close($curl);

                        $array_return = json_decode($res,true);

                        $html='<table width="100%" border="1">
                                <tr>
                                        <th>source</th>
                                        <th>EventID</th>
                                        <th>EventReceivedTime</th> 
                                        <th>full_message</th>
                                        <th>level</th>
                                </tr>
                                <tr>
                                <td>'.$array_return['rows'][0][0] .'</td>
                                <td>'.$array_return['rows'][0][1] .'</td>
                                <td>'.$array_return['rows'][0][2] .'</td>
                                <td>'.$array_return['rows'][0][3] .'</td>
                                <td>'.$array_return['rows'][0][4] .'</td>
                        </tr></table>';
                 
                        return Array($html,$array_return);
                                }

        }
?>