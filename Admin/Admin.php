<?php
    include('../Admin/Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $table="user";

    session_start();
     
    if(!isset($_SESSION['login']) || $_SESSION['login'] == false){
        header('Location:http://localhost/aboutCambodia/index/');
    }

  
        
   

    $userip = $_SERVER['REMOTE_ADDR'];
    $email = $_SESSION['useremail'];
    
    $CurrentData = $Database->getcurrentdata($table,"*","useremail='$email'");
    
    if($CurrentData == '0'){
        header('Location:http://localhost/aboutCambodia/index/');
    }else{
        if($userip != $CurrentData[5]){
            header('Location:http://localhost/aboutCambodia/index/');
        }
    }

    $userid = $CurrentData[0];
    $username = $CurrentData[1];
    $usertype = $CurrentData[4];

    
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Admin/Admin.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <script src="../../PHP/Link/jquery.min.js"></script>
    <link rel="stylesheet" href="../Admin/FormPermission/FormPermission.css">
    <link rel="stylesheet" href="../../PHP/link/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="../Admin/FormUser/FormUser.css">
    <link rel="stylesheet" href="../Admin/FormMenu/FormMenu.css">
    <link rel="stylesheet" href="../Admin/FormSubMenu/FormSubMenu.css">
    <link rel="stylesheet" href="../Admin/FormAds/FormAds.css">
    <link rel="stylesheet" href="../Admin/FormSubMenuItem/FormSubMenuItem.css">
    <link rel="stylesheet" href="../Admin/FormAds/FormAds.css">

</head>

<body>
    <div class="wrappage-admin">
        <div class="wrappage-admin-left">
            <div class="header-admin-left">
                <span>
                    <a href="">
                        Dashboard
                    </a>
                    <input type="text" name="uid" id="uid" value="<?php echo $userid; ?>" hidden>
                </span>
            </div>
            <?php

            include('../Admin/Menu/Menu.php');
?>
        </div>
        <div class=" wrappage-admin-right">
            <div class="header-admin-right">
                <div class="icon-menubar">
                    <i class="fa-solid fa-bars "></i>
                </div>
                <div class="box-search">
                    <div class="search">
                        <input type="text" name="valuesearch" id="valuesearch" class="valuesearch">
                        <div class="icon-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <select name="filter-search" id="filter-search" class="filter-search">

                        </select>

                    </div>

                </div>
                <div class="profile">
                    <div class="box-profile">
                        <img src="../Admin/Images/Flag-Cambodia.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="category-data">
                <div class="item-category-data">
                    <div class="name-category">USER</div>
                    <?php
                       $rowcount = $Database->countdata("user","userid > 0");
                    ?>
                    <div class="value-category-ata"><?php echo  $rowcount ?></div>
                </div>
                <div class="item-category-data">
                    d
                </div>
                <div class="item-category-data">
                    d
                </div>
                <div class="item-category-data">
                    d
                </div>
            </div>
            <div class="bar-content">
                <div class="btn-add">ADD DATA</div>
                <div class="option-showdata">
                    <select name="optionshow" id="optionshow" class=" optionshow">
                        <option value="5"> 5</option>
                        <option value="10"> 10</option>
                        <option value="20"> 20</option>
                        <option value="50"> 50</option>
                        <option value="100"> 100</option>


                    </select>
                    <div class="slide-show">
                        <span class="btn-back"><i class="fa-solid fa-angle-left"></i></i></span>
                        <div class="btn-all-ofpage">
                            <span id="currentpage">1</span>/<span id="totalpage">1</span> of
                            <span id="totaldata">0</span>
                        </div>
                        <span class="btn-next"><i class="fa-solid fa-angle-right"></i></span>
                    </div>
                </div>
            </div>
            <table class="tbl-data">

            </table>
        </div>

    </div>
    <div class="overlay"></div>
    </div>
</body>
<script src="../../SecondProject/dashboard/tinymce/js/tinymce/tinymce.js"></script>
<script src="../Admin/js/js.js"></script>

</html>