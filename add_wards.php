<?php
include_once 'db_manager.php';
if (isset($_POST['constituency_id']) and  isset($_POST['names'])) {

    $names_str  = str_replace(array("\r\n", "\r", "\n"),",",$_POST['names']);
    $names_str = str_replace("Ward","",$names_str);
    $names_str = str_replace("ward","",$names_str);
//        echo $names_str;

    $names = array_filter(explode(',', trim($names_str)));
//        print_r($names);
//        exit();
    insert_wards($_POST['constituency_id'], $names);
    header("Location:index.php");
    exit();
}
?>
<h1>list of all wards  in <?=$_GET['name']?> constituency</h1>
<form method="post" action="add_wards.php">

    <input hidden name="constituency_id" value="<?=$_GET['constituency_id']?>">

    <h2>Please enter the wards separated by comma <span style="color: red">(,)</span></h2>
    <textarea name="names" cols="50" rows="20">

    </textarea> <br>
    <input style="margin-top: 20px; padding: 20px" type="submit" name="submit">
</form>
