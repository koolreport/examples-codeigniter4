<?php



class Report extends \koolreport\KoolReport
{
    use \koolreport\codeigniter4\Friendship;
    use \koolreport\inputs\Bindable;
    use \koolreport\inputs\POSTBinding;

    protected function defaultParamValues()
    {
        return array(
            "dateRange"=>array(date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59")),
            "textBox"=>"KoolReport is great",
            "select"=>"",
            "multiSelect"=>array(),
            "radioList"=>"",
            "checkBoxList"=>array(),
            "startDatePicker"=>date("Y-m-d 00:00:00"),
            "endDatePicker"=>date("Y-m-d 23:59:59"),
            "rangeSliderOne"=>array(50),
            "rangeSliderTwo"=>array(20,80),
        );
    }

    protected function bindParamsToInputs()
    {
        return array(
            "dateRange",
            "select",
            "multiSelect",
            "textBox",
            "radioList",
            "checkBoxList",
            "startDatePicker",
            "endDatePicker",
            "singleSelect2",
            "multipleSelect2",
            "singleBSelect",
            "multipleBSelect",
            "rangeSliderOne",
            "rangeSliderTwo",
        );
    }

    protected function settings()
    {
        $config = include __DIR__ . "/../../../config.php";
        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }   
    protected function setup()
    {
        $this->src("automaker")->query("
            SELECT
                customerNumber,
                customerName
            FROM
                customers
            ORDER BY customerName
            LIMIT 40,5
        ")
        ->pipe($this->dataStore("customers"));
    } 
}
