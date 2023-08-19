<link rel="stylesheet" href="../Admin/FormMenuItem/FormMenuItem.css">
<?php
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
?>
<form class="uploadmenuitem">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="uploadmenuitem-left">
        <input type="text" name="editid" id="editid" value="0" hidden>
        <input type="text" name="mitemid" id="mitemid" hidden>
        <label for="">UserID</label>
        <input type="text" name="userid" id="userid">
        <label for="">MenuItem Title</label>
        <input type="text" name="mitem_title" id="mitem_title">
        <label for="">Menu ID</label>
        <select name="menuid" id="menuid">
            <option value="0">MenuID</option>
            <?php
                $sql = "SELECT menuid, menutitle FROM menu";
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
        <label for="">Status</label>
        <select name="mitem_status" id="mitem_status">
            <option value="1">Active</option>
            <option value="2">InActvie</option>
        </select>
        <label for="">Lang</label>
        <select name="lang" id="lang">
            <option value="kh">Khmer</option>
            <option value="eng">English</option>
        </select>
        <label for="">OrderID</label>
        <input type="text" name="mitem_orderid" id="mitem_orderid">
        <div class="box-img">
            <input type="file" name="img-filemitem" id="img-filemitem">
        </div>
        <input type="text" name="imgmitem" id="imgmitem" hidden>
    </div>
    <div class="uploadmenuitem-right">
        <textarea name="mitem_detail" id="mitem_detail"></textarea>
        <div class="btn-save">
            <span>SAVE</span>
        </div>
    </div>

</form>