<?php

use Core\TwitterApi;

include realpath(__DIR__) . '/settings/settings.php';
include realpath(__DIR__) . '/settings/settings.default.php';
include realpath(__DIR__) . '/vendor/autoload.php';

TwitterApi::$searches = include realpath(__DIR__) . '/settings/searches.php';
