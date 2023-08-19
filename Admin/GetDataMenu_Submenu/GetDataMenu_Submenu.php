<?php
    include('../Config/Config.php');
    $table = "menu_submenu";


    $column = "*";
    $condition1 = "id > 0";
    $condition2 = "id";
    $getdata = $Database->getdata($table,$column,$condition1,$condition2,0,1000);

    
    $data = array();
    if($getdata != '0'){
        foreach($getdata as $row){
            $data[] = array(
                
                "id"=>$row[0],
                "menuid"=>$row[1],
                "submenuid"=>$row[2],
               
            );
        }
    }

    echo json_encode($data);

?>