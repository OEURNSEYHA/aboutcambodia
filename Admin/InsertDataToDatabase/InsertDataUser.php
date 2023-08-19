<?php
    date_default_timezone_set('Asia/Phnom_Penh');
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "user";
    
    $id = $_POST['editid'];
    $username=$_POST['username'];
    $useremail=$_POST['useremail'];
    $userpass = md5($_POST['userpass']);
    $userpass = password_hash($userpass,PASSWORD_DEFAULT);
    $usertype = $_POST['usertype'];
    $userip= $_SERVER['REMOTE_ADDR'];
    $codeverify = 111;
    $userstatus = $_POST['userstatus'];
    $userimg = $_POST['imguser'];
    $userdate = date('Y-m-d h:i:s a ');
    $msg['userip'] = $userip;
    $msg['userpass'] = $userpass;
    $msg['userdate'] = $userdate;
    $msg['codeverify'] = $codeverify;
    $column = "useremail";
    $condition = "useremail = '$useremail' && userid != $id";
    
    $Duplicate = $Database-> duplicate($table,$column,$condition);

    if($Duplicate == true){
        $msg['dpl'] = true;
    }else{
        if($id == 0){
            $msg['edit'] = false;
            $value = "null,'$username','$useremail','$userpass','$usertype','$userip',$codeverify,$userstatus,'$userimg','$userdate'";
            $Database->insert($table,$value);
            $lastid = $cn->insert_id;
            $msg['autoid'] = $lastid;
        }else{
            $msg['edit'] = true;
            $condition = "userid = $id";
            $column = "username='$username', useremail='$useremail', userpass='$userpass', usertype='$usertype',userip='$userip', codeverify=$codeverify, userstatus=$userstatus,userimg='$userimg',userdate='$userdate'";
            $Database->update($table,$column,$condition);
        }
        $msg['dpl']=false;
    }

    echo  json_encode($msg);

?>