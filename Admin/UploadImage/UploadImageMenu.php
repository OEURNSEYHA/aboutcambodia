<?php

    $imgmenu = $_FILES['img-filemenu'];
    $imgnamemenu = $imgmenu['name'];
    $imgname = mt_rand(100000,999999);
    $tmp  = $imgmenu['tmp_name'];
    $extension = pathinfo($imgnamemenu,PATHINFO_EXTENSION);
    $img = time().$imgname.'.'.$extension;
    $msg['img'] = $img;

    $condition_ext = array('jpg','JPG','PNG','png','JPEG','jpeg');
    if(!in_array($extension, $condition_ext)){
        $msg['extension'] = true;
    }else{
        $msg['extension'] = false;
        $msg['img'] = $img;
        move_uploaded_file($tmp,'../Images/'.$img);
    }

    echo json_encode($msg);


?>