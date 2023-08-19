<?php

    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $id = $_POST['id'];
    
    $sql = "SELECT smitem_detail FROM submenuitem WHERE smitem_id = $id";
    $result = $cn->query($sql);
    
    $row = $result->fetch_array();

    $msg['detail'] = $row[0];

    echo json_encode($msg);

?>