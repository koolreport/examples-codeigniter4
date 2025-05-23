<?php

use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\amazing\Theme;
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
    function setup()
    {
        $this->src("automaker")->query("
            select paymentDate, amount from payments
        ")
        ->pipe(new TimeBucket(array(
            "paymentDate"=>"month",
        )))
        ->pipe(new Group(array(
            "by"=>"paymentDate",
            "sum"=>"amount",
        )))
        ->pipe($this->dataStore("sale"));

    }
}