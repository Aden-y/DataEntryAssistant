<?php
    include_once 'db_manager.php';
    if (isset($_POST['county_id']) and  isset($_POST['names'])) {

        $names_str  = str_replace(array("\r\n", "\r", "\n"),",",$_POST['names']);
        $names_str = str_replace("Constituency","",$names_str);
        $names_str = str_replace("constituency","",$names_str);
//        echo $names_str;

        $names = array_filter(explode(',', trim($names_str)));
//        print_r($names);
//        exit();
        insert_sub_counties($_POST['county_id'], $names);
        header("Location:index.php");
        exit();
    }
?>
<h1>list constituencies  in <?=$_GET['name']?> county</h1>
<form method="post" action="add_sub_counties.php">

    <input hidden name="county_id" value="<?=$_GET['county_id']?>">

    <h2>Please enter the sub-counties separated by comma <span style="color: red">(,)</span></h2>
    <textarea name="names" cols="50" rows="20">

    </textarea> <br>
    <input style="margin-top: 20px; padding: 20px" type="submit" name="submit">
</form>
