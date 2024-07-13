# Project Name 
i would say my first E-commerce backend project using PHP and laravel.

# Features
user can do the following:-
-register and login
-view a product
-add the product to his cart
-remove products from his cart
-make an order
-check orders (admin)
-check items in the order (admin)

# Getting Started
-install composer components 
-make .env
-make a database and connect it in the .env file
-regenerate the app key (php artisan key:generate)

# Prerequisites
-php
-composer
-php server (ex.XAMPP controller)
-Node.js


#Configuration
database must be in MySQL

#Usage
the app so far is only API testing so you will need POSTMAN

# Database Schema
[User]
- id: int (PK)
- name: varchar
- email: varchar
- email_verified_at: timestamp
- password: varchar
- created_at: timestamp
- updated_at: timestamp

[Cart]
- id: int (PK)
- user_id: int (FK to User)
- created_at: timestamp
- updated_at: timestamp
- 
[Categories]
-name:varchar
-description:varchar

[CartItem]
- id: int (PK)
- cart_id: int (FK to Cart)
- product_id: int (FK to Product)
- quantity: int
- created_at: timestamp
- updated_at: timestamp

[Product]
- id: int (PK)
- name: varchar
- description: text
- price : decimal
- category_id : int (FK to category )
- image : varchar
- quantity : int
  
[Order]
- id: int (PK)
- user_id: int (FK to User)
- total_amount: decimal
- order_date: date
- total_price: decimal
- created_at: timestamp
- updated_at: timestamp

[orderdetails]
- id: int (PK)
- order_id: int (FK to Order)
- product_id: int (FK to Product)
- quantity: int
- unit_price: decimal
- created_at: timestamp
- updated_at: timestamp

