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

