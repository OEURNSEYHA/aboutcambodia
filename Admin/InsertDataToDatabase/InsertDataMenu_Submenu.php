<?php

    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "menu_submenu";
    $id = $_POST['editid'];
    $menuid = $_POST['menuid'];
    $submenuid = $_POST['submenuid'];


    if($id == 0){
            
        $msg['edit'] = false;
        $value = "null,$menuid,$submenuid";
        $Database->insert($table,$value);
        $lastid = $cn->insert_id;
        $msg['autoid'] =$lastid;
        
    }else{
        
        $column = "menuid = $menuid, submenuid = $submenuid";
        $condition = " id = $id ";
        $Database->update($table,$column,$condition);
        $msg['edit'] = true;
        
    }

    echo json_encode($msg);


?>