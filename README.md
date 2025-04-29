<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

📘 Laravel MIS JT System A Laravel-powered IT ticketing system designed to streamline internal support and task management within an organization. Originally developed as a personal project to practice and showcase Laravel's capabilities, this system has evolved into a comprehensive solution for managing IT-related requests.​

Important notes:
* Clone the repository and navigate into the project directory  
  (Use `git clone <repository-url>` and `cd <project-folder>` to get started)

* Install PHP dependencies using Composer  
  (Make sure Composer is installed, then run `composer install`)

* Copy the `.env.example` file to `.env`  
  (This sets up your environment configuration file)

* Generate the application key  
  (Run `php artisan key:generate` to secure your app)

* Configure the `.env` file with your database and environment settings  
  (Update `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and other relevant values.  
  Also configure mail settings with your own mailer service provider. Preferably gmail smtp)

* Run database migrations and seeders  
  (Execute `php artisan migrate, you can also use the seeders available)

* Install Node dependencies and compile frontend assets  
  (Run `npm install` and then `npm run dev` to build JS/CSS assets)

* Serve the application using Artisan  
  (Start the local server with `php artisan serve` again don't for get `npm run dev`)

* Access the application at `http://localhost:8000`  
  (Open in your browser to view the Laravel project)

