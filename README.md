<p align="center"><img src="https://showroomz.s3.eu-central-1.amazonaws.com/logo.png" width="250px"></p>



## About [Showroomz](https://showroomz.co)

Showroomz is furniture marketplace that let you have a seamless shopping experience.

## Installation

Showroomz is build by Laravel framework, so please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.7/installation#installation)


Clone the repository

    git clone https://github.com/minawilliam/showroomz-web.git

Switch to the repo folder

    cd showroomz-web

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Publish assets and configurations

    php artisan vendor:publish
    -> Press 0 and then press enter to publish all assets and configurations.

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/minawilliam/showroomz-web.git
    cd showroomz-web
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate --seed
    php artisan serve
    php artisan vendor:publish
    -> Press 0 and then press enter to publish all assets and configurations.

