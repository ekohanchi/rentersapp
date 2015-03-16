#! /bin/bash

function parseValues {
	dir=$1;
	for file in $dir/*.txt; do {
		firstrec=`cat $file | head -1 | awk -F ':' '{print $1}'`
		#echo $firstrec
		if [ $firstrec != "referral_id" ]; then
			#echo "first rec val: $firstrec"
			#echo "file val: $file"
			rec1=`echo $file | awk -F '.' '{print "\"" $1 "\"" ","}'`
			echo -n "$rec1";
			#record=`cat $file | sed '/^$/d' | awk -F ': ' '{printf "\x27" $2 "\x27" ","}'`
		fi
		if [ $firstrec == "aciflname" ]; then
			rec1="0,"
			echo -n "\"$rec1\",";
		fi
		field=`cat $file | sed '/^$/d' | awk -F ': ' '{print  $1}'`

		#record=`cat $file | sed '/^$/d' | awk -F ': ' '{printf "|" $2 "|"}'`
		record=`cat $file | sed '/^$/d' | sed '/^__/d' | awk -F ': ' '{printf $2 "|" }'`
		echo -n "$record"
		echo ""
	} done > a
}

function parseRefid {
	line=$1;
#	while read line; do {
		e=$(echo $line | sed 's/\(.\)/\1 /g')
		a=($e)
		y1=${a[4]}
		y2=${a[5]}
		y3=${a[6]}
		y4=${a[7]}
		m1=${a[0]}
		m2=${a[1]}
		d1=${a[2]}
		d2=${a[3]}
		h1=${a[8]}
		h2=${a[9]}
		mi1=${a[10]}
		mi2=${a[11]}
		s1=${a[12]}
		s2=${a[13]}
		#echo "$y1$y2$y3$y4-$m1$m2-$d1$d2 $h1$h2:$mi1$mi2:$s1$s2" 
		echo "$m1$m2$d1$d2-$y1$y2-$y3$y4 $h1$h2:$mi1$mi2:$s1$s2" 
#	} done
}

function fillinFields {
	count=1;
	cat a | while read line; do {
		refid=`echo "$line" | awk -F '|' '{print $1}'`
		dttime=`parseRefid $refid`
		piperemoved=`echo "$line" | sed 's/|$//g'`
		linecleaned=`echo "$piperemoved" | awk -F '|' '{OFS = "|"; $23=$23"|"; print $0}'`
		echo "$count|$dttime|100|$linecleaned";
		count=$[$count+1];
	} done
}


dirpath=$1;
parseValues $dirpath
fillinFields
#parseRefid
