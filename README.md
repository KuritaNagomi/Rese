# Rese
飲食店予約アプリ

<img width="1093" alt="スクリーンショット 2024-07-23 14 45 56" src="https://github.com/user-attachments/assets/7d55f72e-75cb-4270-8cf1-d626bf477f6e">

## 概要説明
より多くの人が気軽に食事を楽しめるよう、予約機能はわかりやすく、また検索機能や各店舗の紹介やレビュー等も合わせて見ることができお店を選びやすくしました。

## URL
トップ画面
http://52.197.169.191/
アプリ管理者用登録ページ
http://52.197.169.191/admin/register

## 機能一覧
ログイン前機能：店舗検索、店舗詳細ページ閲覧、ユーザー登録、メール認証
一般ユーザーログイン後：ログイン、お気に入り登録、店舗予約、予約変更・削除、レビュー投稿
アプリ管理者：ユーザー登録、店舗管理者登録
店舗管理者：予約状況確認、店舗情報作成、店舗情報更新、予約者へメール送信、予約リマインドメール自動送信

## 使用技術 Laravel 8.83.27, php

##　テーブル設計
<img width="478" alt="スクリーンショット 2024-07-23 16 02 10" src="https://github.com/user-attachments/assets/0fa4c22d-deee-4027-9f22-b25af7c32a38">
<img width="479" alt="スクリーンショット 2024-07-23 16 02 35" src="https://github.com/user-attachments/assets/4c9cef49-7521-4c73-9c80-3e01e567d40b">
<img width="477" alt="スクリーンショット 2024-07-23 16 03 01" src="https://github.com/user-attachments/assets/74b7720c-ae1f-4ad5-adaf-90d03254a517">

## ER図
![rese drawio](https://github.com/user-attachments/assets/76a7bfbb-7868-42c1-a959-2c96b742d670)

## 環境構築　Dockerビルド

git clone git@github.com:KuritaNagomi/Rese.git

docker-compose up -d --build

Laravel環境構築

docker-compose exec php bash

composer install

.env.exampleファイルから.envを作成し、環境変数を変更

php artisan key:generate php artisan migrate php artisan db:seed





