<?php
$uploadDirectory = __DIR__ . "/uploads/";
$message = "";
$error = "";
$maxFileSize = 4 * 1024 * 1024;

if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_FILES["fileUpload"])) {
        $error = "ファイルを選択してください。";
    } elseif ($_FILES["fileUpload"]["error"] !== UPLOAD_ERR_OK) {
        $error = "ファイルのアップロードに失敗しました。";
    } elseif ($_FILES["fileUpload"]["size"] > $maxFileSize) {
$error = "ファイルサイズは4MB以下にしてください。";
} else {
$originalName = basename($_FILES["fileUpload"]["name"]);
$savePath = $uploadDirectory . $originalName;

if ($originalName === "") {
$error = "正しいファイルを選択してください。";
} elseif (file_exists($savePath)) {
$error = "同じ名前のファイルがすでに存在します。";
} elseif (
move_uploaded_file(
$_FILES["fileUpload"]["tmp_name"],
$savePath
)
) {
$message = "ファイルをアップロードしました。";
} else {
$error = "ファイルを保存できませんでした。";
}
}
}

$files = [];

foreach (scandir($uploadDirectory) as $file) {
if ($file !== "." && $file !== ".." && is_file($uploadDirectory . $file)) {
$files[] = $file;
}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ファイル管理アプリ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
  <section class="file-manager">
    <h1>ファイル管理アプリ</h1>

    <p class="description">
      ファイルをアップロードして、一覧からダウンロードできます。
    </p>

    <form method="POST" enctype="multipart/form-data">
      <label for="fileUpload">ファイルを選択</label>

      <input
              type="file"
              id="fileUpload"
              name="fileUpload"
              required
      >

      <p class="file-limit">
        最大ファイルサイズ：4MB
      </p>

      <button type="submit">
        アップロード
      </button>
    </form>

    <?php if ($message !== ""): ?>
    <div class="message">
      <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>

    <?php if ($error !== ""): ?>
    <div class="error">
      <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>

    <section class="file-list">
      <h2>アップロード済みファイル</h2>

      <?php if (count($files) === 0): ?>
      <p class="empty-message">
        まだファイルがありません。
      </p>
      <?php else: ?>
      <ul>
        <?php foreach ($files as $file): ?>
        <li>
                            <span class="file-name">
                                <?php echo htmlspecialchars($file); ?>
                            </span>

          <a
                  href="download.php?filename=<?php echo urlencode($file); ?>"
                  class="download-button"
          >
            ダウンロード
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </section>
  </section>
</main>

</body>
</html>