.PHONY: all css thumbnails


all: css

css:
	compass compile css/pigen

thumbnails: panels/*.jpg
	$(foreach FILE, $?, $(shell puo_generate_thumbnails.sh $(FILE)))

