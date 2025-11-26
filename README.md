# BlogSystem
A blog management system built with Laravel as the backend (REST API) and a responsive frontend using HTML and Bootstrap. Supports full CRUD operations for blog posts, with structured MVC architecture and easy setup for local development.


 # Installation
1️⃣ Clone the Repository
git clone https://github.com/your-username/Laravel-Blog.git
cd Laravel-Blog

2️⃣ Install Dependencies
composer install

3️⃣ Set Up Environment File
cp .env.example .env

4️⃣ Generate App Key
php artisan key:generate

5️⃣ Configure Environment

Edit .env:

DB_DATABASE=laravel_blog
DB_USERNAME=root
DB_PASSWORD=

6️⃣ Run Migrations
php artisan migrate


Optional demo data:

php artisan db:seed

7️⃣ Start Development Server
php artisan serve


Your project will run at:

http://127.0.0.1:8000

