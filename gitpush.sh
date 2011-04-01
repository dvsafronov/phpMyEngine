#!/bin/sh
git init
git add -A ./ phpmyengine/ public/
git commit -m "`date`"
git push