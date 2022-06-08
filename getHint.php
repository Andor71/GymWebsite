<?php

    include ("connection.php");

    // get the q parameter from URL
    $text = $_REQUEST["text"];

    $hint = "";
    
    $db_founds = [];

    $query = "select * from excercises";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($db_founds,$row["name"]);
        }
    }



    // lookup all hints from array if $q is different from ""
    if ($text !== "") {
    $text = strtolower($text);
    $len=strlen($text);
    foreach($db_founds as $name) {
        if (stristr($text, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ",$name";
            }
        }
    }
    }

    // Output "no suggestion" if no hint was found or output correct values
    // echo $hint === "" ? "no found" : $hint;
    echo $hint;
?>