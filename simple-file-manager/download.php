<?php
$uploadDirectory = __DIR__ . "/uploads/";

if (!isset($_GET["filename"])) {
    exit("ファイル名が指定されていません。");
}

$filename = basename($_GET["filename"]);
$filepath = $uploadDirectory . $filename;

if ($filename === "" || !file_exists($filepath) || !is_file($filepath)) {
    exit("ファイルが見つかりません。");
}

header("Content-Type: application/octet-stream");
header(
    "Content-Disposition: attachment; filename*=UTF-8''" .
    rawurlencode($filename)
);
header("Content-Length: " . filesize($filepath));

readfile($filepath);
exit;
?>

