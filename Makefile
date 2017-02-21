clean:
	rm -rf output
	rm -rf template_files/lib/*
	rm -rf tmp

wp_mocker:
	mkdir tmp
	cd tmp;\
		git clone https://github.com/the-mast/wp_mocker.git;
	cd tmp/wp_mocker;\
		make package
	cd template_files/lib;\
		unzip ../../tmp/wp_mocker/output/wp_mocker.zip
	rm -rf tmp

libs: wp_mocker
