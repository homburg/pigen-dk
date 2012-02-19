.PHONY: all css thumbnails js

all: css thumbnails js

thumbnails:
	cd panels; $(MAKE) $(MFLAGS)

css:
	cd css; $(MAKE) $(MFLAGS)

coffee: js/*.js
	
js: coffee

%.js: %.coffee
	coffee -c $<
