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
class XMLDataLoader implements DataLoaderInterface
{
    public $xmlData = [];

    /**
     * DataLoader constructor.
     * @param $xml_file
     * @param $params
     */
    public function __construct($xml_file)
    {
        if (!file_exists($xml_file)) {
            die("file not found");
        }
        $this->xmlData = $this->loadXml($xml_file);
    }

    /**
     * @param $xml_file
     * @return array
     */
    public function loadXml($xml_file)
    {
        $array_data = [];
        $content = file_get_contents($xml_file);
        $data = json_encode((array)simplexml_load_string($content));
        foreach (json_decode($data, 1) as $array) {
            $array_data[] = $array;
        }
        return $array_data[0];
    }

    /**
     * @return mixed
     */
    public function getDataInArray()
    {
        foreach ($this->xmlData as &$value) {
            if ($empty_key = array_search([], $value)) {
                $value[ $empty_key ] = '';
            }
        }
        return $this->xmlData;
    }
}
