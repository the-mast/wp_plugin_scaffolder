#/bin/sh

plugin_name="ari"
packge_name="Ari"
link="www.thoughtworks.com"
plugin_uri="www.thoughtworks.com/abc"
version="1.0.0"
author="Brett"
author_uri="www.thoughtworks.com"

if [ -d "$plugin_name" ]; then
    echo "directory $plugin_name already exists";
    exit 1
fi
