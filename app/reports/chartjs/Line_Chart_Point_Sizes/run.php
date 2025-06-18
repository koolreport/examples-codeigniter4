<?php
\Config\Services::session();


require_once "MyReport.php";
$report = new MyReport;
$report->run();
$report->render();
?>

<html>

<head>
    <title>
        Different Point Sizes 
    </title>
</head>

<body>
</body>

</html>