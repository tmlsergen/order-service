# Order Service

## Requirements
- Docker
- Docker Compose
- PHP 8.2
- Composer

## Description
This project is a simple order service. It has 4 tables. `orders`, `users`, `order_product` and `products`. You can fetch orders with products. Orders are related with products and users. You can filter, sort and paginate orders.

## Installation
1. Clone Project
> `git clone https://github.com/tmlsergen/order-service.git`
2. Copy .env file
> `cp .env.example .env`
3. Install composer dependencies
> `composer install`
4. Starting Docker Containers
> `./vendor/bin/sail up -d`
5. You can see the working containers with `docker ps`
```
CONTAINER ID   IMAGE                         COMMAND                  CREATED          STATUS                             PORTS                                                  NAMES
1815dbafee0c   sail-8.2/app                  "start-container"        15 seconds ago   Up 13 seconds                      0.0.0.0:80->80/tcp, 0.0.0.0:5173->5173/tcp, 8000/tcp   order2-laravel.test-1
6d1a35ed702e   mysql/mysql-server:8.0        "/entrypoint.sh mysq…"   15 seconds ago   Up 14 seconds (health: starting)   0.0.0.0:3306->3306/tcp, 33060-33061/tcp                order2-mysql-1
7f3c65003e2c   getmeili/meilisearch:latest   "tini -- /bin/sh -c …"   15 seconds ago   Up 14 seconds (health: starting)   0.0.0.0:7700->7700/tcp                                 order2-meilisearch-1
e9644f228d7c   redis:alpine                  "docker-entrypoint.s…"   15 seconds ago   Up 14 seconds (health: starting)   0.0.0.0:6379->6379/tcp                                 order2-redis-1

```
6. You can access container bash with
> `docker exec -ti app_container_id /bash`
7. Run migrations
> `php artisan migrate --seed`

## Usage
1. You can access the application with `http://localhost:80`
2. You can perform GET operations with `http://localhost:80/api/orders`
3. You can filter orders with `filters` parameter
> `http://order-service.test/api/orders?filters[0][field]=status&filters[0][operator]=&filters[0][value]=pending`
4. You can sort orders with `sort` parameter
> `http://order-service.test/api/orders?sort[field]=id&sort[direction]=desc`
5. You can paginate orders with `paging` parameter
> `http://order-service.test/api/orders?paging[page]=1&paging[limit]=10`

## Tests
1. You can run tests with `php artisan test --env=.env`

# Environments
.env db connection on container
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=order_service
DB_USERNAME=sail
DB_PASSWORD=password
```
