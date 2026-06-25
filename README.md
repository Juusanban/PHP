# PHP学習プロジェクト集


フォーム処理、Session、JSON、ファイルアップロード、SQLite、PDO、CRUD処理など、PHPの基本的な機能を使っています。

## プロジェクト一覧

### Omikuji App

PHP SessionとFetch APIを使用したおみくじアプリです。

ログイン後におみくじを引くことができ、結果の履歴を画面に表示します。
履歴はTXTファイルとしてダウンロードできます。

使用技術

* PHP
* HTML
* CSS
* JavaScript
* Fetch API
* JSON
* PHP Session

### BMI Calculator

身長と体重からBMIを計算するアプリです。

フォームから送信された値をPHPで受け取り、BMIと判定結果を表示します。

使用技術

* PHP
* HTML
* CSS

### Simple File Manager

ファイルをアップロードし、一覧からダウンロードできるアプリです。

ファイルサイズの確認、重複ファイル名の確認、アップロード済みファイルの一覧表示を行います。

使用技術

* PHP
* HTML
* CSS
* File Upload

### Order Management System

PHPとSQLiteを使用した注文管理システムです。

注文の追加、一覧表示、価格変更、削除ができます。
データベース処理は`OrderDB`クラスにまとめています。

使用技術

* PHP
* HTML
* CSS
* SQLite
* PDO
* SQL

## リポジトリ構成

* omikuji-app
* bmi-calculator
* simple-file-manager
* order-management-system

## 学習内容

* PHPの基本構文
* フォーム処理
* 入力値チェック
* Session管理
* JSON通信
* ファイルアップロード
* ファイルダウンロード
* SQLite
* PDO
* Prepared Statement
* CRUD処理
* PHPクラスの基本

## 実行について

このリポジトリのプロジェクトはPHPを使用しているため、GitHub Pagesでは実行できません。

動作確認には、XAMPPなどのPHP実行環境が必要です。


