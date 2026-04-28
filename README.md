# MediCare – Pharmacy Management System

A premium, full-stack Pharmacy Management System built with Laravel 13, Livewire, and Tailwind CSS.

## Features

### 🔐 Authentication System
- Role-based access (Admin & User)
- Modern Login & Register pages
- Protected routes with Admin Middleware

### 🏥 Admin Panel
- **Dashboard**: Real-time analytics with Chart.js.
- **Medicines**: CRUD for inventory with image upload.
- **Categories**: Dynamic category management.
- **Doctors**: Manage specialist profiles.
- **Appointments**: View and manage patient bookings.
- **Orders**: Tracking and status updates.

### 💊 User Panel
- **Homepage**: Clean, responsive design with category filters.
- **Medicine Catalog**: Search and browse medicines.
- **Doctor Booking**: View specialists and request appointments.
- **Store Pickup**: Unique Order ID generation for local pickup.

## Tech Stack
- **Backend**: Laravel 13 (MVC)
- **Frontend**: Livewire (Functional) + Tailwind CSS
- **Database**: MySQL
- **Charts**: Chart.js

## 🚀 Setup Instructions

1. **Clone the repository** (if not already in the project directory).
2. **Install PHP dependencies**:
   ```bash
   composer install
   ```
3. **Install & Initialize Laravel Breeze**:
   ```bash
   php artisan breeze:install livewire --functional --dark
   ```
4. **Database Configuration**:
   Update your `.env` file with your database credentials:
   ```env
   DB_DATABASE=pharmacy_management_system
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```
5. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate:fresh --seed
   ```
6. **Install & Build Frontend Assets**:
   ```bash
   npm install
   npm run dev
   ```
7. **Create Storage Link**:
   ```bash
   php artisan storage:link
   ```

## Credentials
- **Admin**: admin@medicare.com / password
- **User**: user@medicare.com / password

---
Built with ❤️ by Antigravity AI
