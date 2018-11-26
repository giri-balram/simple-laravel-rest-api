# Laravel 5.7 REST API With Simple API Authentication
A PHP Laravel Authentication API with E-mail verification, developed with Laravel 5.7 framework.

## Resources
The API has been built with two resources 1) Subcribers 2) Fields

- The Subscriber resource contain fields : email address, name, state (active, unsubscribed, junk, bounced, unconfirmed)
- The Fields resource contain fields : title, type (date, number, string, boolean)
- Each subscriber can have many fields
 
## Prerequisite 

As it is build on the Laravel framework, it has a few system requirements. Of course, all of these requirements are satisfied by the Laravel Homestead virtual machine, so it's highly recommended that you use Homestead as your local Laravel development environment.

However, if you are not using Homestead, you will need to make sure your server meets the following requirements:

- PHP >= 7.1.3
- MySql >= 5.7
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

You can check all the laravel related dependecies <a href="https://laravel.com/docs/5.7/installation#server-requirements"  target="_blank"> here </a>.

## Installation steps

Follow the bellow steps to install and set up the application.

**Step 1: Clone the Application**<br>
You can download the ZIP file or git clone from my repo into your project  directory.

**Step 2: Configure the Application**<br>
After you clone the repo in to your project folder the project need to be set up by following commands-

- In terminal go to your project directory and Run 
    
        composer install 
    
- Then copy the .env.example file to .env file in the project root folder

- Edit the .env file and fill all required data for the bellow variables
    
        APP_URL=http://localhost //your application domain URL go here
    
        DB_HOST=127.0.0.1 // Your DB host IP. Here we are assumed it to be local host
        DB_PORT=3306 //Port if you are using except the default
        DB_DATABASE=name_of_your_database
        DB_USERNAME=db_user_name
        DB_PASSWORD=db_password
    
- To set the Application key run the bellow command in your terminal.
    
        php artisan key:generate
    
- Make your storage and bootstrapp folder writable by your application user.

- Create all the necessary tables need for the application by runing the bellow command.
    
        php artisan migrate

- Fill default data if your need by running bellow command.

        php artisan db:seed

Thats all! The application is configured now.


## API Endpoints and Routes

Laravel follows the Model View Controller (MVC) pattern I have creatd models associated with each resource. You can check in the **routes/api.php** file for all the routes that map to controllers in order to send out JSON data that make requests to our API.

Bellow are the all resources API endpoints - 

        GET    | api/fields  | api,auth:api

        POST   | api/fields | api,auth:api

        GET    | api/fields/{field} | api,auth:api

        PUT    | api/fields/{field} | api,auth:api 

        DELETE | api/fields/{field} | api,auth:api

        POST   | api/login | api,guest 

        POST   | api/logout | api

        POST   | api/register | api,guest

        GET    | api/subscribers | api,auth:api

        POST   | api/subscribers | api,auth:api

        GET    | api/subscribers/{subscriber} | api,auth:api

        PUT    | api/subscribers/{subscriber} | api,auth:api 

        DELETE | api/subscribers/{subscriber}| api,auth:api 

## Third party library used and configuration

I have used a third party librery for email domain validation check. The package I have used here is https://github.com/unicodeveloper/laravel-email-validator#install .

Set the API key for your <a href="https://quickemailverification.com/" target="_blank"> quick email verification  account </a> in the config/emailValidator.php file. This is needed to check the active email domain.



