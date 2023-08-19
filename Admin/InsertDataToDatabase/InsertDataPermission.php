<?php
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $id = $_POST['editid'];
    $userid = $_POST['userid'];
    $menuid = $_POST['menuid'];
    $actionid = $_POST['actionid'];
    
    $table = "permission";
    $column = "userid";
 
    if($id == 0){
        
        $msg['edit'] = false;
        $value= "null,$userid,$menuid,$actionid";
        $Database->insert($table,$value);
        $autoid = $cn->insert_id ;
        $msg['autoid'] = $autoid;
        
    }else{
        $msg['edit'] = true;
        $column = "userid = $userid, menuid = $menuid, actionid = $actionid";
        $condition = "id = $id" ; 
        $Database->update($table,$column,$condition);
    }
    $msg['dpl']=false;
    

    
    echo json_encode($msg);
?>