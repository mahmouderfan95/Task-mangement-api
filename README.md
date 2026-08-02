# Task Management API

## Overview

Task Management API is a RESTful API built with Laravel 11 for managing projects and tasks. The application allows authenticated users to manage their own projects and tasks with filtering, searching, pagination, and dashboard statistics.

---

## Features

### Authentication

* User Registration
* User Login
* User Logout
* Laravel Sanctum Authentication

### Projects

* Create Project
* List Projects
* View Project
* Update Project
* Delete Project

Project Statuses:

* Active
* Completed
* Archived

### Tasks

Each project can contain multiple tasks.

Features:

* Create Task
* Update Task
* Delete Task
* List Tasks
* Filter by Status
* Filter by Priority
* Search by Title

Task Priorities:

* Low
* Medium
* High

Task Statuses:

* Todo
* In Progress
* Done

### Dashboard

Returns:

* Total Projects
* Active Projects
* Total Tasks
* Completed Tasks
* Pending Tasks
* Overdue Tasks

---

# Tech Stack

* Laravel 11
* PHP 8.2+
* Laravel Sanctum
* MySQL
* REST API
* Eloquent ORM

---

# Architecture

The project follows a layered architecture and includes:

* Repository Pattern
* Service Layer
* Form Request Validation
* API Resources
* Eloquent Relationships
* Soft Deletes
* Database Factories
* Database Seeders
* Feature Tests

---

# Installation

Clone the repository

```bash
git clone https://github.com/mahmouderfan95/Task-mangement-api
```

Go to project

```bash
cd task-management-api
```

Install dependencies

```bash
composer install
```

Copy environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database inside the `.env` file.

Run migrations and seeders

```bash
php artisan migrate --seed
```

Start the application

```bash
php artisan serve
```

---

# Authentication

The API uses Laravel Sanctum.

After login, include the access token in every authenticated request.

Example:

```
Authorization: Bearer YOUR_ACCESS_TOKEN
```

---

# API Endpoints

## Authentication

| Method | Endpoint      |
| ------ | ------------- |
| POST   | /api/register |
| POST   | /api/login    |
| POST   | /api/logout   |

---

## Projects

| Method | Endpoint           |
| ------ | ------------------ |
| GET    | /api/projects      |
| POST   | /api/projects      |
| GET    | /api/projects/{id} |
| PUT    | /api/projects/{id} |
| DELETE | /api/projects/{id} |

---

## Tasks

| Method | Endpoint                      |
| ------ | ----------------------------- |
| GET    | /api/tasks                    |
| POST   | /api/projects/{project}/tasks |
| GET    | /api/tasks/{id}               |
| PUT    | /api/tasks/{id}               |
| DELETE | /api/tasks/{id}               |

### Available Filters

Filter by status

```
GET /api/tasks?status=todo
```

Filter by priority

```
GET /api/tasks?priority=high
```

Search by title

```
GET /api/tasks?search=laravel
```

Multiple filters

```
GET /api/tasks?status=done&priority=high&search=api
```

Pagination

```
GET /api/tasks?per_page=10
```

---

## Dashboard

| Method | Endpoint       |
| ------ | -------------- |
| GET    | /api/dashboard |

---

# Running Tests

```bash
php artisan test
```

---

# Database Seeding

Generate sample data

```bash
php artisan migrate:fresh --seed
```

---

# Postman Collection

A Postman collection is included in the project root.

```
Task Management.postman_collection.json
```

---

# Project Structure

```
app
├── Enums
├── Http
│   ├── Controllers
│   ├── Requests
│   └── Resources
├── Models
├── Repositories
├── Services
└── Traits
```

---

# Author

Developed as part of a Laravel Mid-Level Technical Assessment.
