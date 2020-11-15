<?php
/**
 * Created by IntelliJ IDEA.
 * User: azam
 * Date: 09/04/2018
 * Time: 15:39
 */

namespace DataViewer;

/**
 * Class TableView
 * @package DataViewer
 */
class TableView implements DataRenderInterface
{
    public $data = [];
    public $dateFormat = "Y-m-d";
    public $dateFields = [];

    /**
     * TableView constructor.
     * @param $rows
     * @param $dateFormat
     * @param $dateFields
     */
    public function __construct($rows, $dateFormat, $dateFields)
    {
        if (empty($rows)) {
            die('Empty data');
        }
        $this->data = $rows;
        $this->dateFormat = $dateFormat;
        $this->dateFields = $dateFields;
    }

    /**
     * @return string
     */
    public function render()
    {
        $view_data = "<table width='100%'>";
        $fields = array_keys($this->data[0]);
        $view_data .= "<tr><th>".implode('</th><th>', $fields)."</th></tr>";

        # print fields
        foreach ($this->data as $value) {
            if ($this->dateFields) {
                foreach ($this->dateFields as $date_field) {
                    $value[$date_field] = date($this->dateFormat, strtotime($value[$date_field]));
                }
            }
            $view_data .= "<tr><td>".implode('</td><td>', $value)."</td></tr>";
        }
        $view_data .= "</table>";
        return $view_data;
    }
}
