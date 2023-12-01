<?php
    
    $calibrationData = [
        array("1abc2","12"),
        array("pqr3stu8vwx","38"),
        array("a1b2c3d4e5f","15"),
        array("treb7uchet","77"),
    ];

    $sumOfCoordinates = 0;

    function sanitizeCalibrationData($calibrationString){
        $output = preg_replace("/[a-zA-Z]+/",'',$calibrationString);
        return $output;
    }
    
    function returnLeftRights($calibrationString){
        
        //left
        $output = substr($calibrationString,0,1);
    
        //right
        $output = $output.substr($calibrationString,strlen($calibrationString)-1,1);
    
        return $output;
    }
    
    function addBar(){
        echo "<p>===============================================================================================================</p>";
    }
    

addBar();

foreach ($calibrationData as $calibrationRow){
    echo "<p>Given String: \"".$calibrationRow[0]."\". Expected Output: ".$calibrationRow[1].".</p>";
    
    $cleanData = sanitizeCalibrationData($calibrationRow[0]);
    echo "<p>Regex-Purged Left: ".$cleanData.".</p>";

    $number = returnLeftRights($cleanData);
    echo "<p>Leftmost and Rightmost Integers are: ".$number."</p>";
    
    $sumOfCoordinates = $sumOfCoordinates + $number;

    addBar();
}

echo "<h2>The sum of the provided coordinates is: ".$sumOfCoordinates."</h2>";


?>