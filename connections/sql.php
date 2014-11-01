<?php

require_once 'sql-connect.php';

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

function insert($table, $input) {
	$fields = array();
	$values = array();
	foreach ($input as $k => $v) {
		$fields[] = '`' . $k . '`';
		if (is_string($v)) {
			$values[] = '\'' . addslashes($v) . '\'';
		} elseif (is_numeric($v)) {
			$values[] = $v;
		} elseif (is_array($v)) {
			$values[] = $v[0];
		}
	}

	$queryString = 'INSERT INTO `' . $table . '` (' . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ')';
	$query = @mysql_query($queryString);
	if ($query) {
		return @mysql_insert_id();
	} else {
		return false;
	}
}

function update($table, $input, $id) {
	$fields = array();
	foreach ($input as $k => $v) {
		$temp = '`' . $k . '` = ';
		if (is_string($v)) {
			$temp .= '\'' . addslashes($v) . '\'';
		} elseif (is_numeric($v)) {
			$temp .= $v;
		} elseif (is_array($v)) {
			$temp .= $v[0];
		}
		$fields[] = $temp;
	}
	$queryString = 'UPDATE `' . $table . '` SET ' . implode(',', $fields) . ' WHERE `id` = \'' . $id . '\'';
	$query = @mysql_query($queryString);
	if ($query) {
		return true;
	} else {
		return false;
	}
}

function delete($table, $id) {
	$queryString = 'DELETE FROM `' . $table . '` WHERE `id` = ' . $id . ' LIMIT 1';
	@mysql_query($queryString);
}

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