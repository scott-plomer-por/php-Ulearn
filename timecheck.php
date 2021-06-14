<?php
// url that I used, feel free to copy the query strings
//http://localhost:3000/Operation-Pear/timecheck.php?t=1623628800000&tfail=1623283200000&tpass=1623542400000

// t is the timecode sent by system, says if there isn't one set it will use 0 as a timecode garenteeing failure just in case
$timeCode = $_GET['t'] ?: 0;

//javascript uses an extra 3 digits where php rounds so this remooved the last 3 digits of the time code
$timeCode = substr($timeCode, 0, -3);


//added two queryis tfail and tpass to as proof of concept 
//fail time is tfail = 1623283200 (5 days ago)
//pass time is tpass = 1623542400 (1 day ago)



$timeCodeFail = $_GET['tfail'] ?: 0;
$timeCodeFail = substr($timeCodeFail, 0, -3);
$timeCodePass = $_GET['tpass'] ?: 0;
$timeCodePass = substr($timeCodePass, 0, -3);

function checkTime($time){

    $today = new DateTime();
    $todayTime = $today->getTimestamp();
    $experationTime = $todayTime - 172800; // gets mil value of 48 hours ago from today
    
    /*if the time has a smaller number than the experation time, then that link must be from over 48 hours ago and therefore shall fail, 
    if it is greater than or equal to then it passes because its from fruther into the future than 48hours ago from right now
    another option is for this function to return either true or false (see below comments)*/
    $time >= $experationTime? checkTimePass() : checkTimeFail();
}

checkTime($timeCode); // should pass
checkTime($timeCodeFail); // should fail
checkTime($timeCodePass); // should pass

function checkTimePass(){
    print 'should pass! ' . '<br>';
}

function checkTimeFail(){
    print 'should fail!!' . '<br>';
}

/*
*
//another method  for if you want the checktime to return something like a boolean
*
*/

function checkTimeV2($time){

    $isTime = null;
    $today = new DateTime();
    $todayTime = $today->getTimestamp();
    $experationTime = $todayTime - 172800; // gets mil value of 48 hours ago from today
    
    $time >= $experationTime? $isTime = true : $isTime = false;

    return $isTime;
}

someFunction(checkTimeV2($timeCode)); // should pass
someFunction(checkTimeV2($timeCodeFail)); // should fail
someFunction(checkTimeV2($timeCodePass)); // should pass

function someFunction($t){

    $t ? print 'do something cause its true ' . '<br>' : print 'do something cause its false' . '<br>';
}
?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>THIS IS THE ULEARN PAGE</h1>
</body>
</html>