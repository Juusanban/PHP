

<?php
session_start();

if (!isset($_SESSION["user"])) {
    echo "ログインが必要です。";
    exit;
}

$filename = $_SESSION["user"] . "_omikuji.txt";
$history = isset($_SESSION["history"]) ? $_SESSION["history"] : [];

header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=\"$filename\"");

echo "【" . $_SESSION["user"] . "さんのおみくじ履歴】\n\n";
foreach ($history as $i => $entry) {
    echo ($i + 1) . ". $entry\n";
}
?>


