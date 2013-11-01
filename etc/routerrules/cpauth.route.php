<?php return [
   "cprule0"=> [
        "pcre"=> "/^auth/",
        "result"=> "action=auth"
    ],
   "cprule1"=> [
        "pcre"=> "/^quit/",
        "result"=> "action=quit"
    ],
   "cprule2"=> [
        "pcre"=> "/^([0-9]+)\\/edit/",
        "result"=> "action=edit;id=$1"
    ]
];