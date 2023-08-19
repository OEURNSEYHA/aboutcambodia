<?php
    include('../Config/Config.php');
    
    $Database = new Config;

    $table = "ads";
    $start = $_POST['start'];
    $end = $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $valuesearch = $_POST['valuesearch'];
    $optionsearch = $_POST['optionsearch'];
    $condition = "adsid > 0"; 
    $rowcount = $Database->countdata($table,$condition);
    if($conditionsearch == 0){
        
        $column = "*";
        $condition1 = "adsid > 0";
        $condition2 = "adsid";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        
    }else{

        if($optionsearch === 'adsid' || $optionsearch === 'adsstatus'){
            
            $column ="*";
            $condition = "$optionsearch = $valuesearch";
            $condition1 = "$optionsearch = $valuesearch";
            $condition2 = "adsid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }else{
            
            $column ="*";
            $condition = "$optionsearch LIKE '%$valuesearch%'";
            $condition1 = "$optionsearch LIKE '%$valuesearch%'";
            $condition2 = "adsid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
    }

    $data = array();

    if($getdata != '0'){
        foreach($getdata as $row){
            $data[] = array(
                "adsid"=>$row[0],
                "userid"=>$row[1],
                "adsurl"=>$row[2],
                "adsimg"=>$row[3],
                "adstype"=>$row[4],
                "adsstatus"=>$row[5],
                "total"=>$rowcount,
            );
        }
    }

    echo json_encode($data);
?>