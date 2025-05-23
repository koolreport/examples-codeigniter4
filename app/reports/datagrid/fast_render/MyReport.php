<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        //Get default connection from config.php
        $config = include __DIR__ . "/../../../config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }   
    protected function setup()
    {
        for ($i=0; $i<5; $i++) {
            $this->src('automaker')
            ->query('select * from customer_product_dollarsales2 ORDER BY RAND()')
            ->pipe($this->dataStore("sales"));
        }
        
    } 

}