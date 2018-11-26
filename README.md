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
        
        
## API Authentication 

All the api endpoints are protected by a simple API Authentication process. To access the resource data, the request header need api_token field. The **api_token** value need to be taken from the **api/login** API by passing valid username and password.
    
   **Example Of Login API request**
    
        $ curl -X POST appurl/api/login \
        -H "Accept: application/json" \
        -H "Content-type: application/json" \
        -d "{\"email\": \"user@user.com\", \"password\": \"1234\" }"
        
   **Response Of Valid Login API**
        
        {
            "data": {
                "id": 3,
                "name": "Default",
                "email": "user@user.com",
                "email_verified_at": "2018-11-23 15:01:31",
                "api_token": "fHsLHoHXpdqgYH8VPBFn1yEa5NV3NrxmizZUMuMxtSxZr60HfB",
                "created_at": "2018-11-23 15:01:31",
                "updated_at": "2018-11-26 16:27:07"
            }
        }



To send the token in a request, you can do it by sending an attribute api_token as a bearer token in the request headers in the form of **Authorization: Bearer fHsLHoHXpdqgYH8VPBFn1yEa5NV3NrxmizZUMuMxtSxZr60HfB**

   **Example Of Api Request Using Auth Api Token**
    
        $ curl -X POST appurl/api/subscribers \
        -H "Accept: application/json" \
        -H "Authorization: Bearer fHsLHoHXpdqgYH8VPBFn1yEa5NV3NrxmizZUMuMxtSxZr60HfB" \
        -H "Content-type: application/json" \
        -d "{\"email\": \"user@user.com\", \"password\": \"1234\" }"


## Test Case 

I have created several test case to test all the API endpoints by using Laravel PHPUnit with a phpunit.xml set up.

There are 16 test cases written to test the API endpoint crud operation, present in the **tests/Feature** folder. You can write more test case to test other scenario as well by adding test method in their respective file.

To execute all the test case, move to the project root folder in terminal and then run -
        
        composer test 


## Third party library used and configuration

I have used a third party librery for email domain validation check. The package I have used here is https://github.com/unicodeveloper/laravel-email-validator#install .

Set the API key for your <a href="https://quickemailverification.com/" target="_blank"> quick email verification  account </a> in the config/emailValidator.php file. This is needed to check the active email domain.



