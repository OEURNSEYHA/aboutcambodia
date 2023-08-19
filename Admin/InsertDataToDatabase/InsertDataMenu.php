<?php
    date_default_timezone_set('Asia/PHNOM_PENH');
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "menu";
    $id = $_POST['editid'];
    $userid = $_POST['userid'];
    $menutitle = $_POST['menutitle'];
    $menuimg = $_POST['imgmenu'];
    $menuorderid = $_POST['menuorderid'];
    $menustatus = $_POST['menustatus'];
    $lang = $_POST['lang'];
    $menulink = $Database->slugStr($menutitle);
    
    $menu_datepost = date('Y-m-d h:i:s a');
    $msg['date'] = $menu_datepost;
    $column = "menutitle";
    $condition = "menutitle='$menutitle' && menuid != $id";
    $duplicate = $Database->duplicate($table,$column,$condition);
    if($duplicate == true){
        $msg['dpl'] = true;
    }else{
        if($id == 0){
            
            $msg['edit'] = false;
            $value = "null,$userid,'$menutitle'  , '$menuimg', $menuorderid, $menustatus,  '$lang', '$menulink', '$menu_datepost'";
            $Database->insert($table,$value);
            $lastid = $cn->insert_id;
            $msg['autoid'] =$lastid;
            
        }else{
            
            $column = "userid= $userid, menutitle ='$menutitle', menuimg='$menuimg', menuorderid=$menuorderid,  menustatus=$menustatus, lang= '$lang', menulink='$menulink', menu_datepost='$menu_datepost'";
            $condition = "menuid = $id";
            $Database->update($table,$column,$condition);
            $msg['edit'] = true;
            
        }
        $msg['dpl'] = false;
    }
   
    echo json_encode($msg);
    
?>