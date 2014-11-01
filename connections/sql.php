<?php

// connect

require_once 'sql-connect.php';

// search

function search($table, $filter, $limit = 0) {
	$filterString = buildFilterString($filter);
	$queryString = 'SELECT * FROM `' . $table . '` WHERE ' . $filterString . ($limit > 0 ? ' LIMIT ' . $limit : '');
	$query = @mysql_query($queryString);
	if ($query) {
		$output = array();
		while ($r = mysql_fetch_array($query, MYSQL_ASSOC)) $output[] = $r;
		if (empty($output)) {
			return false;
		} else {
			return $output;
		}
	} else {
		return false;
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