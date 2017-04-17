<?php
//this is a working script and creates the list of what i want however i want this to be an easy to use form that outputs to a .bat file named rungpuplotgenerator.bat that then autodownloads for the user, or directs them to the download. I would also like to have it add the pause command to the end of the .bat file but that isnt absolutely needed. the comments with quotation marks are what i would like the labels for the form to be.(prefilled to show what it is supposed to look like if you were to run it.)


$username = $_POST["Username"];
$bat = ".bat";
$files = "C:/Apache/htdocs/files/";
$userbat = "$files$username$bat";
$myfile = fopen($userbat, "w");


//"Numeric Account ID"
$ID = $_POST["ID"]; //user should be able to change this
//"Nonce to start on"
$StartNonce = $_POST["StartNonce"]; //user should be able to change this
$PlotSize = "409600"; //user should NOT be able to change this
$US = "_"; //user should NOT be able to change this
//"Drive to plot on"
$Drive = $_POST["Drive"]; //user should be able to change this, needs to have a ":" after the drive
$Semi = ":";
$Ram = $_POST["Stagger"]; //user should be able to change this
//"Plot Generation Format"
$Style = $_POST["Style"]; //should have a dropdown with the options "buffer" and "direct"

$txt = "mkdir $Drive$Semi/Burst/\r\nmkdir $Drive$Semi/Burst/plots/\r\n";
fwrite($myfile, $txt);
$txt = "@echo off\r\ncls\r\necho please have this file in the same folder as gpuplotgenerator\r\necho please confirm you are ready to plot your drives.\r\npause\r\n";
fwrite($myfile, $txt);

$x=1;
//"How many plots of 100GB would you like to make?"
$plots = $_POST["plots"]; //user should be able to change this
	while($x <= $plots){
	$txt = "echo starting plot $x/$plots on drive $Drive\r\n";
	fwrite($myfile, $txt);
	$txt =  "gpuplotgenerator generate $Style $Drive$Semi/Burst/plots/$ID$US$StartNonce$US$PlotSize$US$Ram\r\n";
	fwrite($myfile, $txt);
        $x++;
	$StartNonce=$StartNonce+$PlotSize+1;

}
fclose($myfile);

$file = $userbat;

header("Content-Description: File Transfer"); 
header("Content-Type: application/octet-stream"); 
header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

readfile ($file);
exit(); 
?>