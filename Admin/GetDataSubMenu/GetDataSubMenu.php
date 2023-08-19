<?php

    include('../Config/Config.php');
    $Database = new Config;
    $table ="submenu";

    $start = $_POST['start'];
    $end = $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $valuesearch = $_POST['valuesearch'];
    $optionsearch = $_POST['optionsearch'];

    $condition = "submenuid > 0"; 
    $rowcount = $Database->countdata($table,$condition);
    if($conditionsearch == 0 ){
        $table = "submenu INNER JOIN menu ON submenu.menuid = menu.menuid";
        $column = "submenu.*, menu.menutitle" ;
        $condition1 = " submenu.submenuid > 0 ";
        $condition2 = "submenu.submenuid";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        
    }else{

        if($optionsearch === 'submenuid' || $optionsearch === 'submenu_status'  || $optionsearch === 'submenu_orderid'){
            $table = "submenu INNER JOIN menu ON submenu.menuid = menu.menuid";
            $column ="submenu.*, menutitle";
            $condition = "submenu.$optionsearch = $valuesearch";
            $condition1 = "submenu.$optionsearch = $valuesearch";
            $condition2 = "submenu.submenuid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }else{
            $table = "submenu INNER JOIN menu ON submenu.menuid = menu.menuid";
            $column ="submenu.*, menutitle";
            $condition = "submenu.$optionsearch LIKE '%$valuesearch%'";
            $condition1 = "submenu.$optionsearch LIKE '%$valuesearch%'";
            $condition2 = "submenu.submenuid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
    }

    $data = array();

    if($getdata != '0'){
        foreach($getdata as $row){
            $data[] = array(
                "submenuid"=>$row[0],
                "menuid"=>$row[1],
                "userid"=>$row[2],
                "submenu_title"=>$row[3],
                "submenu_img"=>$row[4],
                "submenu_orderid"=>$row[5],
                "submenu_status"=>$row[6],
                "lang"=>$row[7],
                "submenu_datepost"=>$row[9],
                "menutitle"=>$row[10], 
                "total"=>$rowcount,
            );
        }
    }

    echo json_encode($data);
    


?>