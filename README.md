## Project installation steps

- Clone project from this repository
- Run `composer install`
- Modify .env file if any changes needed
- Run `./vendor/bin/sail up` to build docker container
- Access to laravel.test container terminal and run `php artisan migrate --seed`

## API REST

- Register endpoint: *POST: api/register*
    - example: `http://127.0.0.1:8000/api/register` payload `{"name": "Ayoub Sabi", "email": "ayoub@mail.com", "password": "Hello108*", "password_confirmation": "Hello108*"}`

- Login endpoint: *POST: api/login*
    - example: `http://127.0.0.1:8000/api/login` payload `{"email": "ayoub@mail.com", "password": "Hello108*"}`

- Logout endpoint (Authentication required): *GET: api/logout*
    - example: `http://127.0.0.1:8000/api/logout`

- Product list endpoint: *GET: api/products*
    - all products example: `http://127.0.0.1:8000/api/products`
    - filter by category example: `http://127.0.0.1:8000/api/products?category_id=1`
    - order by name example: `http://127.0.0.1:8000/api/products?order_by[column]=name&order_by[orientation]=asc`
    - order by price example: `http://127.0.0.1:8000/api/products?order_by[column]=price&order_by[orientation]=desc`

- Product show endpoint: *GET: api/products/{id}*
    - example: `http://127.0.0.1:8000/api/products/1`

- Product create endpoint (Authentication required): *POST: api/products*
    - example: `http://127.0.0.1:8000/api/products` payload `{"name": "Test Product 2", "sku": "TEST04", "price": 10, "quantity": 8, "category_id": 1}`

- Product update endpoint (Authentication required): *PATCH/PUT: api/products/{id}*
    - example: `http://127.0.0.1:8000/api/products/1` payload `{"quantity": 12}`

- Product delete endpoint (Authentication required): *DELETE: api/products/{id}*
    - example: `http://127.0.0.1:8000/api/products/1`

- Category list endpoint: *GET: api/categories*
    - all categories example: `http://127.0.0.1:8000/api/categories`
    - filter by parent example: `http://127.0.0.1:8000/api/categories?parent_id=1`
    - order by name example: `http://127.0.0.1:8000/api/categories?order_by[column]=name&order_by[orientation]=asc`
    
## Testing

- To test product creation access to laravel.test container terminal run `vendor/bin/phpunit`
