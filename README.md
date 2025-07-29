<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">OurMainApp – A Simple Facebook-Like Social Media Clone</h2>

<p align="center">
  A work-in-progress Laravel project simulating core social media features like user posting, authentication, admin controls, and image uploads.
</p>

---

## 🔧 Features (Implemented So Far)

- ✅ **User Authentication**
  - Sign up, log in, and log out
  - Session management via Laravel's Auth system

- ✅ **Post System**
  - Create, edit, and delete text posts
  - Posts displayed per user

- ✅ **Image Upload**
  - Upload and display profile pictures
  - File is stored in the local filesystem; path saved in the database

- ✅ **Admin Features**
  - Admins can delete user posts
  - Basic admin panel setup

- ✅ **Database**
  - MySQL with migrations for users and posts

---

## 🚧 In Progress / To-Do

- 🔍 Search features  
- 💬 Live chat  
- 📱 Responsive frontend design

---

## 🛠 Tech Stack

- **Framework**: Laravel Framework 12.19.3  
- **Language**: PHP 8.4.8 (CLI)  
- **Database**: MySQL  
- **Frontend**: Blade templates  
- **Authentication**: Custom Laravel-based authentication (login, register, logout)  
- **File Uploads**: Laravel Filesystem (`storage/app/public` with symbolic link to `public/storage`)

---

## 🗂 Project Setup (Local)

git clone https://github.com/ma5io/ourmainapp.git
cd ourmainapp
composer install
cp .env.example .env
php artisan key:generate

---

## 👤 Admin Access

UPDATE users SET is_admin = 1 WHERE email = 'ma5io@outlook.com';


---

## 📜 MIT License

Copyright (c) 2025 Mario Lim

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
