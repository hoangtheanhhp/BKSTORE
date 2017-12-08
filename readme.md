# Laravel PHP Framework

#### How to run Laravel Project?

#### 1.Step 1
Clone this project

```terminal
$git clone https://github.com/hoangtheanhhp/BKSTORE
```
#### 2.Step 2
Install required package
```terminal
$composer install
$composer update
```

#### 3.Step 3
Create or clone .env for config driver, database for this project.
##### example: pgsql
```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE= --database_name
DB_USERNAME=--user_name
DB_PASSWORD=--user_password
``` 

#### 4.Step4
First run laravel project
```terminal
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```