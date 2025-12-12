README – Setup Guide


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
http://localhost:8000/public

Open swagger url:
https://app.swaggerhub.com/apis/pegcodestechnologies/product-shopping-cart-api/1.0.0


Option 2 – Using PHP built-in server
cd /public

Run below code in terminal: 
php -S localhost:8000

4. Testing the API (Postman)
Login to get token (Get Token)

POST /login

Enter username and password 
{ "username": "superAdmin", "password": "password123" }

Enter username and password - use this password for swagger Login
{ "username": "superAdmin", "password": "password123" }

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
