# Laravel API Demo with Docker
This Repo contains a Laravel 5.7.24 installation setup to use Docker to create a development environment with REST API Demo. This Repo intend to demonstrate Backend developer skill and testing purpose only.


This setup contains;

 - PHP-FPM (PHP 7.2.14)
 - Nginx web server (1.10.3)
 - MySQL database (5.7)

## Run
Make sure you have [Docker](https://docs.docker.com/) installed and docker-compose running

 Clone the repo

    git clone https://github.com/kanojiyadhaval/laravel_docker.git

 Change directory

    cd laravel_docker
  
 Spin Up project container
    docker-compose up -d
    
   This builds the containers and runs them in the background, while this

    docker-compose up
   builds the containers to outputs their logs to the console.
   
   You should be able to visit your app at http://127.0.0.1:8080

To stop the containers run `docker-compose kill`, and to remove them run `docker-compose rm`

## Laravel

From the project root directory , enter following command to enter container shell

    docker exec -it laravel_app_1 bash
    
Run the following command to create Table schema and Seeds

    php artisan migrate
    php artisan db:seed

## REST API with Swagger demo

   visit swagger url at http://127.0.0.1:8000/api/documentation

   
In case of any query or concern, feel free to contact.
   

Thanks & Regards,
Dhaval Kanojiya   
