<?php
require __DIR__ . "/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

//  url format: <host>/api/endpoint/action
//        $uri:  0=>"" 1=>"api" 2=>"endpoint" 3=>"action"

if ((isset($uri[2]) && $uri[2] != 'pdf') || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    header("Content-Type: text/plain");
    echo "Invalid Endpoint/Action";
    exit();
}

 
require PROJECT_ROOT_PATH . "/Controller/PdfController.php";
 
$objFeedController = new PdfController();
$strMethodName = $uri[3] . 'Action';
$objFeedController->{$strMethodName}();

?>