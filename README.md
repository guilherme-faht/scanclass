# ScanClass

Search all classes in a directory.

> Status

![Build Status](https://travis-ci.org/guilherme-faht/scanclass.svg?branch=master)


> Example

```php
<?php
require __DIR__ . "/vendor/autoload.php";

$scan = new ReactBoot\ScanClass;
$classes = $scan->scan(__DIR__ . '/dir');
```
