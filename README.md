# 🎓 Laravel School Management System

A complete Laravel-based school management web application for Admins, Teachers, and Students.

## 🚀 Features

- 🧑🎓 Student Management (CRUD)
- 👨🏫 Teacher Management (CRUD)
- 📚 Courses & Subjects
- 📝 Assignment Upload & Submission
- ✅ Grading System
- 🔐 Authentication with Laravel Breeze
- 👥 Role-based Dashboards (Admin, Teacher, Student)
- 🖼️ Bootstrap UI
- 📁 File Uploads
- 📈 Dashboard Summary Cards

## 🛠️ Tech Stack

- Laravel 10+
- Laravel Breeze (Auth Scaffolding)
- Bootstrap 5 (Frontend)
- MySQL / SQLite
- GitHub for version control

## 🧪 Installation Guide

### 1️⃣ Clone the Repository
git clone https://github.com/yourusername/schoolapp.git
cd schoolapp
2️⃣ Install Dependencies
composer install
npm install && npm run dev
3️⃣ Setup Environment File
cp .env.example .env
php artisan key:generate
4️⃣ Run Migrations
php artisan migrate
5️⃣ Start Development Server
php artisan serve
🔗 Visit: http://127.0.0.1:8000
________________________________________
🔐 Default Roles (You Can Customize)
Role	Access
Admin	Manage Students, Teachers, Courses
Teacher	Upload Assignments, Grade Students
Student	View Assignments, Submit Work, See Grades
________________________________________
📂 Project Structure
routes/web.php         → All web routes
app/Http/Controllers/  → Application controllers
resources/views/       → Blade templates
app/Models/            → Eloquent models

🤝 Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
