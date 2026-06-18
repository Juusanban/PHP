<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION["user"])) {
    echo json_encode([
        "loggedIn" => true,
        "user" => $_SESSION["user"],
        "history" => isset($_SESSION["history"]) ? $_SESSION["history"] : []
    ]);
} else {
    echo json_encode([
        "loggedIn" => false
    ]);
}
?>


