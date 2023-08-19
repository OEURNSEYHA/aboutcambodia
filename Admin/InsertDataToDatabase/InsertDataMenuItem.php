<?php
    date_default_timezone_set('Asia/PHNOM_PENH');
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "menuitem";
    $id = $_POST['editid'];
    $userid = $_POST['userid'];
    $menuid = $_POST['menuid'];
    $mitem_title = $_POST["mitem_title"];
    $mitem_detail =$_POST["mitem_detail"];
    $mitem_orderid = $_POST["mitem_orderid"];
    $mitem_view = 0;
    $mitem_status = $_POST["mitem_status"];
    $lang = $_POST["lang"];
    $mitem_datepost = date('Y-m-d h:i:s a');
    $msg['date'] = $mitem_datepost;
    $mitem_img = $_POST["imgmitem"];
    $mitem_link =$Database->slugStr($mitem_title);
    $column = "mitem_title";
    $condition = "mitem_title = '$mitem_title' && mitemid != $id";
    $duplicate = $Database->duplicate($table,$column,$condition);
    if($duplicate == true){
        $msg['dpl'] = true;
    }else{
        if($id == 0){
            
            $value = "null,$userid,$menuid,'$mitem_title','$mitem_detail',$mitem_orderid,$mitem_view,$mitem_status,'$lang','$mitem_datepost','$mitem_img','$mitem_link'";
            $Database->insert($table, $value);
            $lastid = $cn->insert_id;
            $msg['autoid'] = $lastid;
            $msg['edit'] = false;
            $msg['view'] = $mitem_view;
            
        }else{
            
            $column = "menuid = $menuid,mitem_title = '$mitem_title', mitem_detail = '$mitem_detail', mitem_orderid = $mitem_orderid, mitem_view = $mitem_view, mitem_status = $mitem_status,lang = '$lang',mitem_datepost = '$mitem_datepost', mitem_img = '$mitem_img',mitem_link = '$mitem_link'";
            $condition = "mitemid = $id";
            $Database->update($table,$column,$condition);
            $msg['edit']= true;
            
        }
       
        
        $msg['dpl'] = false;
    }
    
    
    echo json_encode($msg);
?>