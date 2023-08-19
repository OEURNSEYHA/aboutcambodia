<form class="uploaduser">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <input type="text" name="editid" id="editid" value="0" hidden>
    <input type="text" name="id" id="id" hidden>
    <label for="">User Name</label>
    <input type="text" name="username" id="username" class="username">
    <label for="">User Email</label>
    <input type="email" name="useremail" id="useremail" class="userid">
    <label for="">User Password</label>
    <input type="password" name="userpass" id="userpass">
    <label for="">User Type</label>
    <select name="usertype" id="usertype">
        <option value="admin">Admin</option>
        <option value="client">GeneralUser</option>
    </select>
    <label for="">User Status</label>
    <select name="userstatus" id="userstatus">
        <option value="1">ALL</option>
        <option value="2">Read Only</option>
    </select>
    <label for="">Upload Image</label>
    <div class="box-img">
        <input type="file" name="img-fileuser" id="img-fileuser">
    </div>
    <input type="text" name="imguser" id="imguser">


    <div class="btn-save">save</div>
</form>