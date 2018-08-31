<?php

$time_start = microtime(true);

$y = $_POST["y"];
$x = $_POST["x"];
$r = $_POST["r"];

if (!is_numeric($y) || !is_numeric($x) || !is_numeric($r)) {
    echo "{result: 'ZHOPA'}"; // FIXME which fields is invalid ?
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

if ($y % 1 != 0 || $y < -3 || $y > 5) {
    array_push($invalid, "y");
}

if (count($invalid) != 0) {
    $response = array("result" => "invalid", "values" => $invalid);
    echo json_encode($response);
    exit;
}

function checkHit($x, $y, $r) {
    if ($x >= 0 && $y >= 0) {
        if ($x <= $r && $y <= $r) {
            return true;
        } else return false;
    } elseif ($x >= 0 && $y < 0) {
        if (abs($x) + abs($y) <= $r/2) {
            return true;
        } else return false;

    } elseif ($x < 0 && $y <= 0) {
        if (sqrt($x*$x + $y*$y) <= $r/2) {
            return true;
        } else return false;
    } else return false;
}

date_default_timezone_set('Europe/Moscow');
$time_end = microtime(true);
$exec_time = $time_end - $time_start;

$response = array("result" => "valid",
                  "x" => $x,
                  "y" => $y,
                  "r" => $r,
                  "is_in" => checkHit($x, $y, $r),
                  "cur_time" => date('H:i:s', time()),
                  "exec_time" => $exec_time);

echo json_encode($response);
