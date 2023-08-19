<?php

    $imgmenuitem = $_FILES['img-filemitem'];
    $imgnamemitem = $imgmenuitem['name'];
    $imgname = mt_rand(100000,999999);
    $tmp = $imgmenuitem['tmp_name'];    
    $extension = pathinfo($imgnamemitem, PATHINFO_EXTENSION);
    
    $img = time().$imgname.'.'.$extension;
    $msg['img'] = $img;

    $extension_ext = array('JPG','jpg','jpeg','JPEG','png','PNG');
    if(!in_array($extension, $extension_ext)){
        $msg['extension'] = true;
    }else{
        $msg['extension'] = false;
        $msg['img'] = $img;
        move_uploaded_file($tmp,'../Images/'.$img);
    }

    echo json_encode($msg);
?>