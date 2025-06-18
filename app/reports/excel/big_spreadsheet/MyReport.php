<?php


class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\excel\BigSpreadsheetExportable;

    protected function settings()
    {
        return array(
            "dataSources" => array(
                "dollarsales"=>array(
                    'filePath' => __DIR__ . '/../../../databases/customer_product_dollarsales2.xlsx',
                    'class' => '\koolreport\excel\BigSpreadsheetDataSource'      
                ), 
            )
        );
    }    function setup()
    {
        $node = $this->src('dollarsales')
        ->pipe($this->dataStore('sales'));
    }
}
