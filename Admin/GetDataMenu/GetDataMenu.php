<?php
    include('../Config/Config.php');
    
    $Database = new Config;

    $table = "menu";
    $start = $_POST['start'];
    $end = $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $valuesearch = $_POST['valuesearch'];
    $optionsearch = $_POST['optionsearch'];
    $condition = "menuid > 0"; 
    $rowcount = $Database->countdata($table,$condition);
    if($conditionsearch == 0){
        
        $column = "*";
        $condition1 = "menuid > 0";
        $condition2 = "menuid";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        
    }else{

        if($optionsearch === 'menuid' || $optionsearch === 'menustatus' || $optionsearch === 'menuorderid'){
            
            $column ="*";
            $condition = "$optionsearch = $valuesearch";
            $condition1 = "$optionsearch = $valuesearch";
            $condition2 = "menuid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }else{
            
            $column ="*";
            $condition = "$optionsearch LIKE '%$valuesearch%'";
            $condition1 = "$optionsearch LIKE '%$valuesearch%'";
            $condition2 = "menuid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
    }

    $data = array();

    if($getdata != '0'){
        foreach($getdata as $row){
            $data[] = array(
                "menuid"=>$row[0],
                "userid"=>$row[1],
                "menutitle"=>$row[2],
                "menuimg"=>$row[3],
                "menuorderid"=>$row[4],
                "menustatus"=>$row[5],
                "lang"=>$row[6],
                "menulink"=>$row[7],
                "menu_datepost"=>$row[8],
                "total"=>$rowcount,
            );
        }
    }

    echo json_encode($data);
?>