<?php

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                "data"=>array(
                    "class"=>'\koolreport\datasources\CSVDataSource',
                    "filePath"=>dirname(__FILE__)."/data.csv",
                )
            )
        );
    }   
}