<?php
    date_default_timezone_set('Asia/PHNOM_PENH');
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "submenuitem";
    $id = $_POST['editid'];
    $submenuid = $_POST['submenuid'];
    $menuid = $_POST['menuid'];
    $userid = $_POST['userid'];
    $smitem_title = $_POST['smitem_title'];
    $smitem_detail = $_POST['smitem_detail'];
    $smitem_img = $_POST['imgsmitem'];
    $smitem_orderid = $_POST['smitem_orderid'];
    $smitem_status = $_POST['smitem_status'];
    $smitem_view = 0;
    $lang = $_POST['lang'];
    $smitem_link = "link";
    $smitem_date = date('Y-m-d h:i:s a');
    $msg['date'] = $smitem_date;
    $msg['view'] = $smitem_view;
    $column = "smitem_title";
    $conditon = "smitem_title = '$smitem_title' && smitem_id != $id ";
    $duplicate = $Database->duplicate($table,$column,$conditon);
    if($duplicate == true){
        $msg['dpl']=true;
    }else{
        if($id == 0){
            
            $msg['edit']=false;
            $value = "null,$submenuid,$menuid,$userid,'$smitem_title','$smitem_detail','$smitem_img',$smitem_orderid,$smitem_view, $smitem_status, '$lang' , '$smitem_link','$smitem_date'"; 
            $Database->insert($table,$value);
            $lastid = $cn->insert_id;
            $msg['autoid'] = $lastid;

            
        }else{
            $msg['edit'] = true;
            $column = " submenuid=$submenuid,menuid = $menuid, userid = $userid,smitem_title = '$smitem_title',
                        smitem_detail = '$smitem_detail',smitem_img = '$smitem_img',smitem_orderid = $smitem_orderid,
                        smitem_view = $smitem_view, smitem_status =  $smitem_status, lang = '$lang' , smitem_link = '$smitem_link',
                        smitem_date = '$smitem_date'";
                        
            $condition = "smitem_id = $id";
            $Database->update($table,$column,$condition);
        }
       
        $msg['dpl']=false;     
        
    }
   
    echo json_encode($msg);

?>