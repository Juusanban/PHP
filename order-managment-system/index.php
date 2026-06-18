<?php
require_once "db.php";

$db = new OrderDB();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $deleteId = (int)$_POST["delete_id"];
    $order = $db->getOrderById($deleteId);

    if ($order !== false) {
        $db->deleteOrder($deleteId);
    }

    header("Location: index.php");
    exit;
}

$orders = $db->getAllOrders();
?>

<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文管理システム</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <section class="order-manager">
        <h1>注文管理システム</h1>

        <p class="description">
            注文の追加、価格変更、削除ができます。
        </p>

        <div class="navigation">
            <a href="add_order.php" class="main-button">
                注文を追加
            </a>

            <a href="update_order.php" class="secondary-button">
                価格を変更
            </a>
        </div>

        <h2>注文一覧</h2>

        <?php if (count($orders) === 0): ?>
            <p class="empty-message">
                まだ注文がありません。
            </p>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>注文者</th>
                        <th>注文日時</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars((string)$order["ID"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($order["ITEM_NAME"]); ?>
                            </td>

                            <td>
                                <?php echo number_format((int)$order["PRICE"]); ?>円
                            </td>

                            <td>
                                <?php echo htmlspecialchars($order["CUSTOMER"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($order["ORDER_DATE"]); ?>
                            </td>

                            <td>
                                <form method="POST" action="index.php">
                                    <input
                                            type="hidden"
                                            name="delete_id"
                                            value="<?php echo htmlspecialchars((string)$order["ID"]); ?>"
                                    >

                                    <button type="submit" class="delete-button">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

</main>

</body>
</html>
