<?php
    date_default_timezone_set("Asia/Phnom_Penh");
    // session_destroy();
    session_start();
    $_SERVER['login'] = false;
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table = "user";
    $useremail = $_POST['useremail'];
    $userpass = $_POST['userpass'];
    $userpass = md5($userpass);
    $userip = $_SERVER['REMOTE_ADDR'];
    $userdate = date('Y-m-d h:i:s');
   
    $column="*";
    $condition = "useremail='$useremail'";
    $CheckEmail = $Database->duplicate($table,$column,$condition);
    $msg['checkemail']=false;
    $msg['checkpass']=false;
    if($CheckEmail == true){
       $currentdata = $Database -> getcurrentdata($table,"*","useremail = '$useremail'");
       $msg['checkemail'] = true;
      
       if(password_verify($userpass,$currentdata[3])){
            $msg['checkpass'] = true;
            $column = "userip = '$userip', userdate = '$userdate'";
            $Database->update($table,$column,$condition);
            $_SESSION['login']= true;
            $_SESSION['userid'] = $currentdata[0];
            $_SESSION['useremail'] = $useremail;
            $_SESSION['usertype'] = $currentdata[4];
       }
    }
   
    echo json_encode($msg);
   

?>