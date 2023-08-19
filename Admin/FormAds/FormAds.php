<form class="uploadads">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>

    <input type="text" name="editid" id="editid" value="0" hidden>
    <input type="text" name="adsid" id="adsid" hidden>
    <label for="">UserID</label>
    <input type="text" name="userid" id="userid">
    <label for="">ADS URL</label>
    <input type="text" name="adsurl" id="adsurl">
    <label for="">ADS TYPE</label>
    <select name="adstype" id="adstype">
        <option value="1">URL</option>
        <option value="2">PHOTO</option>
    </select>

    <label for="">ADS STATUS</label>
    <select name="adsstatus" id="adsstatus">
        <option value="1">Active</option>
        <option value="2">InActive</option>
    </select>

    <div class="box-img">
        <input type="file" name="img-fileads" id="img-fileads">
    </div>
    <input type="text" name="imgads" id="imgads" hidden>
    <div class="btn-save">
        <span>SAVE</span>
    </div>


</form>