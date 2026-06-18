<?php
session_start();

header("Content-Type: application/json");

$users = [
    "alice" => "1234",
    "bob" => "5678"
];

$input = json_decode(
    file_get_contents("php://input"),
    true
);

if (!is_array($input)) {
  $input = [];
}

$id = isset($input["id"]) ? $input["id"] : "";
$pw = isset($input["pw"]) ? $input["pw"] : "";

if (isset($users[$id]) && $users[$id] === $pw) {
  session_regenerate_id(true);

  $_SESSION["user"] = $id;
  $_SESSION["history"] = [];

  echo json_encode(
      [
          "success" => true,
          "message" => "ログイン成功"
      ],
      JSON_UNESCAPED_UNICODE
  );
} else {
  echo json_encode(
      [
          "success" => false,
          "message" => "ユーザーIDまたはパスワードが違います。"
      ],
      JSON_UNESCAPED_UNICODE
  );
}
?>