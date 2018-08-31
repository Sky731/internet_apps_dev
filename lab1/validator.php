<?php

$y = $_POST["y"];
$x = $_POST["x"];
$r = $_POST["r"];

if (!is_numeric($y) || !is_numeric($x) || !is_numeric($r)) {
    echo "{result: 'ZHOPA'}";
    exit;
}

$y = floatval($y);
$x = floatval($x);
$r = floatval($r);

$invalid = array();

if ($x <= -3 || $x >= 3) {
    array_push($invalid, "x");
}

if ($r <= 2 || $r >= 5) {
    array_push($invalid, "r");
}

if ($y % 1 != 0 || $y <= -3 || $y >= 5) {
    array_push($invalid, "y");
}


if (count($invalid) != 0) {
    $response = array("result" => "invalid", "values" => $invalid);
    echo json_encode($response);
    exit;
}
