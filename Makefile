INSTALL_DIR="/usr/local/wp_plugin_scaffolder"
BIN_DIR="/usr/local/bin"
clean:
	rm -rf output
	rm -rf template_files/lib
	rm -rf tmp

prep:
	mkdir "template_files/lib"
wp_mocker: prep
	mkdir tmp
	cd tmp;\
		git clone https://github.com/the-mast/wp_mocker.git;
	cd tmp/wp_mocker;\
		make package
	cd template_files/lib;\
		unzip ../../tmp/wp_mocker/output/wp_mocker.zip
	rm -rf tmp

libs: wp_mocker

package: clean libs
	mkdir output output/wp_plugin_scaffolder
	tar -vcf output/wp_plugin_scaffolder/wp_plugin_scaffolder.tar bin template_files
	cd output/wp_plugin_scaffolder;\
		tar -xvf wp_plugin_scaffolder.tar
	rm -f output/wp_plugin_scaffolder/wp_plugin_scaffolder.tar
	chmod 755 output/wp_plugin_scaffolder/bin/scaffold_wp_plugin.sh
	cd output;\
		zip -r wp_plugin_scaffolder.zip wp_plugin_scaffolder
	rm -rf output/wp_plugin_scaffolder

install: package
	mkdir $(INSTALL_DIR)
	cd output; unzip wp_plugin_scaffolder.zip
	mv output/wp_plugin_scaffolder/* $(INSTALL_DIR)
	ln -s $(INSTALL_DIR)/bin/scaffold_wp_plugin.sh $(BIN_DIR)

uninstall:
	rm -rf $(INSTALL_DIR)
	rm -f $(BIN_DIR)/scaffold_wp_plugin.sh
