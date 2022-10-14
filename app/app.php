<?php

define('APP_PATH', dirname(__FILE__) . "/../");

require_once("functions.php");
require_once("config.php");
require('data/data.class.php');
require('data/mysqldataprovider.class.php');

Data::initialize(new MySqlDataProvider(CONFIG['db']));

?>