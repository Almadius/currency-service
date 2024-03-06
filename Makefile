# Makefile для управления Docker контейнерами в Laravel проекте

up:
	docker-compose up -d

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d

build:
	docker-compose build

bash:
	docker-compose exec app bash

migrate:
	docker-compose exec app php artisan migrate

test:
	docker-compose exec app php artisan test

logs:
	docker-compose logs -f

composer-install:
	docker-compose run --rm composer install

composer-update:
	docker-compose run --rm composer update

npm-install:
	docker-compose run --rm npm install

npm-run-dev:
	docker-compose run --rm npm run dev

npm-run-watch:
	docker-compose run --rm npm run watch

.PHONY: up down restart build bash migrate seed test logs composer-install composer-update npm-install npm-run-dev npm-run-watch
