<?php

require_once '../connections/sql.php';
require_once '../db/master-list.php';

print_r(db_getUserPref(1, 'r_get_alerts'));