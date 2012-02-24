.PHONY: all css clean clean-yaml clean-thumbnails js-timestamp

PANELS = $(wildcard panels/*.jpg)
THUMBNAILS = $(patsubst panels/%,panels/thumbnails/%,$(PANELS))
PANELS_MOBILE = $(patsubst panels/%,panels/m/%,$(PANELS))
YAML = $(wildcard panels/*.yaml)
YAML_TARGETS = $(patsubst panels/%,panels/yaml_lock/%,$(YAML))

all: css thumbnails js yaml m

clean: clean-yaml clean-thumbnails clean-m

thumbnails: $(THUMBNAILS)

m: $(PANELS_MOBILE)

clean-thumbnails:
	rm panels/thumbnails/*

clean-m:
	rm panels/m/*

yaml: $(YAML_TARGETS)

clean-yaml:
	rm panels/yaml_lock/*

css:
	cd css; $(MAKE) $(MFLAGS)

coffee: js/*.js
	
js: coffee

js-timestamp:
	stat --printf="js_timestamp=\"%y\"" js/ > js/js.conf

%.js: %.coffee
	coffee -c $<
	$(MAKE) js-timestamp

panels/thumbnails/%.jpg: panels/%.jpg
	convert $< -resize 118x -gravity Center -crop 118x118+0+0 $(patsubst panels/%,panels/thumbnails/%,$(<))

panels/m/%.jpg: panels/%.jpg
	convert $< -resize 320x -gravity Center $(patsubst panels/%,panels/m/%,$(<))

panels/yaml_lock/%.yaml: panels/%.yaml
	scripts/fb_yaml.php $?

