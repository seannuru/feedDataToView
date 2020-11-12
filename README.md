# dataviewer
<h3>Usage</h3>

You can see sample in index.php

Download source files<br>
Don't forget to add require autoloader

then run <i>composer update</i> commmand line

Example code:
``` php
require __DIR__ . '/vendor/autoload.php';

use DataViewer\DataViewer as DataViewer;

$dataObj = new DataViewer('data/sample.json');
$dataObj->setParam('dateFormat', "Y-m-d")
        ->setParam('dateField', 'ReleaseDate')
        ->setParam('currencyField', 'Price')
        ->setOrder('ID', 'ASC')
        ->render(); // table as default, or render('list') 
```

``` php
$dataObj = new DataViewer('data/sample.xml', 'XML'); // you can specify loader format
$dataObj = new DataViewer('data/sample.json', 'JSON'); // you can specify loader format
$dataObj = new DataViewer('data/sample.json'); // or can go automatically based on file extension
```
