#!/usr/bin/env php
<?php

error_reporting(E_ALL);

class FbCurler {
	public static function main (array $argv) {

		$callStr = "call: \"".implode($argv, ' ')."\"\n";
		shell_exec('logger '.$callStr);
		echo $callStr;

		if (!isset($argv[1]))
			return;

		$outDir = 'panels/yaml_lock';
		if (is_file($outDir)) {
			echo "Illegal file: ".$outDir;
			exit(1);
		}

		if (!is_dir($outDir)) {
			mkdir($outDir);
		}

		$file = basename($argv[1]);
		$count = 0;
		$id = preg_replace('/\.yaml$/', '', $file, 1, $count);

		if (1 != $count)
		{
			echo "Invalid input file: \"".$argv[1]."\"\n";
			exit(1);
		}

		if (getenv("PIGEN_ENV") === "prod") {
			$domains = array('pigen.dk', 'www.pigen.dk');
		} else {
			$domains = array('test.pigen.dk');
		}

		$out = "";
		foreach ($domains as $domain) {
			$url  = "http://${domain}/${id}";
			$fbUrl = 'http://developers.facebook.com/tools/debug/og/object?format=json&q='.rawurlencode($url);
			shell_exec("logger Getting: ${fbUrl}\n");
			$out = file_get_contents($fbUrl);
		}

		file_put_contents($outDir.'/'.$file, $out);
	}
}

FbCurler::main($argv);

