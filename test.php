<?php

$data = yaml_parse_file("panels/PIGEN263.yaml");

print_r($data);
var_dump($data);

$keys = array_keys($data);

$key = $keys[0];

print_r(unpack("C*", $key));
