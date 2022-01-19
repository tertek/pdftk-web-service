<?php


try {

    //  Validate File Upload
    //  File Size, File Type
    if(!isset($_FILES['file'])) {
        throw new \Exception("No file specified!");
    }
    
    if(strtolower($_FILES['file']['type']) != "application/pdf") {
        throw new \Exception("Invalid File Type. ". json_encode($_FILES['file']));
    }

    if($_FILES['file']['size'] > 2*1e+7) {
        throw new \Exception("Invalid file size");
    }

    //  Temporary Name
    $name = $_FILES['file']['name'];  
    $tmp_name  = $_FILES['file']['tmp_name'];  

    //  Temporary file locations
    $tmp = 'tmp/';

    //  Temporary file names
    $upload_name = uniqid('upload_') . ".pdf";
    $convert_name = uniqid('convert_') . ".pdf";

    //  Temporary paths
    $upload_path = $tmp.$upload_name;
    $convert_path = $tmp.$convert_name;

    //  Move file
    move_uploaded_file($tmp_name, $upload_path);


    //  Execute pdftk binary 
    $output=null;
    $retval=null;

    exec('pdftk '.$upload_path.' output '.$convert_path. '', $output, $retval);

    //  Check if execution was successful
    if($retval !== 0) {
        //  Cleanup
        unlink($upload_path);
        throw new \Exception("pdftk error");
    }

    //  Generate base64 string from PDF
    $pdf = file_get_contents($convert_path);
    $base64 = base64_encode($pdf);
    
    //  Send JSON Response
    $response = array(
        "base64" => $base64, 
        "name" => $name,
        "file"=>json_encode($_FILES['file'])
    );

    header('Content-Type: application/json');
    echo json_encode($response);

    //  Cleanup
    unlink($upload_path);
    unlink($convert_path);

} catch (\Exception $e) {
    //  Send Error Response
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json');
    die("There was an error with your request. ($e)");
}

