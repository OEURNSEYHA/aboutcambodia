<?php

    $imgsubmenu  = $_FILES['img-filesubmenu'];
    $imgnamesubmenu = $imgsubmenu['name'];
    $imgname = mt_rand(100000,999999);
    $tmp = $imgsubmenu['tmp_name'];
    $extension = pathinfo($imgnamesubmenu, PATHINFO_EXTENSION);

    $img = time().$imgname.'.'.$extension;
    $msg['img']= $img;
    
    $extension_ext = array('jpg','JPG','JPEG','jpeg','png','PNG');
    if(!in_array($extension, $extension_ext)){
        $msg['extension']=true;
    }else{
        $msg['extension']=false;
        $msg['img']=$img;
        move_uploaded_file($tmp,'../Images/'.$img);
    }

    echo json_encode($msg);

?>