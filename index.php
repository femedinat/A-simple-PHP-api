<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS, UPDATE');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header('Content-Type: application/json');

    require_once('App/Services/UserService.php');
    require_once('App/Services/PassagService.php');

    if($_GET['url']){
        $url = explode('/', $_GET['url']);

        if($url[0] === 'api'){
            array_unshift($url);
            $service = ucfirst($url[1]). 'Service';

            $method = strtolower($_SERVER['REQUEST_METHOD']);

            try{
                $response  = call_user_func_array(array(new $service, $method), $url);
                echo json_encode($response);
                exit;
            } catch( \Exception $e){
                echo json_encode($e);
                exit;
            }
        }
    }
    