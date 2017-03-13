## php-zip

Wrapper around PHP [Zippy](https://github.com/alchemy-fr/Zippy) library to zip/unzip archives files

[![Build Status](https://travis-ci.org/hugsbrugs/php-zip.svg?branch=master)](https://travis-ci.org/hugsbrugs/php-zip)
[![Coverage Status](https://coveralls.io/repos/github/hugsbrugs/php-zip/badge.svg?branch=master)](https://coveralls.io/github/hugsbrugs/php-zip?branch=master)

## Install

Install package with composer
```
composer require hugsbrugs/php-zip
```

In your PHP code, load librairy
```php
require_once __DIR__ . '/../vendor/autoload.php';
use Hug\Zip\Zip as Zip;
```

## Usage

### Compress File or Folder
```php
$result = Zip::zip_compress($source, $destination);
```
Outputs
```
[status] => success
[message] => 
[exception] => 
[source] => /var/www/php-utils/php-zip
[destination] => /tmp/test.zip
[source_size] => 16723777
[source_size_hr] => 15.95 MB
[destination_size] => 7827516
[destination_size_hr] => 7.46 MB
[compression] => 53.195285969192
```

### Uncompress File or Folder
```php
$result = Zip::zip_extract($source, $destination);
```
Outputs
```
[status] => success
[message] => 
[exception] => 
[source] => /tmp/test.zip
[destination] => /var/www/php-utils/php-zip/data
[source_size] => 7827516
[source_size_hr] => 7.46 MB
[destination_size] => 16731969
[destination_size_hr] => 15.96 MB
[decompression] => 113.76
```

Possible errors :
SOURCE_NOT_READABLE
INVALID_FILE_TYPE
UNKNOWN_ERROR


## Unit Tests

```
composer exec phpunit
```