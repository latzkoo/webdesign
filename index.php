<?php

require_once("autoload.php");

App::boot();

ob_start();
session_start();
global $data;

Router::init();
Router::route();
App::run($data);
