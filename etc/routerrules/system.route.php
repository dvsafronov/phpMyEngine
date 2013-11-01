<?php return [
    "systemChangeCity"=> [
        "pcre"=> "/^changecity\\/([0-9]+)/",
        "result"=> "action=changecity;newCityID=$1"
    ]
]
;