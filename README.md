# アプリケーション名
Rese（飲食店予約サービス）


## 作成した目的
* 外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL
* 54.65.164.125（awsで設定中）

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
* 一般ユーザーの飲食店お気に入り一覧取得
* 一般ユーザーの飲食店予約情報取得
* 一般ユーザーの飲食店予約情報変更
* 一般ユーザーの飲食店予約削除
* 一般ユーザーの飲食店先払い
* 一般ユーザーの飲食店予約情報のQRコード生成
* 一般ユーザーの飲食店来店後の評価
* 店舗代表者の店舗一覧
* 店舗代表者の店舗の作成
* 店舗代表者の店舗の更新
* 店舗代表者の予約一覧
* 店舗代表者によるQRコード読み込み後の来店確認情報取得（未・済）
* 一般ユーザーへの予約日のリマインダー送信（当日9:00自動送信）
* 管理者による店舗代表者登録
* 全ユーザー情報の一覧取得
* 全ユーザー情報の権限検索
* 全ユーザー情報の名前検索（文字入力）
* 各ユーザー情報の削除
* 管理者から一般ユーザーへのメール送信

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
### 作業ディレクトリの作成
### 作業ディレクトリに移動後、必要なソフトウェアのインストール実行
  * Docker (https://www.docker.com/)
  * Docker-compose (https://docs.docker.com/compose/)
### プロジェクトの git クローン
  * https://github.com/yuusakuhariya/Rese.git
### .env ファイル作成し、local 環境設定実行
  * cp .env.example .env
  * .env ファイル設定する（下記に .env ファイル記載）
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
### メール機能の設定（現在は開発者のアカウントが登録済み、テストメール機能実行中）
  * https://mailtrap.io/ にアクセスし登録する。（アカウント変更時のみ実施）
  * .env ファイルの設定。（アカウント変更時のみ .env ファイル修正する）（下記に .env ファイル記載）
    * 登録した情報を設定する
  * リマインダー機能の実行
    * ターミナルで、"crontab -e" を実行しcron設定する
    * 最後の行に、 "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" を追加する
    * php コンテナに入り、 "root@0ccf6d48031b:/var/www# php artisan schedule:work" を実行する
    * 解除する際は "ctl＋c" ボタンで解除
    * リマインダーの時刻はAM9:00で固定（時間変更の際は開発者へ）
### 支払い機能の設定（現在は開発者のアカウントが登録済み、テストデータで実行中）
  * laravel cashier のインストール
    * "composer.json" ファイル内の "require" セクションで、"laravel/cashier" のバージョンを "laravel/cashier": "^13.0" へ変更する
    * php コンテナに入り、 "composer update" を実行する
    * php コンテナに入り、 "composer require laravel/cashier" を実行しインストールする
  * データベースの追加
    * "laravel/cashier" インストール後、php コンテナに入り、 "php artisan migrate" 実行するとカラムが追加される
  * Stripeのアカウント登録。（アカウント変更時のみ実施）
    * https://dashboard.stripe.com/login?locale=ja-JP にアクセスし登録
  * .env ファイルの設定。（アカウント変更時のみ.envファイル修正する）（下記に .env ファイル記載）

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

DB_CONNECTION=mysql  // サービス名
DB_HOST=mysql  // ホスト名
DB_PORT=3306  // ポート番号
DB_DATABASE=laravel_db  // データベース名
DB_USERNAME=laravel_user  // データベースのユーザー名
DB_PASSWORD=laravel_pass  // データベースのパスワード

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

STRIPE_KEY=pk_test_51P2nYJCaZBJlTawRqBynctR6PDDGaPAlheOKouITqvVF2CUzxlqtSYphCWhnwZIIVF35MxV2SLfC6LQ2FDu0agdc00ilY41xsQ  // stripeのキー（現在は開発者のキー指定）
STRIPE_SECRET=sk_test_51P2nYJCaZBJlTawRIxuT2qrpVrwr6lc666fwteHxldZf4muZbpZPkdVdpAg4TmLKazL98HA0E9RBwUn8PTS65a5u00Qone0NZ3  // stripeのシークレットキー（現在は開発者のシークレットキー指定）
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
### Docker-compose コンテナをビルドして起動する
  * docker-compose up -d --build
### Laravel アプリケーションをインストールし、アプリケーションキーを生成する
  * docker-compose exec app composer install
  * docker-compose exec app php artisan key:generate
### .env ファイルのAPP部分の修正（下記に .env ファイル記載）
### 支払い機能の設定
  * local環境の.envファイルと同様に設定する
### RDS の設定
### データベースのマイグレーションを実行する
  * artisan migrate
### シーダーを実行する
  * php artisan db:seed
### .env ファイルの DB 部分の修正（下記に .env ファイル記載）
### S3 の設定（下記に .env ファイル記載）
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
### EC2のElastic IPアドレスを設定し、IPアドレスを固定
  * EC2インスタンスに関連付け
### Elastic IPアドレス（HTTP）に接続しブラウザに表示される
  * 54.65.164.125 


### 本番環境設定の完成
* 本番環境の.envファイル
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:7UYr97dRkEkV2XgKc6CwsnLtbxrAutoB4TZVHeirB04=　// docker-compose exec app php artisan key:generateで自動挿入 
APP_DEBUG=true
APP_URL=http://54.95.11.238  // Elastic IPアドレスを指定

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql  // RDSのサービス名
DB_HOST=coachtech-rese-db.choe4eoeo7z5.ap-northeast-1.rds.amazonaws.com  // データベースのエンドポイント
DB_PORT=3306  // ポート番号
DB_DATABASE=coachtech_laravel_Rese  // データベース名
DB_USERNAME=coachtech_Rese1  // データベースのユーザー名
DB_PASSWORD=coachtech-Rese  // データベースのパスワード

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

MAIL_MAILER=smtp  // メール機能のサービス名
MAIL_HOST=sandbox.smtp.mailtrap.io  // mailtrapホスト名
MAIL_PORT=2525  // ポート番号
MAIL_USERNAME=81d6d5183afb7e  // mailtrapのユーザー名（現在は開発者のユーザー名指定）
MAIL_PASSWORD=1ff2023996b4b2  // mailtrapのユーザー名（現在は開発者のパスワード指定）
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yuusaku08030213@yahoo.co.jp  // 送信元のメールアドレス（現在は開発者のメールアドレス指定）
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID= // AWSのアクセスキー（キーは開発者に直接聞いてください）
AWS_SECRET_ACCESS_KEY= // AWSのシークレットアクセスキー（キーは開発者に直接聞いてください）
AWS_DEFAULT_REGION=ap-northeast-1  // リージョン名
AWS_BUCKET=bucket-coachtech-aws-rese  // バケット名
AWS_USE_PATH_STYLE_ENDPOINT=false 

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

STRIPE_KEY=pk_test_51P2nYJCaZBJlTawRqBynctR6PDDGaPAlheOKouITqvVF2CUzxlqtSYphCWhnwZIIVF35MxV2SLfC6LQ2FDu0agdc00ilY41xsQ  // stripeのキー（現在は開発者のキー指定）
STRIPE_SECRET=sk_test_51P2nYJCaZBJlTawRIxuT2qrpVrwr6lc666fwteHxldZf4muZbpZPkdVdpAg4TmLKazL98HA0E9RBwUn8PTS65a5u00Qone0NZ3  // stripeのシークレットキー（現在は開発者のシークレットキー指定）

```

* 本番環境のdocker-compose.yml
```
version: '3.8'

services:
    nginx:
        image: nginx:1.21.1
        ports:
            - "80:80"
        volumes:
            - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
            - ./src:/var/www/
        depends_on:
            - php

    php:
        build: ./docker/php
        volumes:
            - ./src:/var/www/

    mysql:
        image: mysql:8.0.26
        environment:
            MYSQL_ROOT_PASSWORD: 
            MYSQL_DATABASE: coachtech_laravel_Rese  // RDSのデータベース名
            MYSQL_USER: coachtech_Rese1  // RDSのデータベースのユーザー名
            MYSQL_PASSWORD: coachtech-Rese  // RDSのデータベースのパスワード
        command:
            mysqld --default-authentication-plugin=mysql_native_password
        volumes:
            - ./docker/mysql/data:/var/lib/mysql
            - ./docker/mysql/my.cnf:/etc/mysql/conf.d/my.cnf

    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        environment:
            - PMA_ARBITRARY=1
            - PMA_HOST=coachtech-rese-db.choe4eoeo7z5.ap-northeast-1.rds.amazonaws.com  // SDRのエンドポイント
            - PMA_USER=coachtech_Rese1  // RDSのデータベースのユーザー名
            - PMA_PASSWORD=coachtech-Rese  // RDSのデータベースのパスワード
        depends_on:
            - mysql
        ports:
            - 8080:80
```
## 他記載内容
### 本番環境に関しては、AWSのIPアドレスの固定（Elastic IPアドレス）が設定されているため、Elastic IPアドレスで確認をして下さい。
### 言語は全て日本語使用
### 予約削除時、払い戻しは不可とする
### 予約時に先払いの金額入力可能
### QRコード読み取り方法
  * QRコードを読み取りできるカメラにて読み取りする。
  * QRコードを読み取ったらログインページURLへ。
  * その店舗代表者がログインし、予約リストの確認をすると、来店項目が「済」になっている。
    * データベースが更新されているのを確認。
### メール認証について
  * メール認証は mailtrap を使用。
  * ユーザーはご自身で登録。（メール認証必要）
  * 店舗代表者は管理者によって登録。（メール認証不要）
  * 管理者の登録は開発者によって登録。（メール認証不要）
### メール機能について
  * メール機能は mailtrap を使用。
  * local環境でテスト実施して下さい。
### 支払い機能について
  * 支払い環境は stripe を使用。（テスト機能で実施）
  * local環境でテスト実施して下さい。
### リマインダー機能について
  * local環境でテスト実施して下さい 。
### シーダー内容（初期データ）
| role   | name | email         | password  |
|:-------|------|---------------|----------:|
| admin  | a    | a@yahoo.co.jp | a1234567  |
| shop   | b    | b@yahoo.co.jp | b1234567  |
| user   | c    | c@yahoo.co.jp | c1234567  |
  * shopデータは案件シート参照（全ての初期店舗データは b に紐付けされています）
### ユーザー登録時のコメントアウトについて
  * 開発者が管理者の依頼を受け、簡易的にユーザー、店舗代表者、管理者を登録できるように auth/register.blade.php ファイルで登録箇所をコメントアウトしている。
```
<div class="role">
                    <label class="role-type" for="role">登録タイプ</label>
                    <select name="role">
                        <option value="user">ユーザー</option>
                        <!-- <option value="">選択してください</option> -->
                        <!-- <option value="user">ユーザー</option> -->
                        <!-- <option value="shop">店舗代表者</option> -->
                        <!-- <option value="admin">管理者</option> -->
                    </select>
                    <div class="form_error">
                        @error('role')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
```

# 追加実装
## 機能一覧
* 口コミ投稿
* 口コミ編集
* 口コミ削除
* 店舗口コミ一覧
* 全店舗ソート
* 管理者による店舗csvインポート
## テーブル設計（追加）
* 「reviews」テーブルに「img_path」カラムを追加。
## 基本設計書（追加と修正）
### View
  * admin_menu_review_list.blade.php
  * admin_review_list.blade.php
  * review_list.blade.php
  * reviewEdit.blade.php
### Route Controller
|         パス         | メソッド | ルート先コントローラー |     アクション     | 認証必須 |       説明         |
|:---------------------|---------|----------------------|-------------------|---------|-------------------:|
| /admin_review_List   | get     | AdminController      | adminReviewList   |         | 全レビューリスト一覧 |
| /admin_review_delete | delete  | AdminController      | adminReviewDelete |         | レビュー削除        |
| /import_shop         | post    | AdminController      | csvImportSho      |         | csvインポート       |
| /review_delete/{id}  | delete  | ReviewController     | reviewDelete      |         | レビュー削除        |
| /review_edit/{id}    | get     | ReviewController     | reviewEdit        |         | レビュー編集ページ   |
| review_update/{id}   | put     | ReviewController     | reviewUpdate      |         | レビュー更新        |
| /review_list/{id}    | get     | ReviewController     | reviewList        |         | 店舗ごとレビュー一覧 |
### imports
* shopImport.php
  * shopImport.phpにバリデーションルール記載。
### 口コミ機能
* 店舗詳細ページに追加。
  * 未ログイン時、選択店舗の全口コミ表示。
  * ログイン済時、選択店舗の全口コミ表示、口コミがまだない場合、「投稿」ボタンにて口コミ作成可能。
  * ログイン済時、選択店舗の全口コミ表示、口コミがある場合、「編集」ボタンにて口コミ編集可能、「削除」ボタンにて口コミ削除可能。
  * 管理者ページの「レビュー一覧」から全レビューの表示と削除可能。
### 店舗一覧ソート機能
* 「ランダム」「地域」「ジャンル」「評価高い」「評価低い」のソート機能。
  * 評価が一件もない場合は評価平均値は未表示。
  * 評価が一件もない場合は「評価高い」「評価低い」時は最後尾に表示。
  * コメントアイコンは評価の数が表示され、コメントアイコンを押すとその店舗の全評価詳細ページへ移動する。
### csvインポート
* laravelのmaatwebsite/excelパッケージを使用。
* 管理者ページの「店舗代表者登録 店舗CSV登録」からcsvファイルインポート可能。
### CSVファイルのヘッダーの内容
| 店舗名 | ID | 地域名 | ジャンル名 | 店舗概要 | 画像URL |
|:-------|----|-------|-----------|---------|--------:|
* 「ID」は管理者ページにて選択するため、csvファイルでは空欄にする。
