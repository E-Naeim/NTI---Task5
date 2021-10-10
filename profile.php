<?php

$file =  fopen('info.txt','r')  or die('unable to open file');

while(!feof($file)) {
    echo  fgets($file).'<br>';
}

fclose($file);


?>