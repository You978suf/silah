# SILAH — Startup Platform

SILAH is a multi-page web platform that connects aspiring founders with **investors**,
**consultants**, and **team members** to help them start, build, and grow their startups.

## Project structure

```
web-project/
├── index.html              # Home (hero + feature cards)
├── Consultants.html        # Browse / search consultants
├── Investors.html          # Browse investors
├── TeamMembers.html        # Browse team members
├── AboutUs.html            # About the platform
├── ContactUs.html          # Contact form (saves to DB)
├── login.html              # Log in
├── signup.html             # Create an account
├── calculation.html        # Subscription plans / pricing
├── checkout.html           # Checkout flow
├── funpage.html            # "Fun time" page
│
├── assets/
│   ├── css/
│   │   └── style.css       # Shared design system (imported by every page)
│   ├── js/
│   │   └── planRetrieve.js # Plan retrieval logic
│   └── img/                # All images, logos, and icons
│
└── php/                    # Server-side handlers (PHP + MySQL)
    ├── handle_login.php
    ├── handle_account.php
    ├── handle_submission.php
    ├── search.php / search2.php / search3.php
    └── delete.php
```

## Tech stack

- **HTML5** + **Bootstrap 5** for markup and grid
- **CSS3** custom design system (`assets/css/style.css`) — CSS variables, Poppins font,
  responsive layout, cards, and hover animations
- **JavaScript** for the rotating hero, live clock, and dynamic content
- **PHP + MySQL** for forms, login, and search (database name: `silah`)

## Running the site

The static pages open directly in any browser. To use the forms (login, sign up, contact),
serve the project with a PHP/MySQL stack such as **XAMPP**:

1. Copy this folder into `htdocs/`.
2. Start Apache + MySQL, create a database named `silah` with the
   `logedin`, `submissions`, and related tables.
3. Visit `http://localhost/web-project/index.html`.

## Notes

- `assets/img/question.jpg` is referenced by `checkout.html` (a math-captcha image) but was
  never included in the original repository — add the image to restore that feature.
- Database credentials in the PHP files default to `root` / no password (XAMPP defaults).
