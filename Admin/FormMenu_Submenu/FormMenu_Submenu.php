<link rel="stylesheet" href="../Admin/FormMenu_Submenu/FormMenu_Submenu.css">
<?php
    include('../Config/Config.php');
    $Database = new Config;
    $cn = $Database->cn;
    function loadmenu(){
        $cn = new mysqli("localhost","root","","about_cambodia"); 
        $output = "";
        $sql = "SELECT menuid, menutitle FROM menu";
        $result = $cn->query($sql);
        while($row = $result->fetch_array())
        {
            
           $output .= '<option value="'.$row[0].'">'.$row[1].' </option>';

        }

        return $output;
    }

?>
<form class="uploadmenusubmenu">
    <div class="btn-close">
        <i class="fa-solid fa-xmark"></i>
    </div>

    <input type="text" name="editid" id="editid" value="0" hidden>
    <input type="text" name="id" id="d" hidden>
    <label for="">UserID</label>
    <input type="text" name="userid" id="userid">


    <!-- Create the select dropdown for menuid -->
    <label for="menuid">Menu ID</label>
    <select name="menuid" id="menuid">
        <option value="">Menu ID</option>
        <?php
               echo loadmenu();
            ?>
    </select>

    <!-- Create the select dropdown for submenuid -->
    <label for="submenuid">Submenu ID</label>
    <select name="submenuid" id="submenuid">
        <option value="">Submenu ID</option>

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
                    alert(data);

                }
            });

        })
    })
    </script>








    <div class=" btn-save">
        <span>SAVE</span>
    </div>







</form>