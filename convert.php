<?php

require __DIR__.'/vendor/autoload.php';


  $uploadName = uniqid('upload_') . ".pdf";
  dump($_FILES['fileToUpload']['name']);

  //$name       = "converted_" . $_FILES['fileToUpload']['name'];  
  $temp_name  = $_FILES['fileToUpload']['tmp_name'];  
  if(isset($_FILES['fileToUpload']['name']) and !empty($_FILES['fileToUpload']['name'])){
      $tmp_upload = 'tmp_upload/';      
      if(move_uploaded_file($temp_name, $tmp_upload.$uploadName)){
          echo 'File uploaded successfully';
      }
  } else {
      echo 'You should select a file to upload !!';
  }

  $tmp_convert = 'tmp_convert/';   

  $output=null;
  $retval=null;
  exec('pdftk '.$tmp_upload.$uploadName.' dump_data_fields', $output, $retval);
  echo "Returned with status $retval and output:\n";

  dump($output);
  dump($_FILES["fileToUpload"]);

  $convertName = uniqid('convert_') . ".pdf";
  $output=null;
  $retval=null;
  exec('pdftk '.$tmp_upload.$uploadName.' output '.$tmp_convert.$convertName. '', $output, $retval);
  echo "Returned with status $retval and output:\n";

  dump($output);
  dump($_FILES["fileToUpload"]);

  $pdf = file_get_contents($tmp_convert.$convertName);
  $base64 = base64_encode($pdf);

  print '<a download href="data:application/pdf;'.$base64.'" title="Download converted PDF">Test</a>';

  unlink($tmp_upload.$uploadName);
  unlink($tmp_convert.$convertName);
