<?php

function get_rate($currency) {
	$memcache = new Memcache;
	$memcache->connect("127.0.0.1",11211);
	$key = "rate_key_".$currency;
	while (true) {
		$rate = $memcache->get($key);
		
		if (!$rate) {
			$rate = select_from_base($mysqli, $currency);
		} else {
			return $rate;
		}
		
		if (!$rate) {
			$host = "http://external.source/";
			$args = http_build_query(array("currency"=>$currency));
			$rate = file_get_contents($host."?".$args);
			if ($rate !== FALSE) {
				$memcache->set($key, $rate);
				insert_to_base($mysqli, $currency, $rate);
				return $rate;
			}
		} else {
			$memcache->set($key, $rate);
			return $rate;
		}
	}
}

$current_rate = get_rate("USD");
