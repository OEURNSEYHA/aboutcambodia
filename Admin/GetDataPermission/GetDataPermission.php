<?php

    include('../Config/Config.php');
    $Database= new Config;
    $table = "permission";
    $start = $_POST['start'];
    $end = $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $optionsearch = $_POST['optionsearch'];
    $valuesearch = $_POST['valuesearch'];
    $condition = "id > 0";
    $rowcount = $Database->countdata($table,$condition);
    
    if($conditionsearch == 0){
        $column = "*";
        $condition1 = "id > 0";
        $condition2 = "id";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
    }else{
        $column = "*";
        $condition1 = "$optionsearch = '$valuesearch'";
        $condition2 = "id";
        $condition = "$optionsearch = '$valuesearch'";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        $rowcount = $Database->countdata($table,$condition);
    }
    
    $data = array();
    
    if($getdata != '0'){
        foreach($getdata as $row){
            $data[] = array(
                "id" => $row[0],
                "userid" => $row[1],
                "menuid" => $row[2],
                "actionid" => $row[3],
                "total" => $rowcount,
            );
        }
    }
   
  

    echo json_encode($data);


?>