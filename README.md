# Project Name

Avaliance Coding Challenge.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [API REST](#api-rest)
- [Testing](#testing)

## Prerequisites

Before running the project, ensure you have the following dependencies installed:

- PHP version ^8.1
- Laravel framework ^10.10
- Docker

## Installation

Follow these steps to install and set up the project:

1. Clone the project repository:

```bash
git clone https://github.com/ayoubsabi/avaliance-code-challenge
```

2. Install dependencies:

```bash
cd avaliance-code-challenge
composer install
```

3. Modify the .env file:

```bash
cp .env.example .env
```
Make any necessary changes to the .env file to match your local environment settings.

4. Build Docker container:

```bash
./vendor/bin/sail up
```

5. To migrate and seed the database access to laravel.test container terminal and run:

```bash
php artisan migrate --seed
```

Now you're ready to use the project!

## API REST

- Register endpoint: *POST: api/register*
    - Example:
    ```javascript
    axios.post('http://127.0.0.1:8000/api/register', {
        name: 'Ayoub Sabi',
        email: 'ayoub@mail.com',
        password: 'Hello108*',
        password_confirmation: 'Hello108*'
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Login endpoint: *POST: api/login*
    - Example:
    ```javascript
    axios.post('http://127.0.0.1:8000/api/login', {
        email: 'ayoub@mail.com',
        password: 'Hello108*'
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Logout endpoint (Authentication required): *GET: api/logout*
    - Example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/logout', {
        headers: {
            Authorization: 'Bearer <TOKEN>'
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Product list endpoint: *GET: api/products*
    - All products example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/products')
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

    - Filter by category example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/products', {
        params: {
            category_id: 1
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

    - Order by name example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/products', {
        params: {
            order_by: {
                column: 'name',
                orientation: 'asc'
            }
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

    - Order by price example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/products', {
        params: {
            order_by: {
                column: 'price',
                orientation: 'desc'
            }
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Product show endpoint: *GET: api/products/{id}*
    - Example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/products/1')
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Product create endpoint (Authentication required): *POST: api/products*
    - Example:
    ```javascript
    axios.post('http://127.0.0.1:8000/api/products', {
        name: 'Test Product 2',
        sku: 'TEST04',
        price: 10,
        quantity: 8,
        category_id: 1
    }, {
        headers: {
            Authorization: 'Bearer <TOKEN>'
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Product update endpoint (Authentication required): *PATCH/PUT: api/products/{id}*
    - Example:
    ```javascript
    axios.patch('http://127.0.0.1:8000/api/products/1', {
        quantity: 10
    }, {
        headers: {
            Authorization: 'Bearer <TOKEN>'
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Product delete endpoint (Authentication required): *DELETE: api/products/{id}*
    - Example:
    ```javascript
    axios.delete('http://127.0.0.1:8000/api/products/1', {
        headers: {
            Authorization: 'Bearer <TOKEN>',
        }
    })
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error);
    });
    ```

- Category list endpoint: *GET: api/categories*
    - All categories example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/categories')
        .then(response => {
            // Handle success
            console.log(response.data);
        })
        .catch(error => {
            // Handle error
            console.error(error);
        });
    ```
    
    - Filter by parent example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/categories', {
        params: {
           parent_id : 1
        }
    })
    .then(response => {
        // Handle success
        console.log(response.data);
    })
    .catch(error => {
        // Handle error
        console.error(error);
    });
    ```

    - Order by name example:
    ```javascript
    axios.get('http://127.0.0.1:8000/api/categories', {
        params: {
            order_by: {
                column: 'name',
                orientation: 'asc'
            }
        }
    })
    .then(response => {
        // Handle success
        console.log(response.data);
    })
    .catch(error => {
        // Handle error
        console.error(error);
    });
    ```

## Testing

To test product creation access to laravel.test container terminal and run
```bash
./vendor/bin/phpunit
```
