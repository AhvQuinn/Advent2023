<?php
    

    function getCalibrationData(){
        
        $rawCalibrationDataPath = 'includes/CalibrationDataDay1.txt';
        $calibrationFile = fopen($rawCalibrationDataPath, 'r');
        $CalibrationRawContents = fread($calibrationFile, filesize($rawCalibrationDataPath));
        
        $sanitizedCalibrationData = replaceAlphaNumbers($CalibrationRawContents);
        

        $dirtyCalibrationData = explode("\n",$CalibrationRawContents);

        //Experimental
        $CalibrationContents = explode("\n",$sanitizedCalibrationData);
        // echo "<p>Raw Data: ".$dirtyCalibrationData[0]." Cleaned Data: ".$CalibrationContents[0]."</p>";
        // echo $CalibrationContents[0];
        return $CalibrationContents;
    }


    function replaceAlphaNumbers($input){
        //Could do an array, but I'm a bit on the lazy side.
        //Wow this sucks.
        $output = str_replace('zero','z0o',$input);
        $output = str_replace('one','o1e',$output);
        $output = str_replace('two','t2o',$output);
        $output = str_replace('three','t3e',$output);
        $output = str_replace('four','f4r',$output);
        $output = str_replace('five','f5e',$output);
        $output = str_replace('six','s6x',$output);
        $output = str_replace('seven','s7n',$output);
        $output = str_replace('eight','e8t',$output);
        $output = str_replace('nine','n9e',$output);
        return $output;
    }

    $calibrationData =  getCalibrationData();  

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
    echo "<p>Given String: \"".$calibrationRow."\".</p>";
    
    $cleanData = trim(sanitizeCalibrationData($calibrationRow));
    echo "<p>Regex-Purged Contents: ".$cleanData.".</p>";

    $number = returnLeftRights($cleanData);
    echo "<p>Leftmost and Rightmost Integers are: ".$number."</p>";
    
    $sumOfCoordinates = $sumOfCoordinates + $number;

    addBar();
}

echo "<h2>The sum of the provided coordinates is: ".$sumOfCoordinates."</h2>";
echo "<h2>The original answer of 54403 was wrong.</h2>";

?>