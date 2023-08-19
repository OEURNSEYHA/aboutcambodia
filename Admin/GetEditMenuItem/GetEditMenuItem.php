<?php

    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $id = $_POST['id'];
    
    $sql = "SELECT mitem_detail FROM menuitem WHERE mitemid = $id";
    $result = $cn->query($sql);
    
    $row = $result->fetch_array();

    $msg['detail'] = $row[0];

    echo json_encode($msg);

?>