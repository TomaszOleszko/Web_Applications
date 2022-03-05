<?php
echo "REQUEST";
foreach($_REQUEST as $key=>$value) {
    echo "$key = $value <br />";
}
echo "POST";
foreach($_POST as $key=>$value) {
    echo "$key = $value <br />";
}
echo "GET";
foreach($_GET as $key=>$value) {
    echo "$key = $value <br />";
}