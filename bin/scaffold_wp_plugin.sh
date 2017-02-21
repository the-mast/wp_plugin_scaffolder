#/bin/sh

plugin_name="ari"
packge_name="Ari"
link="www.thoughtworks.com"
plugin_uri="www.thoughtworks.com/abc"
version="1.0.0"
author="Brett"
author_uri="www.thoughtworks.com"
plugin_uri=`echo $plugin_uri | sed s/\//\\\//g`

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

function do_subs() {
    for sub_filename in `find . -name "*.php"`; do

        sed -i ".plugin_name.bkp" s/"{plugin_name}"/"$plugin_name"/g "$sub_filename"
        sed -i ".version.bkp" s/"{version}"/"$version"/g "$sub_filename"
        sed -i ".package_name.bkp" s/"{package_name}"/"$package_name"/g "$sub_filename"
        sed -i ".link.bkp" s/"{link}"/"$link"/g "$sub_filename"
        sed -i ".author.bkp" s/"{author}"/"$author"/g "$sub_filename"
        sed -i ".author_uri.bkp" s/"{author_uri}"/"$author_uri"/g "$sub_filename"
        sed -i ".plugin_uri.bkp" s/"{plugin_uri}"/"$plugin_uri"/g "$sub_filename"
    done
}

function fix_filenames() {
    for plugin_file in `find . -name "*plugin_name*"`; do
        src_filename=`echo $plugin_file | sed s/"\.\/"//g`
        target_filename=`echo $src_filename | sed s/plugin_name/"$plugin_name"/g`

        mv "$src_filename" "$target_filename"
    done
}

function remove_backup_files() {
find . -name "*.bkp" -exec rm -f "{}" ";"
}

fix_filenames
do_subs

remove_backup_files
