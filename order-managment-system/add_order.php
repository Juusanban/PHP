<?php
require_once "db.php";

$item = "";
$price = "";
$customer = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item = isset($_POST["item"]) ? trim($_POST["item"]) : "";
    $price = isset($_POST["price"]) ? trim($_POST["price"]) : "";
    $customer = isset($_POST["customer"]) ? trim($_POST["customer"]) : "";

    if ($item === "" || $price === "" || $customer === "") {
        $error = "すべての項目を入力してください。";
    } elseif (!is_numeric($price)) {
        $error = "価格は数値で入力してください。";
    } elseif ((int)$price <= 0) {
        $error = "価格は1円以上で入力してください。";
    } else {
        $db = new OrderDB();

        $db->insertOrder(
            $item,
            (int)$price,
            $customer
        );

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文追加</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <section class="form-card">
        <h1>注文追加</h1>
        
        <p class="description">
            新しい注文情報を入力してください。
        </p>

        <?php if ($error !== ""): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="add_order.php">
            <label for="item">商品名</label>
            <input
                    type="text"
                    id="item"
                    name="item"
                    value="<?php echo htmlspecialchars($item); ?>"
                    required
            >

            <label for="price">価格</label>
            <input
                    type="number"
                    id="price"
                    name="price"
                    min="1"
                    value="<?php echo htmlspecialchars($price); ?>"
                    required
            >

            <label for="customer">注文者</label>
            <input
                    type="text"
                    id="customer"
                    name="customer"
                    value="<?php echo htmlspecialchars($customer); ?>"
                    required
            >

            <button type="submit" class="main-button">
                追加する
            </button>
        </form>

        <a href="index.php" class="back-link">
            注文一覧に戻る
        </a>
    </section>

</main>

</body>
</html>
