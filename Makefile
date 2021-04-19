SHELL := /bin/bash

fixtures_tests: export APP_ENV=test
fixtures_tests:
	symfony console doctrine:database:drop --force || true
	symfony console doctrine:database:create
	symfony console doctrine:migrations:migrate -n
	symfony console doctrine:fixtures:load -n
.PHONY: fixtures_tests