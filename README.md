# 🎓 Campus Lost & Found – CodeIgniter 4 Web Application

> A full‑stack bulletin board for reporting lost and found items on campus. Built with CodeIgniter 4, MySQL, Bootstrap 5. Demonstrates CSRF/XSS protection, file uploads, pagination with search, unit testing, and production deployment.

**Course**: Advanced Web Development (CodeIgniter 4) – Spring 2025  
**Instructor**: Edward Grageda  
**Live URL**: [https://your-app.com](https://your-app.com) (to be added)  

---

## 📌 Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Screenshots](#screenshots)
- [Setup Instructions](#setup-instructions)
- [Testing](#testing)
- [Deployment](#deployment)
- [Team Roles](#team-roles)
- [Deliverables](#deliverables)
- [License](#license)

---

## ✨ Features

### 🔐 Security (Week 11)
- ✅ CSRF protection – global filter + `csrf_field()` in every POST form  
- ✅ XSS prevention – all output escaped with `esc()`  
- ✅ Security report (300+ words) explaining attacks and countermeasures  

### ⚙️ Advanced Features (Weeks 12–13)
- 📁 **File uploads** – image validation (size, type, MIME), stored in `writable/uploads/`  
- 📧 **Email** – SMTP configuration, HTML email on user action (e.g., claiming)  
- 📄 **Pagination** – 10 items per page, search keyword persists across pages  
- ⚡ **Performance** – page caching, database indexes, Debug Toolbar screenshot  

### 🧪 Unit Testing & Debugging (Week 14)
- ✅ PHPUnit tests (3+ methods): homepage 200, model validation, controller response  
- ✅ Debugging with `dd()` + stack trace analysis (screenshot + annotation)  

### 🚀 Deployment & Cloud Hosting (Week 15)
- ✅ Production config (`.env` with `CI_ENVIRONMENT = production`)  
- ✅ Deployed to live URL with HTTPS  
- ✅ Deployment log documenting every step and issues resolved  

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | CodeIgniter 4.4+ |
| Language | PHP 8.0+ |
| Database | MySQL 5.7 |
| Frontend | Bootstrap 5, custom CSS |
| Testing | PHPUnit 9 |
| Version Control | Git + GitHub |
| Hosting | Render / DigitalOcean (see deployment log) |

---

## 📸 Screenshots

> *Add your actual screenshots here:*

- **Listing page** (pagination + search)  
  ![Listing](screenshots/listing.png)
- **Create form** (CSRF token shown)  
  ![Create](screenshots/create.png)
- **XSS before/after** (raw input vs escaped output)  
  ![XSS](screenshots/xss-prevention.png)
- **Debug Toolbar** (SQL query count)  
  ![Toolbar](screenshots/debug-toolbar.png)
- **PHPUnit green output**  
  ![PHPUnit](screenshots/phpunit-pass.png)

---

## 🚀 Setup Instructions (for local development)

### Prerequisites
- PHP 8.0+ , Composer, MySQL, Git

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/your-team/lostandfound.git
cd lostandfound

# 2. Install dependencies
composer install

# 3. Copy environment file
cp env .env

# 4. Configure .env (database, environment)
#    Set CI_ENVIRONMENT = development
#    Set database.default.database = lostandfound_db
#    Set database.default.username = root
#    Set database.default.password = 

# 5. Create database
mysql -u root -p -e "CREATE DATABASE lostandfound_db"

# 6. Run migrations
php spark migrate

# 7. Start development server
php spark serve
