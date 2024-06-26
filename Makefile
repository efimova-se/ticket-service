up: ## Up application
	./vendor/bin/sail up -d

stop: ## Stop application
	./vendor/bin/sail stop

build: ## Build application
	./vendor/bin/sail build --no-cache
	./vendor/bin/sail up -d

rebuild: ## Rebuild application
	docker compose down -v
	./vendor/bin/sail build --no-cache
	./vendor/bin/sail up -d

test: ## Run application tests
	./vendor/bin/sail test

init: ## Application first init
	docker run --rm \
	-u "$(shell id -u):$(shell id -g)" \
	-v "$(shell pwd):/var/www/html" \
	-w /var/www/html \
	laravelsail/php83-composer:latest \
	composer install --ignore-platform-reqs
	./vendor/bin/sail artisan key:generate

key: ## Run application tests
	./vendor/bin/sail artisan key:generate

