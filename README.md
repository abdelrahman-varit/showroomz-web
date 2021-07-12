<p align="center"><img src="https://showroomz.s3.eu-central-1.amazonaws.com/logo.png" width="250px"></p>



## About [Showroomz](https://showroomz.co)

Showroomz is furniture marketplace that let you have a seamless shopping experience.

## Installation

Showroomz is build by Laravel framework, so please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.7/installation#installation)


Clone the repository

    git clone https://github.com/showroomz/showroomz-web.git

Switch to the repo folder

    cd showroomz-web

Build and run the docker containers

    docker-compose up -d --build

Install all the dependencies using composer

    docker-compose composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    docker-compose artisan key:generate

Publish assets and configurations

    docker-compose artisan vendor:publish
    -> Press 0 and then press enter to publish all assets and configurations.

Run the database migrations (**Set the database connection in .env before migrating**)

    docker-compose artisan migrate --seed


You can now access the server at http://localhost:8080

**TL;DR command list**

    git clone https://github.com/showroomz/showroomz-web.git
    cd showroomz-web
    docker-compose up -d --build
    docker-compose composer install
    cp .env.example .env
    docker-compose artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    docker-compose artisan migrate --seed
    docker-compose artisan serve
    docker-compose artisan vendor:publish
    -> Press 0 and then press enter to publish all assets and configurations.

