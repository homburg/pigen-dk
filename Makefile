.PHONY: all css thumbnails js

PANELS = $(wildcard panels/*.jpg)
THUMBNAILS = $(patsubst panels/%,panels/thumbnails/%,$(PANELS))

all: css thumbnails js

thumbnails: $(THUMBNAILS)

css:
	cd css; $(MAKE) $(MFLAGS)

coffee: js/*.js
	
js: coffee

%.js: %.coffee
	coffee -c $<

panels/thumbnails/%.jpg: panels/%.jpg
	convert $< -resize 118x -gravity Center -crop 118x118+0+0 $(patsubst panels/%,panels/thumbnails/%,$(<))
