<?php

namespace app;

ob_start();
session_start();
global $data;

require_once("autoload.php");

Router::init();
Router::router();
App::run($data);
