<?php
/**
 * Created by IntelliJ IDEA.
 * User: azam
 * Date: 09/04/2018
 * Time: 15:16
 */

require __DIR__ . '/vendor/autoload.php';

use DataViewer\DataViewer as DataViewer;

$dataObj = new DataViewer('data/sample.json');
$dataObj->setParam('dateFormat', "Y-m-d")
        ->setParam('dateField', 'ReleaseDate')
        ->setParam('currencyField', 'Price')
        ->setOrder('ID', 'ASC')
        ->render('table');
