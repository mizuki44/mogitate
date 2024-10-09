## アプリケーション名
「もぎたて（mogitate）」

## 作成目的
このアプリはLaravel学習の総まとめとして作成しました。 与えられた要件や成果物イメージをもとに、テーブル定義・ER図作成・コーディングをおこないました。

## アプリケーションURL
開発環境<BR>
+ ユーザーサイト：http://localhost/products
+ phpMyAdmin：http://localhost:8080/

## 機能一覧
+ 商品一覧表示機能
+ 商品検索機能
+ 商品詳細表示機能
+ 商品登録機能
+ 商品更新機能
+ 商品削除機能
+ シンボリックリンクを使用した画像保存機能
+ 季節の複数選択機能
+ 並べ替え検索機能

## 使用技術
+ PHP 7.4.9
+ Laravel 8.83.27
+ MySQL　8.0.26

## テーブル設計
<img width="620" alt="スクリーンショット 2024-10-09 20 34 08" src="https://github.com/user-attachments/assets/91d17e63-8c37-4a32-9756-495d56e82989">
<img width="620" alt="スクリーンショット 2024-10-09 20 34 21" src="https://github.com/user-attachments/assets/56614bab-7c3f-47a2-9d39-3fba3d83cc82">


## ER図
<img width="747" alt="スクリーンショット 2024-10-09 20 44 36" src="https://github.com/user-attachments/assets/1376f3a5-123e-4cde-b01a-700f80e56e10">



## 環境構築
### Dockerビルド
1. git clone git@github.com:mizuki44/mogitate.git
2. cd mogitate
3. DockerDesktopアプリを立ち上げる
4. docker-compose up -d --build<BR>
   ※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。


## Laravel環境構築
1. コンテナに入る<BR>docker-compose exec php bash
2. composerをインストールする<BR>composer install
3. 「src/.env.example」のファイル名を「.env」に変更し、以下の内容を変更する<BR>
   ```
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass
    ```
4. keyを生成する<BR>php artisan key:generate
5. マイグレーションの実行<BR>php artisan migrate
6. シーディングの実行<BR>php artisan db:seed
7. シンボリックリンクの作成<BR>php artisan storage:link

### 動作確認
以下のURLにアクセスできたら成功です。<BR>
http://localhost/products

コンテナの停止
以下のコマンドでコンテナを停止することができます。<BR>
docker-compose down

