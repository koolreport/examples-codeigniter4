<?php



use \koolreport\processes\ColumnMeta;
use \koolreport\processes\Sort;

//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                "data"=>array(
                    "class"=>'\koolreport\datasources\ArrayDataSource',
                    "dataFormat"=>"table",
                    "data"=>array(
                        array("name","income"),
                        array("John",50000),
                        array("Marry",60000),
                        array("Peter",100000),
                        array("Donald",80000),
                    )
                )
            )
        );
    }
    protected function setup()
    {
        //Prepare data
        $this->src("data")
        ->pipe(new ColumnMeta(array(
            "income"=>array(
                "type"=>"number",
                "prefix"=>"$"
            )
        )))
        ->saveTo($source);

        //Save orginal data
        $source->pipe($this->dataStore("origin"));
        
        //Pipe through process to get result
        $source->pipe(new Sort(array(
            "income"=>"asc"
        )))
        ->pipe($this->dataStore("result"));
    }
}