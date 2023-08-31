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

## อ้างอิง
backend template จาก [SB Admin 2](https://github.com/StartBootstrap/startbootstrap-sb-admin-2)

library และ framework ที่ใช้ในการพัฒนา
- [AOS](https://github.com/michalsnik/aos)
- [Bootstrap](https://getbootstrap.com)
- [Cloudflare Turnstile](https://cloudflare.com/products/turnstile)
- [Cookie Consent](https://github.com/orestbida/cookieconsent)
- [DataTables](https://datatables.net)
- [Font Awesome](https://fontawesome.com)
- [Google Analytics](https://analytics.google.com)
- [Google APIs Client Library](https://github.com/googleapis/google-api-php-client)
- [Intervention Image](https://image.intervention.io)
- [jQuery](https://jquery.com)
- [PHPMailer](https://github.com/phpmailer/phpmailer)
- [Sweetalert2](https://sweetalert2.github.io)