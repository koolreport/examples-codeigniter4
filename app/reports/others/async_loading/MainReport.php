<?php

require "SaleByCountriesReport.php";
require "TopCustomersReport.php";

class MainReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\clients \jQuery;
    use \koolreport\core\SubReport;
    
    protected function settings()
    {
        return array(
            "subReports"=>array(
                "SaleByCountriesReport"=>SaleByCountriesReport::class,
                "TopCustomersReport"=>TopCustomersReport::class,
            )
        );
    }
}