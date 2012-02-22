.PHONY: all css clean clean-yaml clean-thumbnails

PANELS = $(wildcard panels/*.jpg)
THUMBNAILS = $(patsubst panels/%,panels/thumbnails/%,$(PANELS))
YAML = $(wildcard panels/*.yaml)
YAML_TARGETS = $(patsubst panels/%,panels/yaml_lock/%,$(YAML))

all: css thumbnails js yaml

clean: clean-yaml clean-thumbnails

thumbnails: $(THUMBNAILS)

clean-thumbnails:
	rm panels/thumbnails/*

yaml: $(YAML_TARGETS)

clean-yaml:
	rm panels/yaml_lock/*

css:
	cd css; $(MAKE) $(MFLAGS)

coffee: js/*.js
	
js: coffee

%.js: %.coffee
	coffee -c $<

panels/thumbnails/%.jpg: panels/%.jpg
	convert $< -resize 118x -gravity Center -crop 118x118+0+0 $(patsubst panels/%,panels/thumbnails/%,$(<))

panels/yaml_lock/%.yaml: panels/%.yaml
	scripts/fb_yaml.php $?

