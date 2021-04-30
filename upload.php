<?php


try {

    //  Validate File Upload
    //  File Size, File Type
    if(!isset($_FILES['file'])) {
        throw new \Exception("No file specified!");
    }
    
    if($_FILES['file']['type'] != "application/pdf") {
        throw new \Exception("Invalid file type");
    }

    if($_FILES['file']['size'] > 2*1e+7) {
        throw new \Exception("Invalid file size");
    }

    //  Temporary Name
    $name = $_FILES['file']['name'];  
    $temp_name  = $_FILES['file']['tmp_name'];  

    //  Temporary file locations
    $tmp_upload = 'tmp_upload/';
    $tmp_convert = 'tmp_convert/';   

    //  Temporary file names
    $uploadName = uniqid('upload_') . ".pdf";
    $convertName = uniqid('convert_') . ".pdf";

    //  Temporary paths
    $uploadPath = $tmp_upload.$uploadName;
    $convertPath = $tmp_convert.$convertName;

    //  Move file
    move_uploaded_file($temp_name, $uploadPath);


    //  Execute pdftk binary 
    $output=null;
    $retval=null;

    exec('pdftk '.$uploadPath.' output '.$convertPath. '', $output, $retval);

    //  Check if execution was successful
    if($retval !== 0) {
        //  Cleanup
        unlink($uploadPath);
        throw new \Exception("pdftk error");
    }

    //  Generate base64 string from PDF
    $pdf = file_get_contents($convertPath);
    $base64 = base64_encode($pdf);
    
    //  Send JSON Response
    $response = array(
        "base64" => $base64, 
        "name" => $name
    );

    header('Content-Type: application/json');
    echo json_encode($response);

    //  Cleanup
    unlink($uploadPath);
    unlink($convertPath);

} catch (\Exception $e) {
    //  Send Error Response
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json');
    die("There was an error with your request. ($e)");
}

