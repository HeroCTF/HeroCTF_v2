<?php

include "flag.php"; // <--- flag here :) you can't see it

function source() {
    echo "<br><code>";
    highlight_string(file_get_contents(__FILE__));
    echo "</code>";
}

function quit()
{
    echo "<img src='https://media.giphy.com/media/15aGGXfSlat2dP6ohs/giphy.gif'/> <br>";
    source();
    exit();
}

$query = urldecode($_SERVER['QUERY_STRING']);
if(preg_match("/ |_/", $query)) quit();

if(isset($_GET['give_flag'])) {
    echo "<img src='https://media.giphy.com/media/d4blihcFNkwE3fEI/giphy.gif'/> <br>";
    echo "FLAG: " . $FLAG;
}


source();

?>

