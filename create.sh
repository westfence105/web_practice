#!/bin/sh

if [ ! -e "$1" ]; then
	if echo "$1" | grep -sqv "php$"; then
		mkdir "$1"
		fn="/index.php"
	fi
	cp -i index.php "$1"
	fn="$1""$fn"
	echo "$fn"
else
	echo "Directory has been existing."
fi
