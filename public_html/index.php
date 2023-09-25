<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Origin: http://127.0.0.1:5501");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require_once '../vendor/autoload.php';

// api/dev ou projeto/1
if ($_GET['url']) {
    $url = explode('/', $_GET['url']);
    //var_dump($url);
    if ($url[0] === 'api') {
        array_shift($url);
        //var_dump($url);
        if (sizeof($url) > 0) {
            $service = 'App\Services\\' . ucfirst($url[0]) . 'Service';
            //var_dump($service);
            array_shift($url);
            //var_dump($url);
            $method = strtolower($_SERVER['REQUEST_METHOD']);
            // var_dump($url);

            if (sizeof($url) > 0) {
                if ($url[0] === 'alter') {
                    $method = $method . 'Alter';
                }
                if ($url[0] === 'delete') {
                    $method = $method . 'Delete';
                    array_shift($url);
                }
            }
            //var_dump($method);   
            try {
                $response = call_user_func_array(array(new $service, $method), $url);
                //var_dump($response);

                http_response_code(200);
                echo json_encode(array('status' => 'sucess', 'data' => $response), JSON_UNESCAPED_UNICODE);
                exit;
            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
        header('location:../index.php');
    }
}