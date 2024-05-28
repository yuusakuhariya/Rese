# アプリケーション名
Rese（飲食店予約サービス）


## 作成した目的
* 外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL
* （awsで設定）

## 機能一覧
* 会員登録（名前、メールアドレス、パスワード）
*   ・コメントアウトにて、管理者、店舗代表者も登録できるように記載済み。
* ログイン
* ログアウト
* 飲食店一覧
* 地域検索
* ジャンル検索
* 店名検索（文字入力）
* 飲食店詳細
* 飲食店お気に入り追加
* 飲食店お気に入り削除
* マイページ表示
* 一般会員の飲食店お気に入り一覧取得
* 一般会員の飲食店予約情報取得
* 一般会員の飲食店予約情報変更
* 一般会員の飲食店予約削除
* 一般会員の飲食店先払い
* 一般会員の飲食店予約情報のQRコード生成
* 一般会員の飲食店来店後の評価
* 店舗代表者の店舗情報取得
* 店舗代表者の店舗情報の作成、更新
* 店舗予約一覧
* 店舗代表者によるQRコード読み込み後の来店確認情報取得（未・済）
* 一般会員への予約日のリマインダー送信（当日9:00自動送信）
* 管理者による店舗代表者登録
* 全ユーザー情報の一覧取得
* 全ユーザー情報の権限検索
* 全ユーザー情報の名前検索
* 各ユーザー情報の削除
* 一般館会員へのメール送信

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
![image](https://github.com/yuusakuhariya/Rese/assets/137383906/d6a16968-bd12-47c9-a7fd-51c82d266a49)


## ER図
![Rese](https://github.com/yuusakuhariya/Rese/assets/137383906/10b28cd3-05bd-407f-91b9-ecd761ef2b0e)


## 環境構築
* 概要
  * phpのフレームワークのLaravelをDocker-composeで動作させ、NginxでWebサーバーを構築し、mysqlでデータベースを管理し、PHPMyAdminで操作できるようにする手順。
* 以下のソフトウェアがインストールされていることを確認。
  * Docker (https://www.docker.com/)
  * Docker-compose (https://docs.docker.com/compose/)
* プロジェクトのディレクトリの作成。
* プロジェクトのクローン。
  * git clone （httpのgitクローンを乗せる）
  * 
* .env ファイル作成し、local環境設定実行。
  * cp .env.example .env
* Docker-composeコンテナをビルドして起動する。
  * docker-compose up -d --build
* Laravelアプリケーションをインストールし、アプリケーションキーを生成する。
  * docker-compose exec app composer install
  * docker-compose exec app php artisan key:generate
* データベースのマイグレーションを実行する。
  * php artisan migrate
* シーダーを実行する。
  * php artisan db:seed
* http://localhost にアクセスしてLaravelアプリケーションにアクセスできることを確認する。
* http://localhost:8080 にアクセスしてPhpMyAdminでデータベースを管理できることを確認する。
* メール機能の設定。
  * https://mailtrap.io/ にアクセスし登録する。（アカウント変更時のみ実施）
  * .env ファイルの設定。（アカウント変更時のみ.envファイル修正する）
    * 登録した情報を設定する。
  * リマインダー機能の実行。
    * ターミナルで、"crontab -e" を実行しcron設定する。
    * 最後の行に、 "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" を追加する。
    * php コンテナに入り、 "root@0ccf6d48031b:/var/www# php artisan schedule:work" を実行する。
    * 解除する際は "ctl＋c" ボタンで解除。
* 支払い機能の設定。（テストデータで実行中）
  * laravel cashierのインストール
    * "composer.json"ファイル内の"require"セクションで、"laravel/cashier" のバージョンを "laravel/cashier": "^13.0" へ変更する。
    * php コンテナに入り、 "composer update" を実行する。
    * php コンテナに入り、 "composer require laravel/cashier" を実行しインストールする。
  * データベースの追加
    * "laravel/cashier" インストール後、php コンテナに入り、 "php artisan migrate" 実行し、各テーブルとカラムが作成される。
  * Stripeのアカウント登録。（アカウント変更時のみ実施）
    * https://dashboard.stripe.com/login?locale=ja-JP にアクセスし登録。
  * .env ファイルの設定。（アカウント変更時のみ.envファイル修正する）

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
* 予約削除時、払い戻しは不可とする。
* 予約時に先払いの金額を入力可能。
