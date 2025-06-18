<?php
\Config\Services::session();

require_once "CustomersYears.php";
$CustomersYears = new CustomersYears;
$CustomersYears->run()->render();
?>    
