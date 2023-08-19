<?php

    $imguser = $_FILES['img-fileuser'];
    $imgnameuser = $imguser['name'];
    $imgname = mt_rand(100000,999999);
    $tmp = $imguser['tmp_name'];

    $extension = pathinfo($imgnameuser, PATHINFO_EXTENSION );
    $img = time().$imgname.'.'.$extension;
  
    $msg['img'] = $img;
    
    $condition_ext = array('jpg','JPG','JPEG','jpeg','PNG','png');
    if(!in_array($extension, $condition_ext)){
        
        $msg['extension'] = true;
        
    }else{
        
        $msg['extension'] = false;
        $msg['img'] = $img;
        move_uploaded_file($tmp,'../Images/'.$img);
    }

    echo json_encode($msg);



?>