<?php
/**
 * Created by IntelliJ IDEA.
 * User: azam
 * Date: 09/04/2018
 * Time: 15:21
 */

namespace DataViewer;

/**
 * Class DataLoader
 *
 * @package DataViewer
 */
class DataViewer
{
    public $dateFormat =  "Y-m-d";
    public $dateField = [];
    public $currencyField = [];
    public $data = [];
    /**
     * DataLoader constructor.
     * @param $data_file
     * @param string $loadFormat
     * @param string $outputFormat
     */
    public function __construct($data_file, $loadFormat = "auto")
    {
        if (!file_exists($data_file)) {
            die("file not found");
        }

        if ($loadFormat == "auto") {
            $path_parts = pathinfo($data_file, PATHINFO_EXTENSION);
            $loadFormat = strtoupper($path_parts);
        }
        $className = __NAMESPACE__."\\".$loadFormat ."DataLoader";
        if (!class_exists($className)) {
            die('Data Loader Not Found!');
        }
        $loaderObject = new $className($data_file);
        $this->data = $loaderObject->getDataInArray();
    }

    /**
     * @param $key
     * @param $value
     * @return DataViewer
     */
    public function setParam($key, $value)
    {
        if (property_exists($this, $key)) {
            if (is_array($this->{$key})) {
                $this->{$key}[] = $value;
            } else {
                $this->{$key} = $value;
            }
        }
        return $this;
    }

    /**
     * @param $field
     * @param $ascDesc
     * @return DataViewer
     */
    public function setOrder($field, $ascDesc = 'ASC')
    {
        $className = __NAMESPACE__."\\"."DataSorter";
        $orderObj = new $className($this->data, $field, $this->currencyField, $ascDesc);
        $this->data = $orderObj->sort();
        return $this;
    }

    /**
     * @render result
     * @param string $outputFormat
     */
    public function render($outputFormat = "table")
    {
        $className = __NAMESPACE__."\\".ucfirst($outputFormat)."View";
        if (!class_exists($className)) {
            die('Output Format Not Found!');
        }
        $loaderObject = new $className($this->data, $this->dateFormat, $this->dateField);
        echo $loaderObject->render();
    }
}
