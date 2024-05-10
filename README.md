# アプリケーション名
Rese（飲食店予約サービス）


## 作成した目的
* 外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL
* （awsで設定）

## 機能一覧
* 会員登録（名前、メールアドレス、パスワード）
* ログイン（ユーザー、店舗代表者、管理者）
* ログアウト
* 飲食店一覧
* エリア検索
* ジャンル検索
* 店名検索
* 飲食店詳細
* 飲食店お気に入り追加
* 飲食店お気に入り削除
* 飲食店予約情報追加
* 飲食店予約情報削除
* ユーザー情報取得（マイページ取得）
* ユーザー飲食店お気に入り一覧取得
* ユーザー飲食店予約情報取得
* ユーザー飲食店予約情報変更
* ユーザー飲食店先払い
* ユーザー飲食店予約情のQRコード生成
* ユーザー飲食店来店後の評価
* 店舗代表者ページ取得
* 店舗代表者の店舗情報取得
* 店舗代表者の店舗情報の作成、更新
* 店舗予約情報確認
* 店舗代表者によるQRコード読み込み後の来店確認情報取得
* 店舗代表者からユーザへのメール送信
* ユーザーへの予約日のリマインダー送信（当日9:00自動送信）
* 管理者ページ取得
* 管理者の店舗代表者登録
* 全ユーザー情報の一覧取得
* 全ユーザー情報の権限にて検索
* 全ユーザー情報の名前検索
* 全ユーザー情報の削除

## 使用技術
*Laravel 8.83.8
* Docker 3.8
* nginx 1.21.1
* php 
* mysql 8.0.26
* phpmyadmin
* mailtrap
* stripe
* AWS
* EC2
* RDS
* S3

## テーブル設計
（エクセルのテーブル設計載せる）

## ER図
![Rese](https://github.com/yuusakuhariya/Rese/assets/137383906/2cd9e9ce-bd5d-4755-90f7-f9fe8995666c)


## 環境構築
* 概要
  * LaravelをDockerで動作させ、NginxでWebサーバーを構築し、PHPMyAdminでデータベースを管理するための手順。
* 以下のソフトウェアがインストールされていることを確認。
  * Docker (https://www.docker.com/)
  * Docker-compose (https://docs.docker.com/compose/)
* プロジェクトのクローン。
  * git clone （httpのgitクローンを乗せる）
* env ファイル作成し、local環境設定実行。
  * cp .env.example .env
* Dockerコンテナをビルドして起動する。
  * docker-compose up -d --build
* Laravelアプリケーションをインストールし、アプリケーションキーを生成する。
  * docker-compose exec app composer install
  * docker-compose exec app php artisan key:generate
* データベースのマイグレーションを実行する。
  * artisan migrate
* http://localhost にアクセスしてLaravelアプリケーションにアクセスできることを確認する。
* http://localhost:8080 にアクセスしてPhpMyAdminでデータベースを管理できることを確認する。
* https://mailtrap.io/ にアクセスし登録。
* https://dashboard.stripe.com/login?locale=ja-JP にアクセスし登録。

## 本番環境構築
* 概要
* AWSのアカウント登録
* EC2の設定
* SSHに接続し、作業ディレクトリの作成、移動後、必要なソフトウェアのインストール実行。
  * dockerのインストール
  * docker-composeのインストール
  * gitのインストール
* プロジェクトのクローン
  * git clone （httpのgitクローンを乗せる）
* .env ファイル作成し、本番環境設定実行。
  * cp .env.example .env
* Laravelアプリケーションをインストールし、アプリケーションキーを生成する。
  * docker-compose exec app composer install
  * docker-compose exec app php artisan key:generate 
* .env ファイルのAPP部分の修正
* RDSの設定
* データベースのマイグレーションを実行する。
  * artisan migrate
* .env ファイルのDB部分の修正
* S3の設定
* .env ファイルのAWS部分の修正
* 画像をS3のストレージに保存
  * コードの修正
* EC2のIPv4アドレス（HTTP）に接続しブラウザに表示される。

## 他記載内容
