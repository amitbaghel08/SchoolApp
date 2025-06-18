laravel install

Step 2: Authentication Package Setup
    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install && npm run dev

Step 3: Models aur Migrations banao
    php artisan make:model Student -m
    php artisan make:model Teacher -m

Step 4: Guards aur Providers Setup karo
config/auth.php me update karo:
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'student' => [
        'driver' => 'session',
        'provider' => 'students',
    ],

    'teacher' => [
        'driver' => 'session',
        'provider' => 'teachers',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],

    'students' => [
        'driver' => 'eloquent',
        'model' => App\Models\Student::class,
    ],

    'teachers' => [
        'driver' => 'eloquent',
        'model' => App\Models\Teacher::class,
    ],
],

php artisan cache:clear
php artisan view:clear
 php artisan route:clear
 php artisan config:clear