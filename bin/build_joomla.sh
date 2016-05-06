#!/usr/bin/env sh

echo ">>> >>> Start build extention arch for Joomla!CMS"

echo "Prepare FS"
mkdir -p build/packages

echo "Create symlinks"
ln -s `pwd`/vendor/                                 src/jbzoo/vendor
ln -s `pwd`/src/jbzoo/                              src/joomla-plugins/com_jbzoo/admin/cck
ln -s `pwd`/src/joomla-plugins/com_jbzoo/           src/joomla-plugins/pkg_jbzoocck/packages/com_jbzoo
ln -s `pwd`/src/joomla-plugins/plg_sys_jbzoocck/    src/joomla-plugins/pkg_jbzoocck/packages/plg_sys_jbzoocck


echo "Comporess Joomla Pkg"
SRC_DIR="`pwd`"
cd src/joomla-plugins/pkg_jbzoocck
zip -r ../../../build/packages/pkg_jbzoocck.zip *
cd "$SRC_DIR"


echo "OK"
