# おみくじアプリ

PHPのSessionとFetch APIを使用して作成した、簡単なおみくじアプリです。

ユーザーがログインした後、おみくじを引くことができます。
引いた結果はSessionに保存され、履歴として画面に表示されます。

## 主な機能

* ユーザーログイン
* PHP Sessionによるログイン状態の管理
* ランダムなおみくじ結果の表示
* 結果に対応した画像の表示
* おみくじ履歴の保存
* おみくじを引いた回数の表示
* 履歴のTXTファイルダウンロード
* ログアウト
* 入力フォームの簡単なバリデーション

## おみくじの種類

* 大吉
* 中吉
* 小吉
* 吉
* 末吉
* 凶
* 大凶

## 使用技術

* PHP
* HTML
* CSS
* JavaScript
* Fetch API
* JSON
* PHP Session

## ファイル構成


omikuji-app/
├── img/
│   ├── chukichi.png
│   ├── daikichi.png
│   ├── daikyo.png
│   ├── kichi.png
│   ├── kyo.png
│   ├── shokichi.png
│   └── suekichi.png
├── app.js
├── check.php
├── download.php
├── index.html
├── login.php
├── logout.php
├── omikuji.php
└── style.css


## 各ファイルの説明

* `index.html`
  アプリの画面を表示します。

* `style.css`
  画面のデザインを設定します。

* `app.js`
  ログイン、おみくじ、履歴表示などの画面処理を行います。

* `login.php`
  ユーザー情報を確認し、Sessionを開始します。

* `logout.php`
  Sessionを終了してログアウトします。

* `check.php`
  現在のログイン状態と履歴をJSON形式で返します。

* `omikuji.php`
  おみくじ結果をランダムに選び、Sessionに保存します。

* `download.php`
  おみくじ履歴をTXTファイルとしてダウンロードします。

## テストユーザー


ユーザーID: alice
パスワード: 1234

または

ユーザーID: bob
パスワード: 5678


## 実行方法

このアプリはPHPを使用しているため、GitHub Pagesでは実行できません。

XAMPPなどのローカルサーバー環境が必要です。

### 1. プロジェクトを配置する

XAMPPの`htdocs`フォルダ内にプロジェクトを配置します。


C:\xampp\htdocs\omikuji-app


### 2. Apacheを起動する

XAMPP Control PanelからApacheを起動します。

### 3. ブラウザで開く


http://localhost/omikuji-app/


## 処理の流れ

1. ユーザーIDとパスワードを入力する
2. JavaScriptから`login.php`へJSONデータを送信する
3. PHPがユーザー情報を確認する
4. ログイン成功後、Sessionにユーザー情報を保存する
5. おみくじを引くと、`omikuji.php`が結果をランダムに選ぶ
6. 結果をSessionの履歴に追加する
7. JavaScriptが結果と履歴を画面に表示する

