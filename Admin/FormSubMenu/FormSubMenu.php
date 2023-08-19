<?php
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
?>
<form class="uploadsubmenu">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <input type="text" name="editid" id="editid" value="0" hidden>
    <input type="text" name="submenuid" id="submenuid" hidden>
    <label for="">Menu ID</label>
    <select name="menuid" id="menuid">
        <option value="0">Menuid</option>
        <?php
            $sql = "SELECT menuid, menutitle FROM menu ORDER BY menuid DESC";
            $result = $cn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    ?>
        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>

        <?php
                }
            }
        ?>
    </select>
    <label for="">UserID</label>
    <input type=" text" name="userid" id="userid">
    <label for="">Menu Title </label>
    <input type="text" name="submenu_title" id="submenu_title">
    <label for="">Menu OrderID</label>
    <input type="text" name="submenu_orderid" id="submenu_orderid">
    <label for="">Menu Status</label>
    <select name="submenu_status" id="submenu_status">
        <option value="1">Active</option>
        <option value="2">Inactive</option>
    </select>
    <label for="">Menu Languages</label>
    <select name="lang" id="lang">
        <option value="kh">Khmer</option>
        <option value="eng">English</option>
    </select>

    <div class="box-img">
        <input type="file" name="img-filesubmenu" id="img-filesubmenu">
    </div>
    <input type="text" name="imgsubmenu" id="imgsubmenu" hidden>
    <div class="btn-save">
        <span>SAVE</span>
    </div>


</form>