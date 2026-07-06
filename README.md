# Login Task

> 🇬🇧 Simple authentication system built with PHP, MySQL and jQuery.
>
> 🇭🇺 Egyszerű felhasználói hitelesítő rendszer PHP, MySQL és jQuery felhasználásával.

---

# Features / Funkciók

- ✅ User registration / Felhasználói regisztráció
- ✅ User login / Bejelentkezés
- ✅ Session-based authentication / Session alapú hitelesítés
- ✅ Secure password hashing / Biztonságos jelszó titkosítás
- ✅ Logout / Kijelentkezés
- ✅ CSRF protection / CSRF védelem
- ✅ Content Security Policy (CSP)
- ✅ Client-side validation with jQuery / Kliens oldali validáció jQuery segítségével
- ✅ Responsive user interface / Reszponzív felhasználói felület

---

# Technologies / Technológiák

- PHP 8.2
- MySQL / MariaDB
- mysqli
- jQuery 3.7.1
- HTML5
- CSS3

---

# Development Environment / Fejlesztői környezet

| Component | Version |
|-----------|---------|
| XAMPP | 8.2.x |
| Apache | 2.4.x |
| PHP | 8.2.x |
| MySQL | 8.x |
| Visual Studio Code | Latest |

---

# Installation / Telepítés

## 🇬🇧

1. Clone the repository.

```bash
git clone <repository-url>
```

2. Import the SQL dump:

```bash
mysql -u root < database/login_task.sql
```

or import `database/login_task.sql` using phpMyAdmin.

3. Update the database credentials in:

```text
includes/config.php
```

4. Start Apache and MySQL.

5. Open:

```text
http://localhost/login-task/public/
```

---

## 🇭🇺

1. Klónozd a repository-t.

```bash
git clone <repository-url>
```

2. Importáld az SQL fájlt:

```bash
mysql -u root < database/login_task.sql
```

vagy importáld a `database/login_task.sql` fájlt phpMyAdmin segítségével.

3. Szükség esetén módosítsd az adatbázis kapcsolatot itt:

```text
includes/config.php
```

4. Indítsd el az Apache és MySQL szolgáltatásokat.

5. Nyisd meg:

```text
http://localhost/login-task/public/
```

---

# Database / Adatbázis

```
database/login_task.sql
```

---

# Security / Biztonság

- Prepared Statements (mysqli)
- Password Hashing (`password_hash()`)
- Password Verification (`password_verify()`)
- Session Regeneration
- CSRF Protection
- Content Security Policy (CSP)

---

# Project Structure / Projekt struktúra

```text
Login_page-PHP-MySQL
│
├── assets
│   ├── css
│   ├── js
│   └── favicon.ico
│
├── database
│   └── login_task.sql
│
├── includes
│   ├── config.php
│   ├── csrf.php
│   ├── db.php
│   └── security.php
│
├── public
│   ├── dashboard.php
│   ├── index.php
│   ├── logout.php
│   └── register.php
│
├── .gitignore
└── README.md
```

---

# Notes / Megjegyzések

🇬🇧  
The application was intentionally developed using procedural PHP, mysqli and jQuery to match the requirements of the assignment. The focus was on clean code, secure authentication, and a simple user experience without unnecessary frameworks.

🇭🇺  
Az alkalmazás szándékosan procedurális PHP, mysqli és jQuery használatával készült, hogy megfeleljen a feladat kiírásának. A cél a letisztult kód, a biztonságos hitelesítés és az egyszerű felhasználói élmény volt, felesleges keretrendszerek használata nélkül.

---

# Author

**Máté Kopcsó**