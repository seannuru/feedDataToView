<?php
namespace DataViewer;

/**
 * Class DataLoader
 *
 * @package DataViewer
 */
class JSONDataLoader implements DataLoaderInterface
{
    public $jsonData = [];

    /**
     * DataLoader constructor.
     * @param $json_file
     * @param $params
     */
    public function __construct($json_file)
    {
        if (!file_exists($json_file)) {
            die("file not found");
        }
        $this->jsonData = $this->loadJson($json_file);
    }

    /**
     * @param $json_file
     * @return array
     */
    public function loadJson($json_file)
    {
        $array_data = [];
        foreach (json_decode(file_get_contents($json_file)) as $array) {
            $array_data[] = (array) $array;
        }
        return $array_data;
    }

    /**
     * @return mixed
     */
    public function getDataInArray()
    {
        return $this->jsonData;
    }
}
