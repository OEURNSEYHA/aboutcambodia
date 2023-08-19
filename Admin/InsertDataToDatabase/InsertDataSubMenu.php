<?php
    date_default_timezone_set('Asia/PHNOM_PENH');


    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "submenu";
    $id = $_POST['editid'];
    $userid = $_POST['userid'];
    $menuid = $_POST['menuid'];
    $submenu_title = $_POST['submenu_title'];
    $submenu_img = $_POST['imgsubmenu'];
    $submenu_orderid = $_POST['submenu_orderid'];
    $submenu_status = $_POST['submenu_status'];
    $lang = $_POST['lang'];
    $submenu_link = $Database->slugStr($submenu_title);
    $submenu_datepost = date('Y-m-d h:i:s a');
    $msg['date'] = $submenu_datepost;
    // $column = "submenu_title";
    // $condition = "submenu_title='$submenu_title' && submenuid != $id";
    // $duplicate = $Database->duplicate($table,$column,$condition);
    // if($duplicate == true){
    //     $msg['dpl'] = true;
    // }else{
        if($id == 0){
            $msg['edit'] = false;
            $value = "null,$menuid,$userid,'$submenu_title'  , '$submenu_img', $submenu_orderid, $submenu_status, '$lang', '$submenu_link', '$submenu_datepost'";
            $Database->insert($table,$value);
            
            $lastid = $cn->insert_id;
            $msg['autoid'] =$lastid;
            
        }else{
            $column = "menuid = $menuid, userid= $userid, submenu_title ='$submenu_title', submenu_img='$submenu_img', submenu_orderid=$submenu_orderid,  submenu_status=$submenu_status, lang='$lang', submenu_link='$submenu_link', submenu_datepost='$submenu_datepost'";
            $condition = "submenuid = $id";
            $Database->update($table,$column,$condition);
            $msg['edit'] = true;
            
        }
        $msg['dpl'] = false;
    // }
   
    echo json_encode($msg);
    
?>