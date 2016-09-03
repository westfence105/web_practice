#!/bin/sh

if [ ! -e "$1" ]; then
	mkdir "$1"
	cp index.php "$1"
	echo "${1}/index.php"
else
	echo "Directory has been existing."
fi
