include .env

start:
	@docker compose up -d
shell:
	@docker compose exec php /bin/bash
init:
	cp .env.dist .env
	make start
	@docker compose exec php composer install
demo:
	make init
	docker compose exec php bin/console game:play