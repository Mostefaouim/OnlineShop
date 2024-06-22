# OnlineShop

A simple online shopping platform.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [License](#license)
- [Contact](#contact)

## Introduction

OnlineShop is an e-commerce platform that allows users to browse products, add them to a cart, and place orders. It includes user authentication, product management, and order processing features.

## Features

- User registration and authentication
- Product browsing and searching
- Shopping cart management
- Order processing and history
- Admin panel for product management

## Technologies Used

- Frontend: HTML, CSS, Bootsrap
- Backend: PHP
- Database: MySQL

## Installation

### Prerequisites

- Web server (Apache)
- PHP 8.2.12
- MySQL

### Steps

1. Clone the repository:
    ```sh
    git clone https://github.com/Mostefaouim/OnlineShop.git
    ```
2. Navigate to the project directory:
    ```sh
    cd OnlineShop
    ```
3. Import the SQL file to set up the database:
    - Open your MySQL database management tool (phpMyAdmin).
    - Create a new database named `onlineshop`.
    - Import the SQL file located in the `sql` directory:
        ```sh
        source path/to/sql/onlineshop.sql
        ```
4. Configure the database connection:
    - Open `config.php` in the project root.
    - Update the database settings:
        ```php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'onlineshop');
        ```
## Usage

1. Start your web server and ensure it is properly configured to serve PHP applications.
2. Access the application via your web browser:
    ```sh
    http://localhost/OnlineShop
    ```
## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

Mostefaoui - [mohammedmostefaoui2@gmail.com](mailto:mohammedmostefaoui2@gmail.com)

Project Link: [https://github.com/Mostefaouim/OnlineShop](https://github.com/Mostefaouim/OnlineShop)
