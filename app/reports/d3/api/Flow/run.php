<?php
\Config\Services::session();


require_once "MyReport.php";
$report = new MyReport;
$report->run();
$report->render();
