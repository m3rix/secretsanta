# secretsanta

## Description

A project to create a secret santa lottery with login and wishlists handling

## Getting Started

### Dependencies

* Docker
* auth0 account to bind the login towards

### Installing

* Download the project

* Copy frontend/auth_config.json.example and name it without example
  * Set creadentials frontend/auth_config.json for auth0

* Run "docker-compose up --build" in the project folder in terminal
* Run "docker exec -it [laravel container id] bash" in a terminal
* RUN php artisan migrate to create the database tables

### Executing program

* Visit localhost in a browser for visit the homepage
* Open localhost:8000/api/V1/wishlist/ in a API test tool for testing the APIs
  * Will be adding function over time, first just some examples to enable new wishes to the wishlist
* localhost:3306 for access the database with db tool or http://localhost:8081/ for phpmyadmin

## Version History

* 0.1
    * Environment skeleton created 