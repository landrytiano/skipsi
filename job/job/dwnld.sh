#! /bin/bash

RUNAT="08:01"
while [ 1 ]
do
    DATE=`/bin/date +%H:%M`
    if [ $DATE. = $RUNAT. ]
    then
	curl localhost/php-fann/examples/logic_gates/simple_train.php
    fi
    sleep 60
done

