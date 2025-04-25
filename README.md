# Workshop Management System

A Laravel-based application for managing workshops, registrations, materials, attendance, and certificate generation.

## Features
- User authentication (registration & login)
- Workshop creation, listing, and management
- User registration for workshops
- Material access for registered users
- Attendance tracking for participants
- Certificate generation upon completion

## Key Components
- **Models:** User, Workshop, Registration, Material, Attendance, Certificate
- **Controllers:** Handle business logic for each module
- **Views:** Blade templates for user interface
- **Routes:** Protected with auth middleware

## Setup Instructions
1. Clone the repository:
   ```sh
   git clone https://github.com/Vishal-140/Workshop-Management.git
   cd Workshop-Management
   ```
2. Install dependencies:
   ```sh
   composer install
   npm install && npm run build
   ```
3. Copy the example environment file and set your configuration:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. Set up your database in `.env` and run migrations:
   ```sh
   php artisan migrate --seed
   ```
5. (Optional) Link storage:
   ```sh
   php artisan storage:link
   ```
6. Start the development server:
   ```sh
   php artisan serve
   ```

## Deployment
- Ensure your `.env` is configured for production.
- Run migrations and build assets on your server.

## License
This project is open-source and available under the [MIT license](LICENSE).
