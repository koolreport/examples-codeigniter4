<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                "stock"=>array(
                    "class"=>'\koolreport\datasources\CSVDataSource',
                    'filePath'=>dirname(__FILE__)."/stock.csv",
                )
            )
        );
    }
    protected function setup()
    {
        $this->src("stock")
        ->pipe($this->dataStore("stock"));
    }
}