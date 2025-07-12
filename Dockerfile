FROM php:8.1-cli

# نثبت السيرفر البسيط
RUN apt-get update && apt-get install -y git unzip curl

# ننسخ كل ملفات المشروع داخل الحاوية
COPY . /app
WORKDIR /app

# نستخدم PHP built-in server على البورت 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "/app"]
