DOCKER_COMPOSE_CONFIG_FILE=docker-compose.yml

.PHONY: setup build run

install: setup build

setup:
	which ./docker-compose || curl -L https://github.com/docker/compose/releases/download/1.8.0/run.sh > ./docker-compose; \
	chmod +x ./docker-compose

build:
	docker-compose -f $(DOCKER_COMPOSE_CONFIG_FILE) build

clean:
	docker-compose -f $(DOCKER_COMPOSE_CONFIG_FILE) down

logs:
	docker-compose -f $(DOCKER_COMPOSE_CONFIG_FILE)  logs -f

run:
	docker-compose -f $(DOCKER_COMPOSE_CONFIG_FILE) up -d

sf3:
	docker-compose -f $(DOCKER_COMPOSE_CONFIG_FILE) exec php bash

db:
	docker-compose -f $(DOCKER_COMPOSE_CONFIG_FILE) exec db mysql -u root -proot mydb