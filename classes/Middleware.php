<?php
Class Middleware{
    static function pagination(){
        $page = isset( $_REQUEST['page']) ?  $_REQUEST['page'] : 1;
        $limit = isset( $_REQUEST['limit']) ?  $_REQUEST['limit'] : 10;
        $offset = ($page - 1) * $limit;
        $_REQUEST['limit'] = $limit;
        $_REQUEST['offset'] = $offset;
        //print_r('im middle');
    }

    static function isLoggedIn(){
        
    }
}