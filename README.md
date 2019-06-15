# ScanClass

Search all classes in a directory.

> Example

```php
<?php
require __DIR__ . "/vendor/autoload.php";

$scan = new ReactBoot\ScanClass;
$classes = $scan->scan(__DIR__ . '/dir');
```
