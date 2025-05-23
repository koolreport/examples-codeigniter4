<?php

require_once "CountrySale.php";
require_once "CitySale.php";

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\core\SubReport;
    protected function settings()
    {
        return array(
            "subReports"=>array(
                "countrySale"=>CountrySale::class,
                "citySale"=>CitySale::class,
            )
        );
    }
}