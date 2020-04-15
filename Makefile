default:
	echo "Hello World!"

clear:
	rm -rf build

convert_html:
	mkdir build
	for fileName in $(shell cd public && ls *.php | cut  -d "." -f 1); do \
		php public/$$fileName.php > ./build/$$fileName.html; \
	done

build: clear convert_html build_sass
	cp -r public/css build/
	cp -r public/js build/
	cp -r public/fonts build/
	cp -r public/img build/
	cp -r public/additional build/

watch_sass:
	sass --watch --no-cache ./scss/styles.scss:./public/css/styles.css

build_sass:
	rm -rf public/css
	sass --update ./scss/styles.scss:./public/css/styles.css
