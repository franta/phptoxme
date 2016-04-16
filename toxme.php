<?php

//edit this to paste your id's
$users = array(
	"echobot" => "76518406F6A9F2217E8DC487CC783C25CC16A15EB36FF32E335A235342C48A39",
	"yournick"=> "place tox id here",
	"anothernick"=> "another tox id",
);

$domain = $_SERVER['SERVER_NAME'];

$json = file_get_contents('php://input');
$obj = json_decode($json, true);
if($obj) {
	if($obj['action']=='3' && $obj['name']) {
		$name=$obj['name'];
		$at = strpos($name, '@');
		if($at) {
			$name = substr($name, 0, $at);
	 	}
	 	if($users[$name]) {
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
