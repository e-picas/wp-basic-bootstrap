# This is for development purpose only

.ONESHELL:
docker-php-build:
	docker build -t wp_basic_btst_php -f - . <<- EOT
	FROM php:7.4.33-fpm
	RUN set -x \
	    && export DEBIAN_FRONTEND=noninteractive \
	    && echo "deb http://http.debian.net/debian bullseye-backports contrib non-free main" >> /etc/apt/sources.list \
	    && apt update \
	    && apt install --no-install-recommends --fix-missing -t bullseye-backports -y wget zip unzip \
	    && apt dist-upgrade -y -t bullseye-backports
	RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.0 && \
	    chmod +x /usr/local/bin/composer
	EOT
.PHONY: docker-php-build

run-php-cs-fixer: docker-php-build
	docker run -i --rm \
		--name wp_basic_btst \
		-v $$(pwd):/wp-basic-bootstrap \
		-w /wp-basic-bootstrap \
		wp_basic_btst_php bash -s <<- EOT
		composer install
		composer run cs-fixer
		EOT
.PHONY: docker-php-run

docker-php-run: docker-php-build
	docker run -ti --rm \
		--name wp_basic_btst \
		-v $$(pwd):/wp-basic-bootstrap \
		-w /wp-basic-bootstrap \
		wp_basic_btst_php bash
.PHONY: docker-php-run

docker-npm-run:
	docker run -ti --rm \
		--name wp_basic_btst \
		-v $$(pwd):/wp-basic-bootstrap \
		-w /wp-basic-bootstrap \
		node:20-bullseye sh
.PHONY: docker-npm-run
