
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

### docker中身を確認
```terminal
docker exec -it docker-purephp-main-app-1 bash
root@66b4ce616e2a:/var/www/html# 
root@66b4ce616e2a:/var/www/html#
root@66b4ce616e2a:/var/www/html# ls
config.php  db.php  login.php  logout.php  mypage.php  test1.py
root@66b4ce616e2a:/var/www/html# 
```

### docker再起動～反映
```terminal
docker compose down
docker compose up -d --build
```

### 配列の形でログ確認したい
```terminal
error_log(print_r($配列,true))
```

### PowerShell で 常に Docker コンテナ内の Apache/PHP のログをリアルタイム監視する方法
```terminal
docker logs -f docker-purephp-main-app-1
```

### test2.php　を動かしたいときは
```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL
);
```
> 上記テーブル作成し、データ投入してあること。

### 画面表示
http://localhost:8080/login.php