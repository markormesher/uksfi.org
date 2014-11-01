<?php

// connect

require_once 'sql-connect.php';

// search

function search($table, $filter, $limit = 0) {
	$filterString = buildFilterString($filter);
	$query = @mysql_query('SELECT * FROM `' . $table . '` WHERE ' . $filterString . ($limit > 0 ? ' LIMIT ' . $limit : ''));
	if ($query) {
		$output = array();
		while ($r = mysql_fetch_array($query, MYSQL_ASSOC)) $output[] = $r;
		return $output;
	} else {
		return null;
	}
}

// build a query string

function buildFilterString($filter) {
	if ($filter[0] == 1 || $filter[0] == -1) {
		$join = array_shift($filter);
		$terms = array();
		foreach ($filter as $f) {
			$terms[] = buildFilterString($f);
		}
		return '(' . implode($join == 1 ? ' AND ' : ' OR ', $terms) . ')';
	} else {
		return $filter;
	}
}