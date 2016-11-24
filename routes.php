<?php

$route->add('/', 'Home');
$route->add('/login', 'Auth@login');
$route->add('/logout', 'Auth@logout');

$route->add('/test', 'Dbman@test');
$route->add('/dbinfo', 'Dbman@dbInfo');
$route->add('/viewTable', 'Dbman@viewTable');
$route->add('/tableData', 'Dbman@tableData');
$route->add('/crud', 'Dbman@crud');