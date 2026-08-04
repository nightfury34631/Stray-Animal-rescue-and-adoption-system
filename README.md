🐾 Stray Animal Rescue & Adoption Management System

The Stray Animal Rescue & Adoption Management System is a full-stack web application developed using PHP, MySQL, and Bootstrap 5 to improve the management of stray animal welfare. The platform provides a centralized and role-based system where Administrators, Rescuers, Veterinarians, and Adopters collaborate to manage the complete lifecycle of stray animals efficiently.

Unlike a traditional CRUD application, the system follows a structured workflow. Rescuers can report newly sighted stray animals, which are then reviewed by an administrator before being added to the animal database. Once approved, rescue operations are recorded, medical treatments are managed by veterinarians, and adopters can submit adoption requests for eligible animals. This workflow ensures that every animal is tracked from its first sighting to successful rehabilitation and rehoming.

📌 Workflow
        Report Sighting
               │
               ▼
      Admin Reviews Report
               │
      ┌────────┴────────┐
      │                 │
  Reject Report     Approve Report
                         │
                         ▼
              Add Animal to Database
                         │
                         ▼
                Rescue Operation
                         │
                         ▼
                 Medical Treatment
                         │
                         ▼
                Adoption Request
                         │
                         ▼
                Successful Rehoming 🏡
✨ Key Features
🔐 Secure role-based authentication (Admin, Rescuer, Veterinarian, Adopter)
🐾 Stray animal sighting with admin approval workflow
🐶 Animal management (Create, Read, Update, Delete)
🚑 Rescue tracking and status management
🩺 Medical record management
🏡 Adoption request and approval system
🔍 Search and filter functionality
📊 Dashboard with real-time statistics using SQL aggregate functions
🔗 Relational database with JOIN operations, constraints, and foreign keys
📱 Responsive user interface built with Bootstrap 5


🛠️ Tech Stack
Category	Technology
Frontend	HTML5, CSS3, Bootstrap 5
Backend	PHP
Database	MySQL
Server	Apache (XAMPP)
Tools	phpMyAdmin, Visual Studio Code


🗄️ Database Concepts Implemented
CRUD Operations
SQL JOIN Operations
Aggregate Functions (COUNT())
Primary & Foreign Keys
Database Constraints
Role-Based Access Control (RBAC)
Search & Filtering
Relational Database Design


🎯 Project Objective

This project was developed to demonstrate practical full-stack web development and database management skills while addressing a real-world problem. By integrating structured workflows, role-based access control, and relational database concepts, the application provides an efficient platform for managing stray animal rescue, treatment, and adoption from start to finish.
