<?php

//require config file
require('toxuser.php');

$domain = $_SERVER['SERVER_NAME'];

$json = file_get_contents('php://input');
$obj = json_decode($json, true);
if($obj) {
	if(isset($obj['action']) && $obj['action']=='3' && !empty($obj['name'])) {
		$name=$obj['name'];
		$at = strpos($name, '@');
		if($at!==false) {
			$name = substr($name, 0, $at);
	 	}
	 	if(isset($users[$name])) {
			$ret = <<<EOD
{
	"version": "Tox V3 (local)",
	"source": 1,
	"tox_id": "$users[$name]",
	"c": 0,
	"url": "tox:$name@$domain",
	"name": "$name",
	"regdomain": "$domain",
	"verify": {
		"status": 1,
		"detail": "Good (signed by local authority)"
	}
}
EOD;
			echo $ret;
	 	} else {
	 		echo '{"c": -42}'; //name not found
	 	}
	} else {
		echo '{"c": -1}'; //we support only lookup(3)
	}
} else {
	echo '{"c": -1}';
}
