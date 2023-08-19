<?php

    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "ads";

    $id = $_POST['editid'];
    $userid = $_POST['userid'];
    $adsurl = $_POST['adsurl'];
    $adsimg = $_POST['imgads'];
    $adstype = $_POST['adstype'];
    $adsstatus = $_POST['adsstatus'];
    
    
    if($id == 0){
        $msg['edit']=false;
        $value = "null,$userid, '$adsurl', '$adsimg',$adstype, $adsstatus";
        $Database->insert($table,$value);
        $msg['autoid'] = $lastid = $cn->insert_id;
    }else{
        $msg['edit']= true;
        $column = "userid = $userid, adsurl = '$adsurl', adsimg= '$adsimg', adstype=$adstype, adsstatus=$adsstatus";
        $condition = "adsid = $id";
        $Database->update($table,$column,$condition);
    }
   

    echo json_encode($msg);


?>