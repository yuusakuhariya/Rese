# アプリケーション名
Rese（飲食店予約サービス）


## 作成した目的
* 外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL
* （awsで設定）

## 機能一覧
* 会員登録（名前、メールアドレス、パスワード）
  * コメントアウトにて、管理者、店舗代表者も登録できるように記載済み。
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
* 管理者から一般館会員へのメール送信

## 使用技術
* Laravel 8.83.8
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
### 概要
  * php のフレームワークの Laravel を Docker-compose で動作させ、Nginx でWebサーバーを構築し、mysql でデータベースを管理し、PHPMyAdmin で操作できるようにする手順
### 以下のソフトウェアがインストールされていることを確認
  * Docker (https://www.docker.com/)
  * Docker-compose (https://docs.docker.com/compose/)
### プロジェクトのディレクトリの作成。
### プロジェクトの git クローン
  * https://github.com/yuusakuhariya/Rese.git
### .env ファイル作成し、local 環境設定実行
  * cp .env.example .env
  * .env ファイル設定する（下記に.env ファイル記載）
### Docker-compose コンテナをビルドして起動する
  * docker-compose up -d --build
### Laravelアプリケーションをインストールし、アプリケーションキーを生成する
  * docker-compose exec app composer install
  * docker-compose exec app php artisan key:generate
### データベースのマイグレーションを実行する
  * php artisan migrate
### シーダーを実行する
  * php artisan db:seed
### http://localhost にアクセスして Laravel アプリケーションにアクセスできることを確認する
### http://localhost:8080 にアクセスして PhpMyAdmin でデータベースを管理できることを確認する
### メール機能の設定。（現在は作成者のアカウントが登録済み）
  * https://mailtrap.io/ にアクセスし登録する。（アカウント変更時のみ実施）
  * .env ファイルの設定。（アカウント変更時のみ .env ファイル修正する）
    * 登録した情報を設定する
  * リマインダー機能の実行
    * ターミナルで、"crontab -e" を実行しcron設定する
    * 最後の行に、 "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" を追加する
    * php コンテナに入り、 "root@0ccf6d48031b:/var/www# php artisan schedule:work" を実行する
    * 解除する際は "ctl＋c" ボタンで解除
### 支払い機能の設定。（現在は作成者のアカウントが登録済み、テストデータで実行中）
  * laravel cashier のインストール
    * "composer.json" ファイル内の "require" セクションで、"laravel/cashier" のバージョンを "laravel/cashier": "^13.0" へ変更する
    * php コンテナに入り、 "composer update" を実行する
    * php コンテナに入り、 "composer require laravel/cashier" を実行しインストールする
  * データベースの追加
    * "laravel/cashier" インストール後、php コンテナに入り、 "php artisan migrate" 実行し、各テーブルとカラムが作成される
  * Stripeのアカウント登録。（アカウント変更時のみ実施）
    * https://dashboard.stripe.com/login?locale=ja-JP にアクセスし登録
  * .env ファイルの設定。（アカウント変更時のみ.envファイル修正する）

### lacal環境の完成
* local環境の.env ファイル
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:kJVo2JRMTm3R8713OjfnF5xGnrkBs5gY4EeHSqVZx7g=  // docker-compose exec app php artisan key:generateで自動挿入
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=81d6d5183afb7e  // mailtrapのユーザー名（現在は開発者のユーザー名指定）
MAIL_PASSWORD=1ff2023996b4b2  // mailtrapのパスワード（現在は開発者のパスワード指定）
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yuusaku08030213@yahoo.co.jp  // 送信元のメールアドレス（現在は開発者のメールアドレス指定）
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

STRIPE_KEY=pk_test_51P2nYJCaZBJlTawRqBynctR6PDDGaPAlheOKouITqvVF2CUzxlqtSYphCWhnwZIIVF35MxV2SLfC6LQ2FDu0agdc00ilY41xsQ
STRIPE_SECRET=sk_test_51P2nYJCaZBJlTawRIxuT2qrpVrwr6lc666fwteHxldZf4muZbpZPkdVdpAg4TmLKazL98HA0E9RBwUn8PTS65a5u00Qone0NZ3
```

## 本番環境構築（簡易手順）
### AWS のアカウント登録
### EC2 の設定
### SSH に接続
### 作業ディレクトリの作成
### 作業ディレクトリに移動後、必要なソフトウェアのインストール実行
  * docker のインストール
  * docker-compose のインストール
  * git のインストール
### プロジェクトの git クローン
  * https://github.com/yuusakuhariya/Rese.git
### .env ファイル作成し、本番環境設定実行（下記に .env ファイル記載）
  * cp .env.example .env
### docker-compose.yml の修正（下記に docker-compose.yml ファイル記載）
### Laravel アプリケーションをインストールし、アプリケーションキーを生成する
  * docker-compose exec app composer install
  * docker-compose exec app php artisan key:generate 
### .env ファイルのAPP部分の修正
### RDS の設定
### データベースのマイグレーションを実行する
  * artisan migrate
### .env ファイルの DB 部分の修正
### S3 の設定
  * .env ファイルの AWS 部分の修正
### 画像を S3 のストレージに保存
  * ブロックパブリックアクセス(バケット設定)の項目を全てOFFにする
  * パケットポリシーの修正
```
    {
       "Version": "2012-10-17",
       "Statement": [
           {
            "Effect": "Allow",
            "Principal": {
                "AWS": "arn:aws:iam::851725312291:role/coachtech-aws-s3-from-ec2"
            },
            "Action": "s3:*",
            "Resource": ["arn:aws:s3:::bucket-coachtech-aws-rese","arn:aws:s3:::bucket-coachtech-aws-rese/*"]
           },
           {
            "Effect": "Allow",
            "Principal": "*",
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::bucket-coachtech-aws-rese/*"
           }
        ]
    }
```
  * コードの修正（ShopManegerController.php）
```
  <?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\ShopManegerFormRequest;
use Illuminate\Support\Facades\Storage;  // ここ追加


class ShopManegerController extends Controller
{
    public function shopStore(ShopManegerFormRequest $request)
    {
        $user = auth()->user();
        $area_name = $request->area_name;
        $genre_name = $request->genre_name;
        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);
        $path = Storage::disk('s3')->put('images', $request->file('img_path'));  // ここを追加

        Shop::create([
            'shop_name' => $request->shop_name,
            'user_id' => $user->id,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'img_path' => $request->file('img_path')->store('public/images'),  // ここは削除
            'img_path' => Storage::disk('s3')->url($path),  // ここを追加
        ]);
        return redirect()->back();
    }

    public function shopUpdate(ShopManegerFormRequest $request)
    {
        $area_name = $request->area_name;
        $genre_name = $request->genre_name;
        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);
        $shopId = $request->id;
        $path = Storage::disk('s3')->put('images', $request->file('img_path'));  // ここを追加

        shop::where('id', $shopId)->update([
            'shop_name' => $request->shop_name,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'img_path' => $request->file('img_path')->store('public/images'),  // ここは削除
            'img_path' => Storage::disk('s3')->url($path),  // ここ追加
        ]);

        return redirect()->back();
    }

}
```
  * 必要パッケージのインストール
    * php コンテナに入り、 "composer require league/flysystem-aws-s3-v3 ~1.0" を実行する
### EC2のIPv4 アドレス（HTTP）に接続しブラウザに表示される
### 本番環境の完成
* 本番環境の.envファイル
```

```

* 本番環境のdocker-compose.yml
```

```

## 他記載内容
### 予約削除時、払い戻しは不可とする。
### 予約時に先払いの金額入力可能。
### QRコード読み取り方法
  * QRコードを読み取りできるカメラにて読み取りする。
  * QRコードを読み取ったらログインページへ。
  * その店舗代表者がログインし、予約リストの確認をすると、来店項目が「済」になっている。
