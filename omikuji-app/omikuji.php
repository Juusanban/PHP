<?php
session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user"])) {
  echo json_encode(
      [
          "result" => "ログインしていません",
          "history" => []
      ],
      JSON_UNESCAPED_UNICODE
  );

  exit;
}

$omikujiList = [
    "大吉",
    "中吉",
    "小吉",
    "吉",
    "末吉",
    "凶",
    "大凶"
];

$result = $omikujiList[array_rand($omikujiList)];

if (!isset($_SESSION["history"])) {
  $_SESSION["history"] = [];
}

$_SESSION["history"][] = $result;

echo json_encode(
    [
        "result" => $result,
        "history" => $_SESSION["history"]
    ],
    JSON_UNESCAPED_UNICODE
);
?>