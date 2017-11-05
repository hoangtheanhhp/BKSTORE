<?php 
	return [
			'client_id' => 'AeKVa80dYJFLKTm4HZVvToNAkOVMbL6U5ZaJp92ND1bQQ2Fq81QhSN8Y4Lg4omQq0R4JB3zyBpYxvWwJ',
			'secret' => 'EC_o4pjnMrd8gKXVVZfoucBwCyE_ZE6uoHdilBDiYQ8dM6iQHThwg7k6_zQV371pkq33Nleosjoy0eC2',
			'settings' => [
				'http.CURLOPT_CONNECTTIMEOUT'=> 30,
				'mode'=> 'sandbox',
				'log.LogEnabled'=>true,
				'log.FileName'=> storage_path().'/logs/PayPal.php',
				'log.LogLevel'=>'INFO',	
			]  
	];
 ?>