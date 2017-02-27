#!/bin/sh

description="some description"
packge_name="Ari"
link="www.thoughtworks.com"
plugin_uri="www.thoughtworks.com/abc"
version="1.0.0"
author="Brett"
author_uri="www.thoughtworks.com"

if [ -L "$0" ]; then
    export scaffold_path="$(dirname $(dirname $(readlink "$0") ) )"
else
    export scaffold_path="$(dirname $(dirname "$0" ) )"
fi


export args="$@"
export template_dir="$scaffold_path/template_files"
export bin_dir="$scaffold_path/bin"
export includes_dir="$scaffold_path/includes"
export current_dir="$(pwd)"

source "$includes_dir/startup_args"
source "$includes_dir/functions"

case "$1" in
    "-h" | "--help")
        cat "$includes_dir/usage.txt"
        exit 0
        ;;
    "-i")
        process_interactive_args
        ;;
    *)
        process_noninteractive_args "$args"
        ;;
esac
plugin_name=`sed_esc $plugin_name`
packge_name=`sed_esc $package_name`
link=`sed_esc $link`
plugin_uri=`sed_esc $plugin_uri`
version=`sed_esc $version`
author=`sed_esc $author`
author_uri=`sed_esc $author_uri`

validate_input
export plugin_dir="$(pwd)/$plugin_name"
copy_template_files_to_plugin_dir
fix_filenames
do_subs

remove_backup_files
