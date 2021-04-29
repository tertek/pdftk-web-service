<?php

$cmd = "pdftk";
$output = shell_exec($cmd);

print $output;