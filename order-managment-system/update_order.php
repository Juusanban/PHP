<?php
require_once "db.php";

$db = new OrderDB();

$orders = $db->getAllOrders();

$selectedId = "";
$price = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedId = isset($_POST["id"]) ? trim($_POST["id"]) : "";
    $price = isset($_POST["price"]) ? trim($_POST["price"]) : "";

    if ($selectedId === "" || $price === "") {
        $error = "注文と新しい価格を入力してください。";
    } elseif (!is_numeric($selectedId)) {
        $error = "正しい注文を選択してください。";
    } elseif (!is_numeric($price)) {
        $error = "価格は数値で入力してください。";
    } elseif ((int)$price <= 0) {
        $error = "価格は1円以上で入力してください。";
    } else {
        $order = $db->getOrderById((int)$selectedId);

        if ($order === false) {
            $error = "指定された注文が見つかりません。";
        } else {
            $db->updatePrice(
                (int)$selectedId,
                (int)$price
            );

            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>価格変更</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <section class="form-card">
        <h1>価格変更</h1>

        <p class="description">
            注文を選択して、新しい価格を入力してください。
        </p>

        <?php if ($error !== ""): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (count($orders) === 0): ?>
            <p class="empty-message">
                変更できる注文がありません。
            </p>
        <?php else: ?>
            <form method="POST" action="update_order.php">
                <label for="id">注文</label>

                <select id="id" name="id" required>
                    <option value="">注文を選択してください</option>

                    <?php foreach ($orders as $order): ?>
                        <option
                                value="<?php echo htmlspecialchars((string)$order["ID"]); ?>"
                            <?php
                            if ((string)$selectedId === (string)$order["ID"]) {
                                echo "selected";
                            }
                            ?>
                        >
                            ID <?php echo htmlspecialchars((string)$order["ID"]); ?>
                            —
                            <?php echo htmlspecialchars($order["ITEM_NAME"]); ?>
                            —
                            <?php echo number_format((int)$order["PRICE"]); ?>円
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="price">新しい価格</label>

                <input
                        type="number"
                        id="price"
                        name="price"
                        min="1"
                        value="<?php echo htmlspecialchars($price); ?>"
                        required
                >

                <button type="submit" class="main-button">
                    価格を変更する
                </button>
            </form>
        <?php endif; ?>

        <a href="index.php" class="back-link">
            注文一覧に戻る
        </a>
    </section>

</main>

</body>
</html>
