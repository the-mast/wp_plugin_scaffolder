test:
	phpunit
	
clean:
	rm -rf output

package: clean test
	mkdir output output/{plugin_name}
	zip -r output/{plugin_name}_tmp.zip languages lib css js partials *.php
	cd output/{plugin_name}; \
		unzip ../{plugin_name}_tmp.zip
	cd output; \
		rm -f {plugin_name}_tmp.zip;\
		zip -r {plugin_name}.zip {plugin_name}
	rm -rf output/{plugin_name}
