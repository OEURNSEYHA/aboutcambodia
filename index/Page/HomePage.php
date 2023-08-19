<?php 
    $province_of_cambodia = array( 
        "kh"=>"ខេត្តនៃប្រទេសកម្ពុជា",
        "eng"=>"PROVINCE OF CAMBODIA",
    );
    
    $resort= array( 
        "kh" => "រមណីដ្ឋាន",
        "eng" => "Resort",
    );
    ?>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner box-slide">
        <?php

            $sql = "SELECT mitemid, mitem_title, mitem_img FROM menuitem WHERE lang = '$lang' 
                    AND mitem_status = 1 ORDER BY mitem_orderid DESC LIMIT 0,1";
            $result = $cn->query($sql);
            while($row = $result->fetch_array()){
                ?>
        <div class="carousel-item active box-imgslide">
            <img src="../AboutCambodia/Admin/Images/<?php echo $row[2] ?>" class="d-block w-100" alt="">
            <div class="carousel-caption d-none d-md-block">

            </div>
            <div class="overlay">
                <h5><?php echo $row[1]; ?></h5>
            </div>

        </div>
        <?php
            }

        ?>

        <?php

        $sql = "SELECT mitemid, mitem_title, mitem_img FROM menuitem WHERE lang = '$lang' 
        AND mitem_status = 1 ORDER BY mitem_orderid DESC LIMIT 1,2";
        $result = $cn->query($sql);
        while($row = $result->fetch_array()){
         ?>
        <div class="carousel-item  box-imgslide">
            <img src="../AboutCambodia/Admin/Images/<?php echo $row[2] ?>" class="d-block w-100" alt="">
            <div class="carousel-caption d-none d-md-block">


            </div>
            <div class="overlay">
                <h5><?php echo $row[1]; ?></h5>
            </div>
        </div>
        <?php
            }

        ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<div class="wrappage">

    <!-- item menu fetch database-->
    <div class="content-category1">
        <div class="content-category1-left">
            <div class="box-category1" data-aos="fade-right" data-aos-duration="500">
                <?php 
                $sql = "SELECT mitemid, mitem_title, mitem_detail, mitem_img, menuid
                        FROM menuitem WHERE lang = '$lang' AND mitem_status = 1 
                        ORDER BY mitem_orderid DESC LIMIT 0,1";
                $result = $cn -> query($sql);
                while($row = $result -> fetch_array()){
                    ?>
                <a
                    href="http://localhost/AboutCambodia/index/index.php?mid=<?php echo $row[4]; ?>&mitem=<?php echo $row[1]; ?>& lang=<?php echo $lang; ?>">
                    <div class="item">
                        <img src="../AboutCambodia/Admin/Images/<?php echo $row[3]; ?>" alt="">
                        <div class="overlay-item">

                            <span class="title-item"><?php  echo mb_substr(strip_tags($row[1]),0,70,'utf8') ?></span>
                            <span class="desc-item">
                                <?php echo mb_substr(strip_tags($row[2]),0,200,'utf8') ?>
                            </span>

                        </div>
                    </div>
                </a>

                <?php
            }
            ?>

            </div>
            <div class="box-category2" data-aos="flip-up" data-aos-duration="500">
                <?php 
                $sql = "SELECT mitemid, mitem_title, mitem_detail, mitem_img, menuid 
                        FROM menuitem WHERE lang = '$lang' AND mitem_status = 1 
                        ORDER BY mitem_orderid DESC LIMIT 1,2";
                $result = $cn -> query($sql);
                while($row = $result -> fetch_array()){
                    ?>
                <a
                    href="http://localhost/AboutCambodia/index/index.php?mid=<?php echo $row[4]; ?>&mitem=<?php echo $row[1]; ?>& lang=<?php echo $lang; ?> ">
                    <div class="item">
                        <img src="../AboutCambodia/Admin/Images/<?php echo $row[3]; ?>" alt="">
                        <div class="overlay-item">

                            <span class="title-item"><?php echo mb_substr(strip_tags($row[1]),0,70,'utf8') ?></span>
                            <span class="desc-item">
                                <?php echo mb_substr(strip_tags($row[2]),0,200,'utf8') ?>
                            </span>

                        </div>
                    </div>
                </a>

                <?php
            }
            ?>
            </div>
        </div>
        <div class="content-category1-right">
            <div class="box-category1">
                <?php 
                $sql = "SELECT mitemid, mitem_title, mitem_detail, mitem_img, menuid
                        FROM menuitem WHERE lang = '$lang' AND mitem_status = 1 
                        ORDER BY mitem_orderid DESC LIMIT 3,1";
                $result = $cn -> query($sql);
                while($row = $result -> fetch_array()){
                    ?>
                <a
                    href="http://localhost/AboutCambodia/index/index.php?mid=<?php echo $row[4]; ?>&mitem=<?php echo $row[1]; ?>& lang=<?php echo $lang; ?>">
                    <div class="item" data-aos="zoom-in">
                        <img src="../AboutCambodia/Admin/Images/<?php echo $row[3]; ?>" alt="">
                        <div class="overlay-item">

                            <span class="title-item"><?php  echo mb_substr(strip_tags($row[1]),0,70,'utf8') ?></span>
                            <span class="desc-item">
                                <?php echo mb_substr(strip_tags($row[2]),0,200,'utf8') ?>
                            </span>

                        </div>
                    </div>
                </a>

                <?php
            }
            ?>

            </div>
            <div class="box-category2">
                <div class="box-category2-left">
                    <?php 
                $sql = "SELECT mitemid, mitem_title, mitem_detail, mitem_img, menuid
                        FROM menuitem WHERE lang = '$lang' AND mitem_status = 1 
                        ORDER BY mitem_orderid DESC LIMIT 4,1";
                $result = $cn -> query($sql);
                while($row = $result -> fetch_array()){
                    ?>
                    <a
                        href=" http://localhost/AboutCambodia/index/index.php?mid=<?php echo $row[4]; ?>&mitem=<?php echo $row[1]; ?>& lang=<?php echo $lang; ?>">
                        <div class="item" data-aos="zoom-in">
                            <img src="../AboutCambodia/Admin/Images/<?php echo $row[3]; ?>" alt="">
                            <div class="overlay-item">

                                <span
                                    class="title-item"><?php  echo mb_substr(strip_tags($row[1]),0,70,'utf8') ?></span>
                                <span class="desc-item">
                                    <?php echo mb_substr(strip_tags($row[2]),0,200,'utf8') ?>
                                </span>

                            </div>
                        </div>
                    </a>

                    <?php
            }
            ?>
                </div>
                <div class="box-category2-right">
                    <?php 
                $sql = "SELECT mitemid, mitem_title, mitem_detail, mitem_img, menuid
                        FROM menuitem WHERE lang = '$lang' AND mitem_status = 1 
                        ORDER BY mitem_orderid DESC LIMIT 5,6";
                $result = $cn -> query($sql);
                while($row = $result -> fetch_array()){
                    ?>
                    <a
                        href="http://localhost/AboutCambodia/index/index.php?mid=<?php echo $row[4]; ?>&mitem=<?php echo $row[1]; ?>& lang=<?php echo $lang; ?> ">
                        <div class="item" data-aos="flip-up">
                            <img src="../AboutCambodia/Admin/Images/<?php echo $row[3]; ?>" alt="">
                            <div class="overlay-item">

                                <span
                                    class="title-item"><?php  echo mb_substr(strip_tags($row[1]),0,70,'utf8') ?></span>
                                <span class="desc-item">
                                    <?php echo mb_substr(strip_tags($row[2]),0,200,'utf8') ?>
                                </span>

                            </div>
                        </div>
                    </a>

                    <?php
            }
            ?>
                </div>
            </div>
        </div>

    </div>




    <!-- item submenu -->
    <div class="content-category2">
        <span class="text-province"><span><?php echo  $province_of_cambodia[$lang]; ?></span></span>
        <div class="box-itemprovince">
            <?php
        
        $sql = "SELECT menuid, menutitle, menuimg FROM menu WHERE lang = '$lang' ORDER BY menuorderid DESC  ";
        $result = $cn->query($sql);
        while($row = $result -> fetch_array()){
            ?>
            <a href="http://localhost/AboutCambodia/index/index.php?lang=<?php echo $lang; ?>&menuid=<?php echo $row[1]; ?> "
                class="itemprovince" data-aos="zoom-in" data-aos-duration="500">
                <div class="box-img">
                    <img src="../AboutCambodia/Admin/Images/<?php echo $row[2] ?>" alt="">
                </div>
                <div class="box-desc">
                    <span>
                        <?php
                    echo $row[1];
                ?>
                    </span>
                </div>
            </a>
            <?php
        }
        ?>
        </div>
    </div>


    <div class="resort">

        <p class="resort-title"> <?php echo $resort[$lang]; ?></p>
        <div class="box-itemresort">
            <a href="" class="itemresort">

                <div class="box-img">
                    <img src="../AboutCambodia/Admin/Images/1679557398431642.jpg" alt="">
                </div>
                <div class="box-desc">
                    <span class="title-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident,
                        aliquam?</span>
                    <span class="desc-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi illo nisi
                        ipsam
                        asperiores quia laudantium perferendis neque maxime, est a dolorum veniam ipsum inventore iusto
                        porro quidem dolores aliquid! Sit.</span>
                </div>
            </a>
            <a href="" class="itemresort">

                <div class="box-img">
                    <img src="../AboutCambodia/Admin/Images/1679557398431642.jpg" alt="">
                </div>
                <div class="box-desc">
                    <span class="title-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident,
                        aliquam?</span>
                    <span class="desc-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi illo nisi
                        ipsam
                        asperiores quia laudantium perferendis neque maxime, est a dolorum veniam ipsum inventore iusto
                        porro quidem dolores aliquid! Sit.</span>
                </div>
            </a>
        </div>


    </div>
</div>