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
        Line Styles 
    </title>
</head>

<body>
</body>

</html>