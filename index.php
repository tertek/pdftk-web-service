<?php
header("Content-Type: text/plain");

echo "pdftk\n";
$output=null;
$retval=null;
exec('pdftk', $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);
