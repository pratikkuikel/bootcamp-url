## Setting up this project in your local environment

-   Clone or download this repository
-   Go to the project folder
-   copy .env.example to .env to create a environment file
-   Use Composer install command to fetch all the dependencies
-   Generate APP_KEY using php artisan key:generate command.
-   Fill in the environment variables like APP_NAME, DB_DATABASE,
    DB_USERNAME, DB_PASSWORD and more if required by the application.
-   Create a new database in your database server using same name as defined in DB_DATABASE of .env file.
-   Run the migrations using php artisan migrate command to create tables in the database


## Things to be included in the project

1. CRUD 
2. Authentication
3. Record/Resource isolation
4. Form Request Validation
5. Model Relationship
6. Validation message
7. Success message

