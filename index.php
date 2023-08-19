<?php
    include('../AboutCambodia/Admin/Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    $lang = "kh";
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }
    
    $menuid = 0;
    $submenuid = 0;
    $mitem = 0;
    
    if(isset($_GET['menuid'])){
        $menuid = $_GET['menuid'];
    }

    if(isset($_GET['submenuid'])){
        
        $submenuid = $_GET['submenuid'];
    }

    if(isset($_GET['mitem'])){
        $mitem = $_GET['mitem'];
    }
    

    $language = array( 
        "kh"=>"KHR",
        "eng"=>"ENG",
    ) ;

    $flage = array(
        
        "kh"=>"Flag-Cambodia.jpg",
        "eng"=>"flag-eng.jpg",
        
    );

    $footer = array(
        "kh"=>"ប្រទេសកម្ពុជាជាសមាជិកនៃអង្គការសហប្រជាជាតិ អាស៊ាន RCEP កិច្ចប្រជុំកំពូលអាស៊ីបូព៌ា WTO ចលនាមិនចូលបក្សសម្ព័ន្ធ និង La Francophonie ។ ខណៈពេលដែលមនុស្សម្នាក់ៗ...",
        "eng"=>"Cambodia is a member of the United Nations, ASEAN, the RCEP, the East Asia Summit, the WTO, the Non-Aligned Movement and La Francophonie. While per capita ...",
    );
    $aboutcambodia = array(
        
        "kh"=> "អំពី​ប្រទេសកម្ពុជា",
        "eng"=>"ABOUT CAMBODIA",
    );

    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About_Cambodia</title>
    <link rel="icon" href="../AboutCambodia/Admin/Images/logo.jpg">
    <link rel="stylesheet" href="index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="wrappage-home">

        <div class="header">
            <div class="top-header">

                <div class="content-top-header">
                    <div class="contact">

                        <marquee behavior="" direction="" vspace>
                            <?php 
                            
                            $sql = "SELECT adsurl FROM ads WHERE adsid = 1";
                            $result = $cn->query($sql);
                            $row = $result->fetch_array();
                            echo $row[0];
                           
                        ?>
                        </marquee>

                    </div>
                    <div class="box-language">
                        <div class="select-lang">
                            <span><?php echo $language[$lang] ?></span>
                            <img src="../AboutCambodia/Admin/Images/<?php echo $flage[$lang]; ?>" alt=""
                                class="img-cambodia">
                        </div>
                        <ul class="sub-lang">
                            <?php
                                if($menuid == 0){
                                    
                                        if($mitem == 0){
                                            include('../AboutCambodia/index/Page/LanguageHomePage.php');
                                        }else{
                                            include('../AboutCambodia/index/Page/LanguageMitem.php');
                                        }
                                           
                                        
                                    
                                }else if($menuid != 0 ){
                                  
                                        if($submenuid == 0){
                                            include('../AboutCambodia/index/Page/LanguageMenuPage.php');
                                        }else{
                                            include('../AboutCambodia/index/Page/LanguageSubMenuPage.php');
                                            
                                        }
                                    
                                }
                            ?>
                        </ul>
                    </div>

                </div>

                <div class="menu">
                    <div class="logo">
                        <a href="http://localhost/AboutCambodia?lang=<?php echo $lang ?>">
                            <span>LOGO</span>
                        </a>

                    </div>
                    <div class="menu-left">
                        <ul>
                            <?php

                                $sql = "SELECT menu.menuid, menutitle, submenu.submenuid, submenu_title FROM menu 
                                        JOIN menu_submenu ON menu.menuid = menu_submenu.menuid
                                        JOIN submenu ON submenu.submenuid = menu_submenu.id 
                                        WHERE menu.lang = '$lang' AND submenu.lang = '$lang'";
                                
                                

                                $result = $cn->query($sql);
                                $menu_items = array();
                                while($row = $result->fetch_assoc()) {
                                    
                                    $menu_name = $row["menutitle"];
                                    $submenu_name = $row["submenu_title"];

                                    // If the menu item doesn't exist in the menu_items array yet, add it
                                    if (!array_key_exists($menu_name, $menu_items)) {
                                        $menu_items[$menu_name] = array();
                                    }

                                    // Add the submenu to the menu item's array
                                    array_push($menu_items[$menu_name], $submenu_name);
                                }


                                foreach ($menu_items as $menu_name => $submenu){
                                    ?>
                            <li>
                                <a
                                    href="http://localhost/AboutCambodia?lang=<?php echo $lang;?>&menuid=<?php echo $menu_name?>">
                                    <?php echo $menu_name  ?>
                                </a>

                                <div class=" sub-menu-left">
                                    <ul>
                                        <?php
                                        foreach($submenu as $submenu_name ){
                                            ?>
                                        <li>
                                            <a
                                                href="http://localhost/AboutCambodia?lang=<?php echo $lang;?>&menuid=<?php echo $menu_name?>&submenuid=<?php echo $submenu_name ?>">
                                                <?php echo $submenu_name ?>
                                            </a>
                                        </li>

                                        <?php
                                        }
                                ?>
                                    </ul>
                                </div>
                            </li>

                            <?php
                                }
                            ?>


                        </ul>
                    </div>
                    <div class=" icon-search"><i class="fa-solid fa-magnifying-glass"></i></div>
                </div>
            </div>


        </div>

        <?php
            if( $menuid == 0 ){
                if($mitem == 0){
                    include('../AboutCambodia/index/Page/HomePage.php');
                }else{
                    echo "detail";
                }
                
            }else{
                if($submenuid == 0){
                    include('../AboutCambodia/index/Page/category.php');
                }else{
                    echo $submenuid;
                }
            }
        ?>
        <?php
            include('../AboutCambodia/index/Page/Footer.php');
        ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>

</html>