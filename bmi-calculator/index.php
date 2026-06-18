<?php
$height = "";
$weight = "";
$bmi = null;
$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $height = isset($_POST["height"]) ? trim($_POST["height"]) : "";
    $weight = isset($_POST["weight"]) ? trim($_POST["weight"]) : "";

    if ($height === "" || $weight === "") {
        $error = "身長と体重を入力してください。";
    } elseif (!is_numeric($height) || !is_numeric($weight)) {
        $error = "正しい数値を入力してください。";
    } elseif ($height <= 0 || $weight <= 0) {
        $error = "0より大きい数値を入力してください。";
    } else {
        $heightInMeters = $height / 100;
        $bmi = $weight / ($heightInMeters * $heightInMeters);
        $bmi = round($bmi, 1);

        if ($bmi < 18.5) {
            $message = "やせ気味です。";
        } elseif ($bmi < 25) {
            $message = "標準範囲です。";
        } else {
            $message = "太り気味です。";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BMI計算アプリ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <section class="calculator">
        <h1>BMI計算アプリ</h1>

        <p class="description">
            身長と体重を入力すると、BMIを計算します。
        </p>

        <form method="POST" action="">
            <label for="height">身長（cm）</label>
            <input
                    type="number"
                    id="height"
                    name="height"
                    step="0.1"
                    min="0.1"
                    value="<?php echo htmlspecialchars($height); ?>"
                    placeholder="例：170"
                    required
            >

            <label for="weight">体重（kg）</label>
            <input
                    type="number"
                    id="weight"
                    name="weight"
                    step="0.1"
                    min="0.1"
                    value="<?php echo htmlspecialchars($weight); ?>"
                    placeholder="例：65"
                    required
            >

            <button type="submit">計算する</button>
        </form>

        <?php if ($error !== ""): ?>
        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <?php if ($bmi !== null): ?>
        <div class="result">
            <p class="result-title">計算結果</p>

            <p class="bmi-value">
                BMI：<?php echo $bmi; ?>
            </p>

            <p>
                <?php echo htmlspecialchars($message); ?>
            </p>
        </div>
        <?php endif; ?>
    </section>
</main>

</body>
</html>

