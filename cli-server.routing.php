<?php

require_once("_prepend.php");

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false; // serve the requested resource as-is.
} else {
	header("content-type: text-plain");
	header("x-uri: " . $_SERVER["REQUEST_URI"]);
	$page = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["REQUEST_URI"];
	if (file_exists($page) && is_file($page)) {
		require_once($page);
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"] . "/index.php");
	}
}
