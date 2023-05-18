<?php
Class Helper{

    static function sendResponse($status = 200, $message = '', $data = []){
        header("HTTP/1.1 " . $status . " " . $message);
        //add device uuid in response headers
        //header("device_uuid: ".Device::getDeviceUUID());
        $response['status'] = $status;
        //$response['device_uuid'] = Device::getDeviceUUID();
        $response['message'] = $message;
        //if $data is array then add it to response
        if(is_array($data) && count($data) > 0){
            $response['data'] = $data;
        }
        //$response['current_user'] = $_REQUEST['CURRENT_USER']?? '';
        $json_response = json_encode($response,JSON_NUMERIC_CHECK);
        echo $json_response;
        die();
    }

    static function prepare_sql($sql){
        //join all wheres
            if(isset($sql['where'])){
                $sql['where']=implode(' and ',$sql['where']);
            }
            //join all params
            if(isset($sql['params'])){
                $sql['params']=array_merge(...$sql['params']);
            }

            //prepare redbean getall query
            $sql['query']='select '.$sql['fields'].' from '.$sql['table'];
            if(isset($sql['where'])){
                $sql['query'].=' where '.$sql['where'];
            }
            if(isset($sql['order'])){
                $sql['query'].=' order by '.$sql['order'];
            }
            if(isset($sql['pagination'])){
                $sql['query'].=' limit '.$sql['pagination']['limit'].' offset '.($sql['pagination']['page']-1) * $sql['pagination']['limit'];
            }
           
            $sql['query'].=';';
            return $sql;
    }


    static function generateUUID(){
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),
    
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,
    
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,
    
        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
    }
}