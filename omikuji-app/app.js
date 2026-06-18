async function login() {
    const id = document.getElementById("userid").value.trim();
    const pw = document.getElementById("password").value;

    if (id === "" || pw === "") {
        alert("ユーザーIDとパスワードを入力してください。");
        return;
    }

    const response = await fetch("login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: id,
            pw: pw
        })
    });

    const data = await response.json();

    alert(data.message);

    if (data.success) {
        document.getElementById("password").value = "";
        checkStatus();
    }
}

async function logout() {
    await fetch("logout.php");

    alert("ログアウトしました。");

    document.getElementById("result").textContent =
        "結果がここに表示されます。";

    document.getElementById("result-img").style.display = "none";

    checkStatus();
}

async function drawOmikuji() {
    const response = await fetch("omikuji.php");
    const data = await response.json();

    document.getElementById("result").textContent =
        `結果：${data.result}`;

    const imgMap = {
        "大吉": "daikichi.png",
        "中吉": "chukichi.png",
        "小吉": "shokichi.png",
        "吉": "kichi.png",
        "末吉": "suekichi.png",
        "凶": "kyo.png",
        "大凶": "daikyo.png"
    };

    const imgName = imgMap[data.result] || "";
    const imgElement = document.getElementById("result-img");

    if (imgName !== "") {
        imgElement.src = "img/" + imgName;
        imgElement.style.display = "block";
    } else {
        imgElement.style.display = "none";
    }

    updateHistory(data.history);
}

async function checkStatus() {
    const response = await fetch("check.php");
    const data = await response.json();

    const loginArea = document.getElementById("login-area");
    const appArea = document.getElementById("app-area");

    if (data.loggedIn) {
        loginArea.style.display = "none";
        appArea.style.display = "block";

        document.getElementById("welcome").textContent =
            `こんにちは、${data.user}さん`;

        updateHistory(data.history);
    } else {
        loginArea.style.display = "block";
        appArea.style.display = "none";

        updateHistory([]);
    }
}

function updateHistory(history) {
    const historyList = document.getElementById("history");
    const drawCount = document.getElementById("draw-count");

    historyList.innerHTML = "";

    if (history.length === 0) {
        const listItem = document.createElement("li");

        listItem.textContent = "まだ履歴がありません。";
        listItem.classList.add("empty-history");

        historyList.appendChild(listItem);
    } else {
        for (const result of history) {
            const listItem = document.createElement("li");

            listItem.textContent = result;

            historyList.appendChild(listItem);
        }
    }

    drawCount.textContent =
        `おみくじを引いた回数：${history.length}回`;
}

function downloadHistory() {
    window.location.href = "download.php";
}

checkStatus();
