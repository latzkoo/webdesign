<?php

namespace app;

ob_start();
session_start();
global $data;

require_once("autoload.php");

//$json = new JSON();
//$json->write("users.json", $a);

Router::init();
Router::router();
App::run($data);
