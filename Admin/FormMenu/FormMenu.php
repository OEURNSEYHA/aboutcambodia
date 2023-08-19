<form class="uploadmenu">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>

    <input type="text" name="editid" id="editid" value="0" hidden>
    <input type="text" name="menuid" id="menuid" hidden>
    <label for="">UserID</label>
    <input type="text" name="userid" id="userid">
    <label for="">Menu Title </label>
    <input type="text" name="menutitle" id="menutitle">
    <label for="">Menu OrderID</label>
    <input type="text" name="menuorderid" id="menuorderid">
    <label for="">Menu Status</label>
    <select name="menustatus" id="menustatus">
        <option value="1">Active</option>
        <option value="2">Inactive</option>
    </select>
    <label for="">Menu Languages</label>
    <select name="lang" id="lang">
        <option value="kh">Khmer</option>
        <option value="eng">English</option>
    </select>

    <div class="box-img">
        <input type="file" name="img-filemenu" id="img-filemenu">
    </div>
    <input type="text" name="imgmenu" id="imgmenu" hidden>
    <div class="btn-save">
        <span>SAVE</span>
    </div>


</form>