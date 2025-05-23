<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                
            )
        );
    }
    protected function setup()
    {

    }
}