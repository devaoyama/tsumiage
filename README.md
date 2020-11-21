# tsumiage

## 説明

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
