# 🎬 MovieFlix

A full-featured movie streaming web application built with PHP and MySQL. MovieFlix allows users to browse movies by category, manage their accounts, and gives administrators full control over content and users via a dedicated admin panel.

---

## 📋 Table of Contents

- [Features](#features)
- [Project Structure](#project-structure)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Default Admin Credentials](#default-admin-credentials)
- [Pages & Routes](#pages--routes)
- [Admin Panel](#admin-panel)
- [Security Notes](#security-notes)

---

## ✨ Features

- **User Authentication** — Register, login, and logout with session management
- **Movie Browsing** — Browse all movies with poster, rating, year, and category
- **Homepage Carousels** — Top Rated, New Releases, and genre-based sections
- **Category Filtering** — Movies organized by genre (Action, Sci-Fi, Comedy, Horror, Drama, Thriller)
- **Admin Panel** — Full CRUD for movies, users, and categories
- **Responsive Design** — Works across desktop and mobile devices
- **Static Pages** — About, Contact, Privacy Policy, Terms of Service

---

## 📁 Project Structure

```
movieflix/
├── config/
│   └── database.php          # Database connection
├── admin/
│   ├── dashboard.php         # Admin dashboard with stats
│   ├── movies.php            # Movie management (CRUD)
│   ├── users.php             # User management
│   └── categories.php        # Category management
├── includes/
│   ├── header.php            # Shared header/nav
│   ├── footer.php            # Shared footer
│   └── movie_card_template.php  # Reusable movie card
├── css/
│   └── style.css             # Global styles
├── js/
│   └── script.js             # Frontend scripts
├── images/                   # Local images
├── index.php                 # Homepage
├── movies.php                # All movies listing
├── login.php                 # User login
├── register.php              # User registration
├── logout.php                # Logout with confirmation
├── profile.php               # User profile page
├── admin.php                 # Admin panel entry point
├── about.php                 # About page
├── contact.php               # Contact form
├── privacy.php               # Privacy policy
└── terms.php                 # Terms of service
```

---

## 🛠️ Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server (Apache, Nginx, or XAMPP/WAMP/MAMP for local development)
- [Font Awesome 6.4](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css) (loaded via CDN)

---

## 🚀 Installation

1. **Clone or download** the project into your web server's root directory:
   ```bash
   # For XAMPP
   cp -r movieflix/ /xampp/htdocs/movieflix
   ```

2. **Configure the database** connection in `config/database.php`:
   ```php
   $host = 'localhost';
   $username = 'root';   // your MySQL username
   $password = '';       // your MySQL password
   $dbname = 'movieflix';
   ```

3. **Create the database** and tables (see [Database Setup](#database-setup) below).

4. **Start your server** and navigate to `http://localhost/movieflix`.

---

## 🗄️ Database Setup

Create a MySQL database named `movieflix` and run the following SQL:

```sql
CREATE DATABASE IF NOT EXISTS movieflix;
USE movieflix;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    year INT,
    category_id INT,
    rating DECIMAL(3,1),
    poster_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seed default categories
INSERT INTO categories (name, description) VALUES
('Action', 'High-energy films with exciting sequences'),
('Sci-Fi', 'Science fiction and futuristic stories'),
('Comedy', 'Light-hearted and humorous films'),
('Horror', 'Scary and suspenseful movies'),
('Drama', 'Character-driven emotional stories'),
('Thriller', 'Suspenseful and tension-filled films');
```

---

## 🔐 Default Admin Credentials

A hardcoded admin account is available for initial access:

| Field    | Value                   |
|----------|-------------------------|
| Email    | `admin@movieflix.com`   |
| Password | `admin123`              |

> ⚠️ **Important:** Remove or change this hardcoded credential in `login.php` before deploying to production.

---

## 🗺️ Pages & Routes

| URL              | Description                          | Auth Required |
|------------------|--------------------------------------|---------------|
| `/index.php`     | Homepage with movie carousels        | No            |
| `/movies.php`    | Full movie listing                   | No            |
| `/login.php`     | Login form                           | No            |
| `/register.php`  | Registration form                    | No            |
| `/logout.php`    | Logout confirmation page             | Yes           |
| `/profile.php`   | User profile and account info        | Yes           |
| `/admin.php`     | Admin panel (role-gated)             | Admin only    |
| `/about.php`     | About MovieFlix                      | No            |
| `/contact.php`   | Contact form                         | No            |
| `/privacy.php`   | Privacy policy                       | No            |
| `/terms.php`     | Terms of service                     | No            |

---

## 🛡️ Admin Panel

Accessible at `/admin.php` for users with the `admin` role.

| Section        | Capabilities                                      |
|----------------|---------------------------------------------------|
| **Dashboard**  | View total movies, users, categories; recent adds |
| **Movies**     | Add, edit, delete movies with poster and metadata |
| **Users**      | View and delete registered users                  |
| **Categories** | Add and delete movie categories                   |

---

## 🔒 Security Notes

The following issues should be addressed before any production deployment:

- **Hardcoded admin credentials** in `login.php` — remove the `admin@movieflix.com` / `admin123` bypass and use a properly hashed database entry instead.
- **SQL Injection** — several admin pages (`categories.php`, `movies.php`) use `real_escape_string()` rather than prepared statements. Migrate all queries to prepared statements.
- **No CSRF protection** — forms (add movie, add category, contact) are not protected against cross-site request forgery. Add CSRF tokens.
- **Input validation** — server-side validation is minimal in admin pages. Add stricter type and length checks.
- **Error exposure** — `$conn->error` is printed directly to the page. Use logging instead in production.

---

## 📄 License

This project is intended for educational and personal use.
