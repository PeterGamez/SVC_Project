# Intra Check

## ขั้นตอนการติดตั้ง

### กรณีมี path public
- ไม่ต้องทำอะไรเพิ่มเติม

### กรณีไม่มี path public
- สำหรับ apache ให้เพื่มไฟล์ .htaccess ดังนี้ ใน root directory
```bash
RewriteEngine on

RewriteCond %{REQUEST_URI} !^public
RewriteRule ^(.*)$ public/$1 [L]
```
- สำหรับ nginx ให้แก้ไขไฟล์ config ดังนี้
```bash
location / {
    try_files $uri $uri/ /public/index.php?$is_args$args;
    autoindex on;
}
```