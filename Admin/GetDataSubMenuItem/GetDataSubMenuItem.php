<?php

    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table ="submenuitem";

    $start = $_POST['start'];
    $end = $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $valuesearch = $_POST['valuesearch'];
    $optionsearch = $_POST['optionsearch'];

    $condition = "smitem_id > 0"; 
    $rowcount = $Database->countdata($table,$condition);
    
    if($conditionsearch == 0){
        
        $table ="submenuitem INNER JOIN submenu ON submenuitem.submenuid = submenu.submenuid 
                INNER JOIN menu ON  menu.menuid = submenu.menuid";
        $column = "submenuitem.*,submenu_title, menutitle ";
        $condition1 = "submenuitem.smitem_id > 0 AND submenu.submenuid > 0 AND menu.menuid > 0 ";
        $condition2 = "submenuitem.smitem_id";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
        
    }else{

        if($optionsearch === 'smitem_id' || $optionsearch === 'smitem_status' ||  $optionsearch === 'smitem_orderid'){
            $table ="submenuitem INNER JOIN submenu ON submenuitem.submenuid = submenu.submenuid 
            INNER JOIN menu ON  menu.menuid = submenu.menuid";
            $column ="submenuitem.*,submenu_title, menutitle ";
            $condition = "submenuitem.$optionsearch = $valuesearch";
            $condition1 = "submenuitem.$optionsearch = $valuesearch";
            $condition2 = "submenuitem.smitem_id"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }else{
             
            $table ="submenuitem INNER JOIN submenu ON submenuitem.submenuid = submenu.submenuid 
            INNER JOIN menu ON  menu.menuid = submenu.menuid";
            $column ="submenuitem.*,submenu_title, menutitle ";
            $condition = "submenuitem.$optionsearch LIKE '%$valuesearch%'";
            $condition1 = "submenuitem.$optionsearch LIKE '%$valuesearch%'";
            $condition2 = "submenuitem.smitem_id"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
    }





    // $sql = "SELECT submenuitem.*, submenu_title, menutitle  FROM submenuitem INNER JOIN submenu ON submenuitem.submenuid = submenu.submenuid INNER JOIN menu ON  menu.menuid = submenu.menuid";
    $data = array();
    // $result = $cn->query($sql);
    if($getdata != '0'){
        foreach($getdata as $row){
        // while($row = $result->fetch_array()){
            $data[] = array(
                "smitem_id"=>$row[0],
                "submenuid"=>$row[1],
                "menuid"=>$row[2],
                "userid"=>$row[3],
                "smitem_title"=>$row[4],
                // "smitem_detail"=>$row[5],
                "smitem_img"=>$row[6],
                "smitem_orderid"=>$row[7],
                "smitem_view"=>$row[8],
                "smitem_status"=>$row[9],
                "lang"=>$row[10],
                // "smitem_link"=>$row[11],
                "smitem_date" => $row[12],
                "submenutitle"=>$row[13],
                "menutitle"=>$row[14],
                "total"=>$rowcount,
            );
        // }
           
        }
    }

    echo json_encode($data);
    


?>