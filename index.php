<?php
header("Content-Type: text/plain");

chmod("/app/vendor/pdftk/bin/pdftk", "u+x");

echo "\nTask 1: whoami\n";
$output=null;
$retval=null;
exec('whoami', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);


echo "\nTask 2: pdftk\n";
$output=null;
$retval=null;
exec('pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);


echo "\nTask 3: /bin/bash pdftk\n";
$output=null;
$retval=null;
exec('/bin/bash pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);


echo "\nTask 4: ls -la\n";
$output=null;
$retval=null;
exec('ls -la', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);


echo "\nTask 5: vendor/pdftk/bin/pdftk \n";
$output=null;
$retval=null;
exec('vendor/pdftk/bin/pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);