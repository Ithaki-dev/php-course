# Workshop 2 Project

## Overview
This project is a simple PHP web application that collects user data through a form and stores it in a MySQL database using XAMPP.

## Project Structure
```
Workshop_2
├── config
│   └── database.php
├── includes
│   ├── header.php
│   └── footer.php
├── css
│   └── style.css
├── js
│   └── script.js
├── process
│   └── insert_data.php
├── index.php
├── form.php
└── README.md
```

## Setup Instructions

1. **Install XAMPP**: Download and install XAMPP from the official website. Start the Apache and MySQL modules from the XAMPP control panel.

2. **Create Database**:
   - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin`.
   - Create a new database named `workshop2`.
   - Create a table named `users` with the following fields:
     - `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
     - `name` (VARCHAR(100))
     - `surname` (VARCHAR(100))
     - `email` (VARCHAR(100))
     - `phone` (VARCHAR(15))

3. **Configure Database Connection**:
   - Open `config/database.php` and update the database connection settings if necessary.

4. **Run the Application**:
   - Place the `Workshop_2` folder in the `htdocs` directory of your XAMPP installation (usually located at `C:\xampp\htdocs`).
   - Access the application by navigating to `http://localhost/Workshop_2/form.php` in your web browser.

## Usage
- Fill out the form with your Name, Surname, Email, and Phone.
- Submit the form to save the data into the database.
- You can check the `users` table in phpMyAdmin to see the submitted data.

## Files Description
- `config/database.php`: Contains database connection settings.
- `includes/header.php`: HTML header section.
- `includes/footer.php`: HTML footer section.
- `css/style.css`: Styles for the web application.
- `js/script.js`: JavaScript functionality.
- `process/insert_data.php`: Processes form submissions and inserts data into the database.
- `index.php`: Main entry point of the application.
- `form.php`: HTML form for data collection.