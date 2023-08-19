<?php
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $optiontable = $_POST['table'];
    $id = 0;
    $table = array(
        
        "0"=>"user",
        "1"=>"permission",
        "2"=>"menu",
        "3"=>"menuitem",
        "4"=>"submenu",
        "5"=>"submenuitem",
        "6"=>"ads",
        
    );

    $ids = array(
        "0"=>"userid",
        "1"=>"id",
        "2"=>"menuid",
        "3"=>"mitemid",
        "4"=>"submenuid",
        "5"=>"smitem_id",
        "6"=>"adsid",
    
    );

    $sql = "SELECT  ".$ids[$optiontable]." FROM ".$table[$optiontable]." ORDER BY ".$ids[$optiontable]." DESC";
    $result = $cn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        $id = $row[0];
    }
    
        
    
    
    $msg['autoid']=$id;
    
    echo json_encode($msg);
?>