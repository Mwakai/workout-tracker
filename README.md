# 🚀 [Workout Tracker](https://roadmap.sh/projects/fitness-workout-tracker)

A RESTful API built with Laravel, secured with **JWT (JSON Web Token)** authentication using the `tymon/jwt-auth` package.

---

## 📋 Requirements

Make sure you have the following installed before proceeding:

| Tool     | Version       |
| -------- | ------------- |
| PHP      | >= 8.2        |
| Composer | >= 2.x        |
| MySQL    |
| Git      | Latest stable |

## ⚙️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Create the Environment File

```bash
cp .env.example .env
```

### 4. Generate the Application Key

```bash
php artisan key:generate
```

### 5. Configure the Environment

Open the `.env` file and update the following variables to match your local setup:

```env
APP_NAME=YourAppName
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

JWT_SECRET=        # Will be generated in the next step
JWT_TTL=60         # Token expiry in minutes (default: 60)
JWT_REFRESH_TTL=20160  # Refresh token expiry in minutes (default: 2 weeks)
```

---

## 🔐 JWT Authentication Setup

### 1. Install the JWT Package

```bash
composer require tymon/jwt-auth
```

### 2. Publish the JWT Config

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

This creates the `config/jwt.php` configuration file.

### 3. Generate the JWT Secret Key

```bash
php artisan jwt:secret
```

This automatically sets the `JWT_SECRET` value in your `.env` file.

### 4. Update the User Model

Make sure your `User` model implements the `JWTSubject` interface:

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // ...

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
```

### 5. Update the Auth Guard in `config/auth.php`

```php
'defaults' => [
    'guard'     => 'api',
    'passwords' => 'users',
],

'guards' => [
    'api' => [
        'driver'    => 'jwt',
        'provider'  => 'users',
    ],
],
```

---

## 🗄️ Database Setup

### Run Migrations

```bash
php artisan migrate
```

> Add `--seed` to populate the database with sample data:
>
> ```bash
> php artisan migrate --seed
> ```

---

## ▶️ Running the Application

Start the local development server:

```bash
php artisan serve
```

The API will be available at:

```
http://127.0.0.1:8000
```

---

## 🌐 API Authentication Endpoints

Base URL: `http://127.0.0.1:8000/api`

| Method | Endpoint             | Description                          |
| ------ | -------------------- | ------------------------------------ |
| POST   | `/api/auth/register` | Register a new user                  |
| POST   | `/api/auth/login`    | Login and receive a JWT token        |
| POST   | `/api/auth/logout`   | Invalidate the current token         |
| POST   | `/api/auth/refresh`  | Refresh an expired token             |
| GET    | `/api/auth/me`       | Get the authenticated user's details |

### Example Login Request

```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "yourpassword"
}
```

### Example Login Response

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600
}
```

---

## 🔑 Using the JWT Token

Include the token in the `Authorization` header for all protected routes:

```
Authorization: Bearer YOUR_JWT_TOKEN
```

### Example Protected Request

```http
GET /api/auth/me
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

---

## 🛣️ Protecting Routes

In `routes/api.php`, wrap protected routes with the `auth:api` middleware:

```php
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'], function () {
    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // Exercises routes
    Route::prefix('exercises')->group(function () {
        Route::get('/', [ExerciseController::class, 'index']);
        Route::get('{id}', [ExerciseController::class, 'show']);
    });

    // Workouts
    Route::prefix('workouts')->group(function () {
        Route::get('/', [WorkoutController::class, 'index']);
    });

});
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👤 Author

**Your Name**

- GitHub: [Mwakai](https://github.com/Mwakai)
- Email: mwakaimwambala@gmail.com@gmail.com
