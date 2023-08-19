<link rel="stylesheet" href="../Admin/FormMenuItem/FormMenuItem.css">
<?php
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;


    function loadmenu() {
        
        $cn = new mysqli("localhost","root","","about_cambodia");
        $output = "";
        $sql = "SELECT menuid, menutitle FROM menu";
        $result = $cn->query($sql);
        while($row = $result->fetch_array()){
            $output .= '<option value="'. $row[0] .'"> '. $row[1].'</option>';
        }

        return $output;

    }
?>
<form class="uploadsubmenuitem">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="uploadsubmenuitem-left">

        <input type="text" name="editid" id="editid" value="0" hidden>
        <input type="text" name="smitemid" id="smitemid" hidden>
        <label for="">UserID</label>
        <input type="text" name="userid" id="userid">
        <label for="">MENU ID</label>
        <select name="menuid" id="menuid">
            <option value="">MenuID</option>
            <?php
               echo loadmenu();
            ?>
        </select>

        <label for="">SubMenuID</label>
        <select name="submenuid" id="submenuid">
            <option value="">Submenu</option>

        </select>

        <script>
        $(document).ready(function() {
            let menuid;
            $("select#menuid").change(function() {
                menuid = $(this).val();
                $.ajax({
                    url: 'FormMenu_Submenu/Fetch.php',
                    type: 'POST',
                    data: {
                        mid: menuid,
                    },
                    dataType: "text",
                    beforeSend: function() {
                        //work before success;
                    },
                    success: function(data) {
                        //work after success;
                        $("select#submenuid").html(data);
                    }
                });

            })
        })
        </script>

        <label for="">MenuItem Title</label>
        <input type="text" name="smitem_title" id="smitem_title">
        <label for="">Status</label>
        <select name="smitem_status" id="smitem_status">
            <option value="1">Khmer</option>
            <option value="2">English</option>
        </select>
        <label for="">Lang</label>
        <select name="lang" id="lang">
            <option value="kh">Active</option>
            <option value="eng">InActive</option>
        </select>
        <label for="">OrderID</label>
        <input type="text" name="smitem_orderid" id="smitem_orderid">
        <div class="box-img">
            <input type="file" name="img-filesmitem" id="img-filesmitem">
        </div>
        <input type="text" name="imgsmitem" id="imgsmitem" hidden>
    </div>
    <div class="uploadsubmenuitem-right">
        <textarea name="smitem_detail" id="smitem_detail"></textarea>

        <div class="btn-save">
            <span>SAVE</span>
        </div>
    </div>

</form>