README – Simple Setup Guide

This is a simple PHP API for products, shopping cart, and admin login.

1. Install Dependencies

Install Composer

Open the project folder in terminal

Run:

composer install 

This installs the JWT package.


2. Import Database

Open phpMyAdmin

Create a database
Import the SQL file provided
Add an admin user: username, password

3. Run the API Locally
Option 1 – Using XAMPP

Move project into htdocs folder:

htdocs/

Open in browser:
http://localhost/public


Option 2 – Using PHP built-in server
cd /public

Run below code in terminal: 
php -S localhost:8000

4. Testing the API (Postman)
Login to get token (Get Token)

POST /login

Enter username and password 
{ "username": "exampleuser", "password": "exapassword12" }

Get Products

GET /products

Create Product (Requires Token)

POST /products

Header:

Authorization: Bearer YOUR_TOKEN

Add to Cart

POST /cart

View Cart

GET /cart
