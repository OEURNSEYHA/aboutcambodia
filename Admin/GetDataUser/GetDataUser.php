<?php

    include('../Config/Config.php');
    
    $Database = new Config;
    
    $table = "user";
    $start = $_POST['start'];
    $end =  $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $optionsearch = $_POST['optionsearch'] ;
    $valuesearch = $_POST['valuesearch'];
   
    $condition = "userid > 0";
    $rowcount = $Database->countdata($table,$condition);
    
    if($conditionsearch == 0){
        $column = "*";
        $condition1 = "userid > 0";
        $condition2 = "userid";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        
    }else{
        if($optionsearch === 'userid' || $optionsearch === 'userstatus'){
            $column = "*";
            $condition1 = "$optionsearch = $valuesearch";
            $condition2 = "userid";
            $condition = "$optionsearch = $valuesearch";
            $rowcount = $Database->countdata($table,$condition);
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        }else{
            $column = "*";
            $condition1 = "$optionsearch LIKE '%$valuesearch%'";
            $condition2 = "userid";
            $condition = "$optionsearch LIKE '%$valuesearch%'";
            $rowcount = $Database->countdata($table,$condition);
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        }
       
    }

    $data = array();

    if($getdata != '0'){
        foreach($getdata as $row){
            $data[] = array(
                "userid" => "$row[0]",
                "username" => "$row[1]",
                "useremail" => "$row[2]",
                "userpass" => "$row[3]",
                "usertype" => "$row[4]",
                "userip" => "$row[5]",
                "codeverify" => "$row[6]",
                "status"=>"$row[7]",
                "img" => "$row[8]",
                "date" => "$row[9]",
                "total" => $rowcount,
            );
        }
    }
    

    echo  json_encode($data);

?>