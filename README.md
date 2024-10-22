# File Upload Attributes Microservice

This microservice is designed to store and retrieve attributes related to uploaded files via a RESTful API. The microservice is implemented in PHP using the Slim framework and stores file attributes (like file name, size, uploader ID, and timestamp) in a MySQL database.

This README provides instructions on how to set up, run, deploy, and get started with the microservice, including how to perform unit tests.

## Table of Contents

- [Features](#features)
- [System Requirements](#system-requirements)
- [Getting Started](#getting-started)
  - [Installation](#installation)
  - [Database Setup](#database-setup)
  - [Running the Application](#running-the-application)
- [API Endpoints](#api-endpoints)
- [Unit Tests](#unit-tests)
- [Deployment](#deployment)
- [Environment Variables](#environment-variables)

## Features

- Store file attributes (file name, size, uploader ID, and upload timestamp).
- Retrieve stored file attributes through a RESTful API.
- JSON-based API responses.
- Unit test coverage for key functionalities.

## System Requirements

- PHP >= 7.4
- Composer (PHP package manager)
- MySQL/MariaDB database
- Apache or Nginx web server

## Getting Started

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/file-upload-attributes-microservice.git
    cd file-upload-attributes-microservice
    ```

2. **Install dependencies:**

    Run the following command to install all required packages and libraries using Composer.

    ```bash
    composer install
    ```

3. **Environment Setup:**

    Create a `.env` file at the root of the project and configure your environment variables, such as database credentials.

    ```bash
    cp .env.example .env
    ```

    Then, fill in the `.env` file with your local MySQL database credentials:

    ```dotenv
    DB_HOST=localhost
    DB_NAME=file_upload_service
    DB_USER=root
    DB_PASS=yourpassword
    ```

### Database Setup

1. **Create the Database:**

    Log into MySQL and create a new database called `file_upload_service` (or whatever you configured in the `.env` file):

    ```sql
    CREATE DATABASE file_upload_service;
    ```

2. **Create the Table:**

    Run the following SQL command to create the table that stores file attributes:

    ```sql
    CREATE TABLE file_attributes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        file_name VARCHAR(255) NOT NULL,
        file_size INT NOT NULL,
        uploader_id INT NOT NULL,
        upload_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

### Running the Application

To run the application locally, follow these steps:

1. **Start the PHP Development Server:**

    You can run the app locally using the PHP built-in web server by running the following command in the project directory:

    ```bash
    php -S localhost:8080 -t public
    ```

2. **Access the API:**

    The service should now be running at `http://localhost:8080`. You can access the API endpoints (see [API Endpoints](#api-endpoints) section below).

## API Endpoints

### Store File Attributes (POST `/file`)

Stores file attributes in the database.

- **URL:** `POST /file`
- **Headers:** `Content-Type: application/json`
- **Body:**
  ```json
  {
    "file_name": "example.jpg",
    "file_size": 2048,
    "uploader_id": 1
  }
