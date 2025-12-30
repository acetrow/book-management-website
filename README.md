# Book Library Management System

A PHP-based web application for managing a book library database with full CRUD (Create, Read, Update, Delete) operations. Features a clean, responsive interface with form validation and real-time database updates.

Developed as a database-driven web application demonstrating PHP, MySQL, HTML, and CSS integration with server-side validation and sanitization.

---

## Features

### Database Operations

**Create (Add Books)**
- Add new books with ID, title, author, genre, and publication year
- Real-time duplicate ID detection
- Comprehensive form validation for all fields
- Immediate feedback on successful additions

**Read (View Books)**
- Display all books in formatted HTML table
- Alternating row colors for readability
- Hover effects for better user experience
- Home page with complete book listing

**Update (Edit Books)**
- Selective field updating (modify only what needs changing)
- Optional field updates - leave unchanged fields blank
- Validates book ID existence before updates
- Individual field validation for each attribute

**Delete (Remove Books)**
- Remove books by ID with validation
- Confirms book existence before deletion
- Prevents accidental deletion of non-existent records
- Success/error feedback after operations

### Data Validation

**Book ID Validation**
- Must be numeric
- Maximum 3 digits
- Checks for duplicates (add operation)
- Verifies existence (update/delete operations)
- Cannot be blank

**Title Validation**
- Required field (for add operation)
- Maximum 20 characters
- Prevents SQL injection via sanitization

**Author Validation**
- Required field (for add operation)
- Maximum 30 characters
- Must not be numeric value
- Sanitized input

**Genre Validation**
- Required field (for add operation)
- Maximum 30 characters
- Free text input with length restrictions

**Year Published Validation**
- Must be numeric
- Valid range: 1400-2023
- Required field (for add operation)
- Prevents future dates and unrealistic historical dates

### User Interface

**Navigation Menu**
- Horizontal navigation bar with hover effects
- Active page highlighting in green
- Links to: Home, Add Data, Delete Data, Edit & Update
- Consistent across all pages

**Styled Tables**
- Green header with white text
- Striped rows for readability
- Hover effects on rows
- Responsive 50% width layout

**Form Styling**
- Green submit buttons with hover effects
- Consistent input field styling
- Rounded corners and proper spacing
- Error messages in red
- Success messages in standard text

**Error Handling**
- Color-coded error messages (red)
- Specific validation error descriptions
- Success confirmations after operations
- Database connection status display

---

## Project Structure

- `index.php` — Home page displaying all books with navigation menu
- `add_row.php` — Form and logic for adding new books to database
- `delete_row.php` — Form and logic for deleting books by ID
- `update_row.php` — Form and logic for updating existing book records
- `create_table.php` — Database table creation script
- `connect.php` — MySQL database connection configuration
- `index.css` — Styles for home page (navigation, table)
- `add_row.css` — Styles for add book page
- `delete_row.css` — Styles for delete book page
- `update_row.css` — Styles for update book page

---

## Requirements

**Server Environment**
- PHP 7.0 or newer
- MySQL 5.6 or newer
- Apache Web Server (XAMPP recommended)

**PHP Extensions**
- mysqli (MySQL Improved Extension)

**Database**
- MySQL database named: `23db391`
- Table named: `booklists`

---

## Installation and Setup

### 1. Install XAMPP

Download and install XAMPP from https://www.apachefriends.org/
Start Apache and MySQL services from XAMPP Control Panel

### 2. Create Database

Open phpMyAdmin (http://localhost/phpmyadmin)
Create new database named: 23db391
Or run SQL command: CREATE DATABASE 23db391;

### 3. Deploy Files

Copy all project files to XAMPP htdocs directory:
Windows: C:\xampp\htdocs\book-library\
Mac/Linux: /Applications/XAMPP/htdocs/book-library/

### 4. Configure Database Connection

Edit connect.php if needed (defaults work for XAMPP):
$hn = 'localhost';
$db = '23db391';
$un = 'root';
$pw = '';

### 5. Create Database Table

Navigate to: http://localhost/book-library/create_table.php
This creates the booklists table with proper schema
You should see: "Your table has been created"

### 6. Access Application

Open browser and navigate to: http://localhost/book-library/index.php

---

## Usage

### Adding a Book

1. Navigate to "Add data" from menu
2. Fill in all required fields:
   - Book id (numeric, max 3 digits, unique)
   - Book title (max 20 characters)
   - Author name (max 30 characters, non-numeric)
   - Genre (max 30 characters)
   - Year Published (numeric, 1400-2023)
3. Click "ADD RECORD"
4. Book appears in table below form
5. Success/error message displays above table

### Updating a Book

1. Navigate to "Edit & Update" from menu
2. Enter Book id (required) of book to update
3. Fill in ONLY the fields you want to change
4. Leave unchanged fields blank
5. Click "UPDATE RECORD"
6. Changes reflected in table below
7. Note: Can update title, author, genre, or year individually

### Deleting a Book

1. Navigate to "Delete data" from menu
2. Enter Book id of book to remove
3. Click "DELETE RECORD"
4. Book removed from database
5. Updated table displays without deleted book
6. Confirmation message shows success

### Viewing All Books

1. Navigate to "Home" from menu
2. All books display in formatted table
3. Table shows: ID, Title, Author, Genre, Year Published
4. Live data from database

---

## Database Schema

Table: booklists

| Column | Type           | Constraints      | Description          |
|--------|----------------|------------------|----------------------|
| id     | INT UNSIGNED   | PRIMARY KEY, NOT NULL | Unique book identifier |
| title  | VARCHAR(100)   | NOT NULL         | Book title           |
| author | VARCHAR(50)    | NOT NULL         | Author name          |
| genre  | VARCHAR(30)    | NOT NULL         | Book genre/category  |
| year   | INT UNSIGNED   | NOT NULL         | Publication year     |

---

## Security Features

**SQL Injection Prevention**
- Uses mysqli real_escape_string() for all user inputs
- Prepared statement-style sanitization
- Validation before database queries

**Input Validation**
- Server-side validation for all fields
- Type checking (numeric, string)
- Length restrictions enforced
- Range validation for years

**Error Handling**
- Database connection error messages
- Query failure detection
- User-friendly error messages
- No exposure of sensitive database details in production

---

## Example Validation Rules

**Valid Book Entry:**
- ID: 123
- Title: "The Great Gatsby"
- Author: "F. Scott Fitzgerald"
- Genre: "Classic Fiction"
- Year: 1925

**Invalid Entries:**
- ID: "abc" (not numeric)
- ID: 12345 (exceeds 3 digits)
- Title: "" (blank)
- Author: "123" (numeric)
- Year: 2025 (future date)
- Year: 1300 (before valid range)

---

## Color Scheme

- Primary Color: #4CAF50 (Green)
- Background: #f2f2f2 (Light Gray)
- Border: #ddd (Medium Gray)
- Hover: #45a049 (Dark Green)
- Error Text: #FF0000 (Red)
- Text: #666666 (Dark Gray)

---

## License

This project is released under the MIT License.# book-management-website