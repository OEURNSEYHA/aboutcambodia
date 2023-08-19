<?php
 
    $data = array();
    $table = "permission";
    $column = "*";
    $condition1 = "id";
    $condition2 = "userid = $userid";
    $start = 0;
    $end = 10000;
    
    $GetData = $Database->getdata($table,$column,$condition1,$condition2,$start,$end);

    if($GetData !='0'){
        foreach($GetData as $row){
            $data[] = array(
                "menuid" => $row[2],
                "actionid" => $row[3]
            );
        }
    }

    $menu = array(
        "fa-solid fa-users/SYSTEM" => array(
           array("0","USER"),
           array("1","PERMISSION"),
        ),
        "fa-solid fa-list/MENU" => array(
            array("2","Menu"),
            array("3","MenuItem"),
        ),
        "fa-solid fa-list/Submenu" => array(
            array("4","Submenu"),
            array("5","SubmenuItem")
        ),
        "fa-solid fa-list/ADS"=> array(
            array("6","ItemAds"),
        ),
        "fa-solid fa-list/Menu_Submenu"=> array(
            array("7","Menu_Submenu"),
        )
    )
    

?>

<div class="menu">
    <ul>
        <?php
            foreach($menu as $keymenu => $valmenu){
                $mykeymenu = explode("/",$keymenu);
        ?>
        <li>
            <a href="#">
                <i class="<?php echo $mykeymenu[0]  ?>"></i>
                <span><?php echo $mykeymenu[1] ?></span>
            </a>
            <div class="sub-menu">
                <ul>
                    <?php
                        if($usertype === "admin"){
                            foreach($valmenu as $val){
                    ?>

                    <li data-role="1" data-id="<?php echo $val[0]; ?>">
                        <a href="#">
                            <!-- <i class="fa-solid fa-user"></i> -->
                            <span><?php echo $val[1]; ?></span>
                        </a>
                    </li>

                    <?php
                    }
                    }else if($usertype === "client"){
                        foreach($valmenu as $val){
                            foreach($data as $vals){
                                $role = 0;
                                if($vals['menuid']== $val[0] && $vals['actionid'] != 0){
                                    $role = $vals['actionid'];
                                    ?>
                    <li data-role="<?php echo $role ?>" data-id="<?php echo $val[0]; ?>">
                        <a href="">
                            <!-- <i class="fa-solid fa-user"></i> -->
                            <span><?php echo $val[1]; ?></span>
                        </a>
                    </li>
                    <?php
                    }
                    }
                    }

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



<!-- 

<div class="menu">

    <ul>
        <li>

            <a href="#">
                <i class="fa-solid fa-users"></i>

                <span> SYSTEM</span>
            </a>


            <div class="sub-menu">
                <ul>
                    <li data-id='0'>
                        <a href="#">
                            <i class="fa-solid fa-user"></i>

                            USER
                        </a>
                    </li>
                    <li data-id='1'>
                        <a href="#">

                            <i class="fa-solid fa-user-lock"></i>
                            setpermission
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-list"></i>

                <span>
                    Menu

                </span>
            </a>
            <div class="sub-menu">
                <ul>
                    <li data-id='2'>
                        <a href="#">
                            <i class="fa-solid fa-rectangle-list"></i>
                            <span>menu</span>
                        </a>
                    </li>
                    <li data-id='3'>
                        <a href="#">
                            <i class="fa-solid fa-rectangle-list"></i>

                            <span>menuitem</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-list"></i>

                <span>submenu</span>
            </a>
            <div class="sub-menu">
                <ul>
                    <li data-id='4'>
                        <a href="#">
                            <i class="fa-solid fa-rectangle-list"></i>
                            <span> submenu</span>
                        </a>
                    </li>
                    <li data-id='5'>
                        <a href="#">
                            <i class="fa-solid fa-rectangle-list"></i>
                            <span> submenuitem</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-list"></i>

                <span>ADS</span>
            </a>
            <div class="sub-menu">
                <ul>
                    <li data-id='6'>
                        <a href="#">
                            <i class="fa-solid fa-rectangle-list"></i>
                            <span> Itemads</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div> -->