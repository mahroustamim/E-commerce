## About the Project
This e-commerce platform allows users to browse products, place orders, and make secure payments. The platform supports multiple product categories, payment gateways, and an intuitive user experience for both shoppers and administrators.

**website home page**
![Alt text](https://github.com/mahroustamim/E-commerce/blob/main/website-home.png)


**dashboard home page**
![Alt text](https://github.com/mahroustamim/E-commerce/blob/main/dashboard-home.png)


## Features Overview
- Product Management: Add, edit, and delete products with categories .
- Category Management: Add, edit, and delete.
- Supervisor management: Add, edit, and delete.
- Settings Management: Change website name, description, logo, and favicon.
- Social Media Control: Manage email, Facebook, Instagram, and Twitter links.
- Logs & Reports: View logs and reports of user activity on the website.
- Order Management: Control the status of orders (pending - delivering -completed)
- Multi-Language Support: Easily switch between different languages (Engilsh - arabic).
- User Authentication: Secure login and registration using Laravel's built-in authentication.
- Payment Gateway Integration: Accept payments via Stripe.
- Responsive Design: Mobile-friendly layout for a seamless experience across devices.
- Product Search with Filters: Users can search and filter products.
- Contact Us Page: Allow users to get in touch for any issues.
- Rating System: Allow users to rate products on a scale (e.g., 1 to 5 stars).
- Comment System: Allows users to ask questions or share their opinions, creating a sense of community around products.
- Website pages: home, about, contact, categories, products, cart, shopping cart, checkout, login, and register page


## Tech Stack
- Backend: php 8.3 (Laravel 10 framework)
- Frontend: Blade templates, JS, CSS, Bootstrap
- Database: MySQL
- Payment Integration: Stripe API
- Email Service: mailtrap for sending transactional emails
- Environment: Ubuntu for development and deployment
  
## installation 

```
$ git clone https://github.com/mahroustamim/E-commerce.git
$ cd E-commerce
$ composer install
$ cp .env.example .env # THEN EDIT YOUR ENV FILE ACCORDING TO YOUR OWN SETTINGS.
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
```

## Configuration
- Database: Set the connection details for MySQL.
- Stripe: Add your Stripe API keys (STRIPE_KEY, STRIPE_SECRET).
- Email: Configure your email service (e.g., Mailtrap or your preferred provider)
- Time Zone: Adjust the timezone to Africa/Cairo if needed.

## Usage
- Admin: Has full permissions, including managing products, orders, users, and settings.
- Supervisor: Has all permissions except adding supervisors and viewing users.
- User: Can browse products and place orders.

## Contributing
Contributions are welcome! Please fork the repository, create a new branch, and submit a pull request. Make sure to follow coding standards and provide thorough testing.

- Fork the repository.
- Create a new feature branch: git checkout -b feature/your-feature-name.
- Commit your changes: git commit -m 'Add some feature'.
- Push the branch: git push origin feature/your-feature-name.
- Open a pull request.

## database schema

![Alt text](https://github.com/mahroustamim/E-commerce/blob/main/database.png)

## License

this project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contact
For any queries or issues:

- Name: Mahrous Tamim
- Email: mahroustamim@example.com
- phone: 01121665185







