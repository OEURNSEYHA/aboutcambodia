<?php  

    $cn = new mysqli("localhost","root","","about_cambodia"); 
    $sql = "SELECT submenuid, submenu_title FROM submenu WHERE menuid = '". $_POST['mid'] ."'";
    $result = $cn->query($sql);
    $output = "";
    while($row = $result->fetch_array())
    {
        $output .= '<option value="'.$row[0].'">'.$row[1] .'</option>';
    }

    echo $output;

?>