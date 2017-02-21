#/bin/sh

plugin_name="ari"
packge_name="Ari"
link="www.thoughtworks.com"
plugin_uri="www.thoughtworks.com/abc"
version="1.0.0"
author="Brett"
author_uri="www.thoughtworks.com"

template_dir=` dirname \`dirname $0\` `"/template_files"
plugin_dir="`pwd`/$plugin_name"
if [ -d "$plugin_dir" ]; then
    echo "directory $plugin_name already exists";
    exit 1
fi

mkdir "$plugin_dir"

current_dir=`pwd`
cd "$template_dir"
tar -vcf "$plugin_dir/template_files.tar" *
cd "$plugin_dir"
tar -xvf template_files.tar
rm -f template_files.tar

function fix_filenames() {
    for plugin_file in `find . -name "*plugin_name*php"`; do
        src_filename=`echo $plugin_file | sed s/"\.\/"//g`
        target_filename=`echo $src_filename | sed s/plugin_name/"$plugin_name"/g`

        mv "$src_filename" "$target_filename"
    done
}

fix_filenames
