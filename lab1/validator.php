<?php

session_start();

if (!isset($_SESSION["history"])) {
    $_SESSION["history"] = array();
}


$time_start = microtime(true);

$y = str_replace(",", ".", $_POST["y"]);
$x = str_replace(",", ".", $_POST["x"]);
$r = str_replace(",", ".", $_POST["r"]);

$invalid = array();

if (!is_numeric($y) || !is_numeric($x) || !is_numeric($r)) {
    if (!is_numeric($y)) {
        array_push($invalid, "y");
    }
    if (!is_numeric($x)) {
        array_push($invalid, "x");
    }
    if(!is_numeric($r)) {
        array_push($invalid, "r");
    }

    // echo json_encode(array("result" => "invalid", "values" => $invalid)); FIXME
    exit;
}

$y = floatval($y);
$x = floatval($x);
$r = floatval($r);


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
    // echo json_encode($response); FIXME
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

array_push($_SESSION["history"], $response);

$json = array_map(function ($resp) {
    $result = $resp["result"];
    $x = $resp["x"];
    $y = $resp["y"];
    $r = $resp["r"];
    $is_in = $resp["is_in"];
    $cur_time = $resp["cur_time"];
    $exec_time = $resp["exec_time"];
    return "{\"result\":\"$result\", \"x\":\"$x\", \"y\":\"$y\", \"r\":\"$r\", \"is_in\":\"$is_in\", \"cur_time\":\"$cur_time\", \"exec_time\":\"$exec_time\"}";
}, $_SESSION["history"]);

echo "[" . join(",", $json) . "]";
