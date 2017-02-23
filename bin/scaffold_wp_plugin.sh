#/bin/sh

plugin_name="ari"
packge_name="Ari"
link="www.thoughtworks.com"
plugin_uri="www.thoughtworks.com/abc"
version="1.0.0"
author="Brett"
author_uri="www.thoughtworks.com"

function get_template_dir() {
    if [ -s "$1" ]; then
        echo "$(dirname $(dirname $(readlink "$1") ) )/template_files"
    else
        echo "$(dirname $(dirname "$1" ) )/template_files"
    fi
}

function get_plugin_dir() {
    echo "$(pwd)/$plugin_name"
}

function make_plugin_dir() {
    if [ -d $plugin_dir ]; then
        echo "directory $plugin_name already exists";
        exit 1
    fi

    mkdir "$plugin_dir"
}

function do_subs() {
    if [ ! -d "$plugin_dir" ]; then
        echo "$plugin_dir doesn't exist can't rename files"
        return 1
    fi

    cd "$plugin_dir"
    for sub_filename in `find . -name "*.php"`; do

        sed -i ".plugin_name.bkp" s/"{plugin_name}"/"$plugin_name"/g "$sub_filename"
        sed -i ".version.bkp" s/"{version}"/"$version"/g "$sub_filename"
        sed -i ".package_name.bkp" s/"{package_name}"/"$package_name"/g "$sub_filename"
        sed -i ".link.bkp" s/"{link}"/"$link"/g "$sub_filename"
        sed -i ".author.bkp" s/"{author}"/"$author"/g "$sub_filename"
        sed -i ".author_uri.bkp" s/"{author_uri}"/"$author_uri"/g "$sub_filename"
        sed -i ".plugin_uri.bkp" s/"{plugin_uri}"/"$plugin_uri"/g "$sub_filename"
    done

    return 0
}

function fix_filenames() {
    if [ ! -d "$plugin_dir" ]; then
        echo "$plugin_dir doesn't exist can't rename files"
        return 1
    fi

    cd "$plugin_dir"
    for plugin_file in `find . -name "*plugin_name*"`; do
        src_filename="$(echo $plugin_file | sed s/"\.\/"//g)"
        target_filename="$(echo $src_filename | sed s/plugin_name/"$plugin_name"/g)"

        mv "$src_filename" "$target_filename"
    done

    cd "$current_dir"
    return 0
}

function remove_backup_files() {
    if [ ! -d "$plugin_dir" ]; then
        echo "$plugin_dir doesn't exist can't rename files"
        return 1
    fi

    cd "$plugin_dir"
    find . -name "*.bkp" -exec rm -f "{}" ";"

    return 0
}

function sed_esc() {
    echo "$1" | sed s/"\/"/"\\\\\/"/g | sed s/"&"/"\\\&"/g
}

function copy_template_files_to_plugin_dir() {
    make_plugin_dir
    cd "$template_dir"
    tar -vcf "$plugin_dir/template_files.tar" *
    cd "$plugin_dir"
    tar -xvf template_files.tar
    rm -f template_files.tar
    cd "$current_dir"
}

export plugin_dir="$(get_plugin_dir)"
export template_dir="$(get_template_dir "$0" )"
export current_dir="$(pwd)"

echo "plugin_dir = $plugin_dir"
echo "template_dir = $template_dir"
echo "current_dir = $current_dir"

plugin_name=`sed_esc $plugin_name`
packge_name=`sed_esc $package_name`
link=`sed_esc $link`
plugin_uri=`sed_esc $plugin_uri`
version=`sed_esc $version`
author=`sed_esc $author`
author_uri=`sed_esc $author_uri`

copy_template_files_to_plugin_dir
fix_filenames
do_subs

remove_backup_files
