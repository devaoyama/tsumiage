# tsumiage

## 説明

### 1. タスクを追加
![スクリーンショット 2020-11-22 0 32 38](https://user-images.githubusercontent.com/56750754/99881370-bc23ac80-2c5c-11eb-81ec-2d592f8dd83f.png)

### 2. タスクをこなす

### 3. ツイートする
![スクリーンショット 2020-11-22 0 33 51](https://user-images.githubusercontent.com/56750754/99881371-be860680-2c5c-11eb-8dc3-b022667678e2.png)

### 4. ツイート完了!!

## 目的

- Twitterでの積み上げツイートをWebアプリで管理できること
- １日のやることがひと目でわかること
- Webアプリからツイートできること

## 使用技術

- PHP/Laravel
- Bootstrap
- TwitterApi

## ビルド方法

### 1. ライブラリをインストール

```
$ composer install
```

### 2. Twitter API KEY と Secretを取得してenvファイルに設定

[Twitter Developers](https://developer.twitter.com/en/apps)


### 3. 環境変数の設定

```
$ cp .env.example .env
```

Twitter API KEY & Secret と　Mysql情報の入力

```
$ php artisan key:generate
```
