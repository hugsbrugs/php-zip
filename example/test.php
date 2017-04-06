<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hug\Zip\Zip as Zip;


/* ************************************************* */
/* ***************** Zip::compress ***************** */
/* ************************************************* */

// $source = realpath(__DIR__ . '/../');
// $destination = sys_get_temp_dir() . '/test.zip';
// $test = Zip::compress($source, $destination, true);
// error_log(print_r($test, true));
// unlink($destination);

/* ************************************************* */
/* ****************** Zip::extract ***************** */
/* ************************************************* */

// $source = sys_get_temp_dir() . '/test.zip';
// $destination = realpath(__DIR__ . '/../data/');
// $test = Zip::extract($source, $destination, true);
// error_log(print_r($test, true));
// unlink($destination.'/*');

