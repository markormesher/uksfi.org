<?php

require_once '../connections/sql.php';

$insert = update('listings', array(
	'address_2' => 'Strand'
), 8);

if ($insert) {
	echo('Insert okay');
} else {
	echo('Insert failed');
}