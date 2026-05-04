# MediCare – Pharmacy Management System

A premium, full-stack Pharmacy Management System built with Laravel 13, Livewire, and Tailwind CSS.

## 🔐 Key Features

### 🔐 Authentication System
- **Role-based access**: Dedicated flows for Admin & Customers.
- **Premium UI**: Modern Login & Register pages with Glassmorphism effects.
- **Security**: Robust session management and role-based middleware protection.

### 🏥 Admin Panel (Backend)
- **Interactive Dashboard**: Real-time business analytics with Chart.js.
- **Inventory Management**: Full CRUD for Medicines with category association and image uploads.
- **Expiry Tracking**: Visual indicators for expired or near-expiry medicines.
- **Doctor Management**: Manage specialist profiles and availability.
- **Order Tracking**: Complete lifecycle management from 'Pending' to 'In Transit'.
- **Content CMS**: Manage homepage banners and health articles (blogs).

### 💊 Customer Panel (Frontend)
- **Product Discovery**: Global search bar and category-based filtering.
- **Detailed View**: Premium product details page with stock status and related items.
- **Appointment Booking**: Request appointments with certified specialists.
- **User Profile**: Self-service profile management and security settings.

## 🛠️ Tech Stack
- **Framework**: Laravel 13 (Latest Stable)
- **Frontend Logic**: Livewire (Functional Components)
- **Styling**: Tailwind CSS + Vanilla CSS (Emerald & Slate Theme)
- **Database**: MySQL / PostgreSQL
- **Charts**: Chart.js for Administrative Insights

## 🚀 Setup & Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-repo/Pharmacy_Management_System.git
   ```
2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```
3. **Environment Setup**:
   Copy `.env.example` to `.env` and configure your database.
4. **Database Initialization**:
   ```bash
   php artisan migrate --seed
   ```
5. **Storage Setup**:
   ```bash
   php artisan storage:link
   ```
6. **Launch Application**:
   ```bash
   php artisan serve
   npm run dev
   ```

## 👥 Credentials
- **Admin**: rikkisaini4455@gmail.com / admin123
- **User**: user@medicare.com / password

---
Developed with ❤️ by **Antigravity AI**
