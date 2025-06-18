<?php

require "CustomerSelecting.php";
require "ListOrders.php";

class CustomerOrders extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\core\SubReport;

    protected function settings()
    {
        return array(
            "subReports"=>array(
                "customerselecting"=>CustomerSelecting::class,
                "listorders"=>ListOrders::class,
            )
        );
    }
}