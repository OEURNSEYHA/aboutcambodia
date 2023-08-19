<?php

    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table ="menuitem";

    $start = $_POST['start'];
    $end = $_POST['end'];
    $conditionsearch = $_POST['conditionsearch'];
    $valuesearch = $_POST['valuesearch'];
    $optionsearch = $_POST['optionsearch'];

    $condition = "mitemid > 0"; 
    $rowcount = $Database->countdata($table,$condition);
    if($conditionsearch == 0 ){
        
        $table = "menuitem INNER JOIN menu ON menuitem.menuid = menu.menuid";
        $column = "menuitem.*, menutitle";
        $condition1 = "menuitem.mitemid > 0 AND menu.menuid > 0";
        $condition2 = "menuitem.mitemid";
        $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);

    }  
    else {

        if($optionsearch === 'mitemid' || $optionsearch === 'mitem_status' ||  $optionsearch === 'mitem_orderid'){
            $table = "menuitem INNER JOIN menu ON menuitem.menuid = menu.menuid";
            $column = "menuitem.*, menu.menuid, menutitle";
            
            $condition = "menuitem.$optionsearch = '$valuesearch'";
            $condition1 = "menuitem.$optionsearch = '$valuesearch'";
            $condition2 = "menuitem.mitemid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }else{
            
            $table = "menuitem INNER JOIN menu ON menuitem.menuid = menu.menuid";
            $column = "menuitem.*, menu.menuid, menutitle";
            $condition = "menuitem.$optionsearch LIKE '%$valuesearch%'";
            $condition1 = "menuitem.$optionsearch LIKE '%$valuesearch%'";
            $condition2 = "menuitem.mitemid"; 
            $getdata = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);
            $rowcount = $Database->countdata($table, $condition);
            
        }
        
    }
    
    $data = array();
        if($getdata != '0'){
            foreach($getdata as $row){ 
                $data[] = array(
                    "mitemid"=>$row[0],
                    "userid"=>$row[1],
                    "menuid"=>$row[2],
                    "mitem_title"=>$row[3],
                    "mitem_detail"=>$row[4],
                    "mitem_orderid"=>$row[5],
                    "mitem_view"=>$row[6],
                    "mitem_status"=>$row[7],
                    "lang"=>$row[8],
                    "mitem_datepost"=>$row[9],
                    "mitem_img"=>$row[10],
                    "menutitle"=>$row[12],
                    "total"=>$rowcount,
                );
    }
        
    }

    echo json_encode($data);
    


?>