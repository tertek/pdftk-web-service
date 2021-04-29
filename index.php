<?php
header("Content-Type: text/plain");

echo "\nTask 1";
$output=null;
$retval=null;
exec('whoami', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);


echo "\nTask 2";
$output=null;
$retval=null;
exec('pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);