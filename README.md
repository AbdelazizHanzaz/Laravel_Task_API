
# Laravel Task API

This is a sample REST API for managing tasks using Laravel.

## Features

- Authentication using Laravel Sanctum
- SQLite Database
- Database Migrations and Seeding
- Database Relationships 
- Form Request Validation
- Custom Validation Rules

## Installation

- Clone the repo
- Run `composer install`
- Configure `.env` and set `DB_CONNECTION=sqlite`
- Run migrations `php artisan migrate`

## Endpoints

The API includes the following endpoints:

### Auth

- POST `/register` - Register a new user
- POST `/login` - Login an existing user

### Tasks

- GET `/tasks` - Get list of tasks (paginated)
- POST `/tasks` - Create a new task
- GET `/tasks/{id}` - Get a task by ID
- PUT `/tasks/{id}` - Update task by ID
- DELETE `/tasks/{id}` - Delete task by ID

## Testing API

Import the Postman collection and environment to test API requests.

## Tech Stack

- [Laravel](https://laravel.com/)
- [Sanctum](https://laravel.com/docs/sanctum)
- [Postman](https://www.postman.com/) 

## License

The Laravel Task API is open-source and licensed under the MIT license.

