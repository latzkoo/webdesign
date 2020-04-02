<?php
$classes = scandir(__DIR__."/app");

foreach ($classes as $file) {
    if (is_file(__DIR__ . "/app/" . $file))
        require_once(__DIR__ . "/app/" . $file);
}
