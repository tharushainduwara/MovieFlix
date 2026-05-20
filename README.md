# 🎬 MovieFlix

A full-featured movie streaming web application built with PHP and MySQL. MovieFlix allows users to browse movies by category, manage their accounts, and gives administrators full control over content and users via a dedicated admin panel.

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


## 🛡️ Admin Panel

Accessible at `/admin.php` for users with the `admin` role.

| Section        | Capabilities                                      |
|----------------|---------------------------------------------------|
| **Dashboard**  | View total movies, users, categories; recent adds |
| **Movies**     | Add, edit, delete movies with poster and metadata |
| **Users**      | View and delete registered users                  |
| **Categories** | Add and delete movie categories                   |

---

## 📄 License

This project is intended for educational and personal use.
