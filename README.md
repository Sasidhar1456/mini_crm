# How to run
1. git init
2. git clone https://github.com/Sasidhar1456/mini_crm.git
3. composer install
4. set up .env file
    DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
5. php artisan key:generate
6. php artisan migrate
7. php artisan db:seed
8. php artisan serve

