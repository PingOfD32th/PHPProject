<?php



//"Numeric Account ID"
$ID="15240509513051186062"; //user should be able to change this
//"Nonce to start on"
$StartNonce="842188859"; //user should be able to change this
$PlotSize="409600"; //user should NOT be able to change this
$US="_"; //user should NOT be able to change this
//"Drive to plot on"
$Drive="J"; //user should be able to change this, needs to have a ":" after the drive
$Semi=":";
$Ram="8192"; //user should NOT be able to change this
//"Plot Generation Format"
$Style="buffer"; //should have a dropdown with the options "buffer" and "direct"


$x=1;
//"How many plots of 100GB would you like to make?"
$plots=50; //user should be able to change this
	while($x <= $plots){
	echo "echo starting plot $x/$plots on drive $Drive<br />";
	echo "gpuplotgenerator generate $Style $Drive$Semi/Burst/plots/$ID$US$StartNonce$US$PlotSize$US$Ram<br />";
        $x++;
	$StartNonce=$StartNonce+$PlotSize+1;

}