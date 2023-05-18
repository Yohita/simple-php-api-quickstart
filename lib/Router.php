<?php

  function get($route, $path_to_include,$middlewares=NULL){
    if( $_SERVER['REQUEST_METHOD'] == 'GET' ){ route($route, $path_to_include,$middlewares); }  
  }
  function post($route, $path_to_include,$middlewares=NULL){
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){ route($route, $path_to_include,$middlewares); }    
  }
  function put($route, $path_to_include,$middlewares=NULL){
    if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){ route($route, $path_to_include,$middlewares); }    
  }
  function patch($route, $path_to_include,$middlewares=NULL){
    if( $_SERVER['REQUEST_METHOD'] == 'PATCH' ){ route($route, $path_to_include,$middlewares); }    
  }
  function delete($route, $path_to_include,$middlewares=NULL){
    if( $_SERVER['REQUEST_METHOD'] == 'DELETE' ){ route($route, $path_to_include,$middlewares); }    
  }

  function any($route, $path_to_include,$middlewares=NULL){ route($route, $path_to_include,$middlewares); }
  
  function route($route, $path_to_include,$middlewares=NULL){

  $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
  $request_url = rtrim($request_url, '/');
  $request_url = strtok($request_url, '?');
  //remove first / from $route
//  $route = ltrim($route, '/');
  $route_parts = explode('/', $route);
  $request_url_parts = explode('/', $request_url);
  array_shift($route_parts);
  array_shift($request_url_parts);

 //print_r($route_parts);
 //  print_r($request_url_parts);

  if( $route_parts[0] == '' && count($request_url_parts) == 0 ){
  processRequest($path_to_include,$middlewares);
  }

  
  if( count($route_parts) != count($request_url_parts) ){ return; }  
  for( $__i__ = 0; $__i__ < count($route_parts); $__i__++ ){
    $route_part = $route_parts[$__i__];
    if( preg_match("/^[$]/", $route_part) ){
      $route_part = ltrim($route_part, '$');
      array_push($parameters, $request_url_parts[$__i__]);
      $$route_part=$request_url_parts[$__i__];
    }
    else if( $route_parts[$__i__] != $request_url_parts[$__i__] ){
      return;
    } 
  }

        processRequest($path_to_include,$middlewares);
             
   }


   function processRequest($path_to_include,$middlewares=NULL){
    $callback = $path_to_include;
//    print_r($callback);
    //process Middlewares
    if($middlewares!=NULL){
        foreach($middlewares as $middleware){
          
            if(is_callable($middleware)){
                //print_r($middleware);
                call_user_func_array($middleware,[]);
            }  
        }
    }

    $request_data=$_REQUEST ?? NULL;
    if(is_callable($callback)){
        call_user_func_array($callback,[$request_data]);
        exit();
  
    } else {
   
        if(!strpos($path_to_include, '.php')){
            $path_to_include.='.php';
            }
           // print_r(APP_ROOT.'/'.$path_to_include);
        //check if file exists
        if(file_exists(APP_ROOT.'/'.$path_to_include)){
         
            //add  / at the begining of path if not exists
            if(substr($path_to_include, 0, 1) != '/'){
                $path_to_include = '/'.$path_to_include;
            }
            include APP_ROOT.'/'.$path_to_include;
            exit();
        }else{
            //file not found
            http_response_code(404);
            echo json_encode(array('status'=>'failure','message'=>'Route not found'));
            exit();
        }    
    }  
   }