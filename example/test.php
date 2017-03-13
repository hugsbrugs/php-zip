<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hug\Zip\Zip as Zip;


/* ************************************************* */
/* *************** Zip::zip_compress *************** */
/* ************************************************* */

// $source = realpath(__DIR__ . '/../');
// $destination = sys_get_temp_dir() . '/test.zip';
// $test = Zip::zip_compress($source, $destination, true);
// error_log(print_r($test, true));
// unlink($destination);

/* ************************************************* */
/* **************** Zip::zip_extract *************** */
/* ************************************************* */

// $source = sys_get_temp_dir() . '/test.zip';
// $destination = realpath(__DIR__ . '/../data/');
// $test = Zip::zip_extract($source, $destination, true);
// error_log(print_r($test, true));
// unlink($destination.'/*');

