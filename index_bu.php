<?php
/* header("Content-Type: text/plain");

echo "pdftk\n";
$output=null;
$retval=null;
exec('pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output); */

header("Content-Type: text/html");

?>

<!DOCTYPE html>
<html>
<body>


<?php 

require __DIR__.'/vendor/autoload.php';


$output=null;
$retval=null;
exec('pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
var_dump($output);

echo "br";

$output=null;
$retval=null;
exec('pdftk test/test_form_false.pdf dump_data_fields', $output, $retval);
echo "Returned with status $retval and output:\n";
var_dump($output);

?>
<br>
<h1>Convert PDF</h1>
<p>Make PDF readable through FPDM</p>
<form action="convert.php" method="post" enctype="multipart/form-data">
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html> 