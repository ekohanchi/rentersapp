#! /bin/bash

 | awk -F ' ' '{print $1}' > fields

i=0; cat fields | while read line; do echo "'$i' => \"$line\","; i=$[$i+1]; done > fields.array
