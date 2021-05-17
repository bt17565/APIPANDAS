## API Pandas
Please follow instructions given below to setup project:

1. Clone repository ``
2. Install composer dependencies `composer install`
3. Copy .env.example & create .env `cp .env.example .env`
4. Create database in mysql & update database credentials in .env:
    ```
    DB_CONNECTION=mysql
    DB_HOST=--DB_HOST--
    DB_PORT=--DB_PORT--
    DB_DATABASE=--DB_NAME--
    DB_USERNAME=--DB_USERNAME--
    DB_PASSWORD=--DB_PASSWORD--
    ```
5. Update APP_URL in env `APP_URL=--APPLICATION_URL--`
6. Update SMTP credentials in env:
    ```
    MAIL_MAILER=smtp
    MAIL_HOST=--SMTP_HOST--
    MAIL_PORT=--SMTP_PORT--
    MAIL_USERNAME=--USERNAME--
    MAIL_PASSWORD=--PASSWORD--
    MAIL_ENCRYPTION=--TLS/SSL--
    MAIL_FROM_ADDRESS=--FROM_ADDRESS-
    MAIL_FROM_NAME=--FROM_NAME--
    ```
7. Give necessary permissions to required directories:
    ```
    chmod -R 777 storage
    chmod -R 777 bootstrap/cache
    ```
8. Generate application key `php artisan key:generate`
9. Migrate & seed database:
    ```
    php artisan migrate
    php artisan db:seed
    ```
### Login Credentials
Email:  altynay.uk@gmail.com<br/>
Password: 1234567890
