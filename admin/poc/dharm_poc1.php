<?php
require_once dirname(__DIR__, 1).'/config/init.php';
ini_set('display_errors', 'on');
error_reporting(E_ALL);




$filename_new = 'cut';
$filename_new_dis = 'Cut';

$filename_read='defaultmastermaster.txt';
$viewspath='Z:/savanigems/admin/views/';
$apipath='Z:/savanigems/admin/api/v1.0/';
$modelpath='Z:/savanigems/admin/model/';
$viewspath_read='C:/Users/INSTANCE-06/Desktop/defaultmaster/views/';
$apipath_read='C:/Users/INSTANCE-06/Desktop/defaultmaster/api/v1.0/';
$modelpath_read='C:/Users/INSTANCE-06/Desktop/defaultmaster/model/';
echo $filename_read . "\n";
echo $viewspath . "\n";
echo $apipath . "\n";
echo $modelpath . "\n";

// read/write mode
$file_pointer = fopen($viewspath.$filename_new."master.php", "r+");

// read mode
echo($viewspath_read.$filename_read);

if(is_readable($viewspath_read.$filename_read)){
    $file_pointer_read = fopen($viewspath_read.$filename_read, "r");
    $filedata = fread($viewspath_read.$filename_read, filesize($viewspath_read.$filename_read));
    fclose($file_pointer_read);

    // writing to file
    fwrite($file_pointer, str_replace('#defaultmaster#',$filename_new,$filedata));
    echo $filedata;
    fclose($file_pointer);
}
else{
    echo "Not possible";
}
exit;



echo "file_exists: ".file_exists('C:/Users/INSTANCE-06/Desktop/temp.txt');   // open for read
$F = fopen('C:/Users/INSTANCE-06/Desktop/temp.txt' , 'r');   // open for read
echo "filesize: ".filesize($F);
// $delim = "\t";   // set delim, eg tab
// fwrite($F, $htmldata . "\n\n");
fclose($F);
exit;
// $myfile = fopen($config->getWeburl()."views/defaultmaster.php", "r") or die("Unable to open file!");
$myfile = fopen('C:\Users\INSTANCE-06\Desktop\temp.txt', "r");
echo fread($myfile,filesize("C:\Users\INSTANCE-06\Desktop\temp.txt"));
// echo fread($myfile,filesize("Z:/savanigems/admin/views/defaultmastermaster.php"));
fclose($myfile);


?>