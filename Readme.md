
# 構築手順

## 1 php.iniをプロジェクト配下に置いてからDocker起動する
```terminal
docker compose up -d
```

## 2 userマスタへデータ登録まで
> Dockerが起動し終わったら、MySQLで以下を実施する。
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password)
VALUES ('admin', 'admin');

```
## 詳細はこちら
https://qiita.com/RIKIgigasu/items/f3dd368037f433a4c48e

##  Dockerイメージファイルをつくる 
```terminal
docker save -o docker-purephp-main-app.tar docker-purephp-main-app:latest
```
### MySQLデータをdumpしたものを出力(特定テーブルのみ)
```terminal
docker exec docker-purephp-main-db-1 mysqldump -u root -padmin dbcenter users > users_backup.sql
```

### スキーマ内すべてのテーブルをdumpして出力
```terminal
docker exec docker-purephp-main-db-1 mysqldump -u root -padmin dbcenter > dbcenter_backup.sql
```
