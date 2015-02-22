.PHONY: all css clean clean-yaml clean-thumbnails js-timestamp js

PORT=8080
PANELS = $(wildcard panels/*.jpg)
THUMBNAILS = $(patsubst panels/%,panels/thumbnails/%,$(PANELS))
YAML = $(wildcard panels/*.yaml)
YAML_TARGETS = $(patsubst panels/%,panels/yaml_lock/%,$(YAML))
COFFEE = $(wildcard js/*.coffee)
JS = $(patsubst %.coffee, %.js, $(COFFEE))
GULP=$(shell npm bin)/gulp

all: composer css thumbnails js yaml

clean: clean-yaml clean-thumbnails

thumbnails: $(THUMBNAILS)

clean-thumbnails:
	rm -f panels/thumbnails/*

yaml: $(YAML_TARGETS)

clean-yaml:
	rm -f panels/yaml_lock/*

css:
	$(GULP)

coffee: $(JS)
	
js:
	$(GULP)

js-timestamp:
	stat --printf="js_timestamp=\"%Y\"" js/ > js/js.conf

%.js: %.coffee
	coffee -c $<
	$(MAKE) js-timestamp

panels/thumbnails/%.jpg: panels/%.jpg
	convert $< -resize 118x -gravity Center -crop 118x118+0+0 $(patsubst panels/%,panels/thumbnails/%,$(<))

panels/yaml_lock/%.yaml: panels/%.yaml
	# scripts/fb_yaml.php $?

composer:
	composer install --no-dev -o

run:
	php -S localhost:$(PORT) cli-server.routing.php

nginx_docker:
	docker run -d --net=host -v $(PWD):/app -v $(PWD)/sites-enabled:/etc/nginx/sites-enabled dockerfile/nginx
