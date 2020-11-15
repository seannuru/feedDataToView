<?php
namespace DataViewer;

/**
 * Class TableView
 * @package DataViewer
 */
class ListView implements DataRenderInterface
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
        $view_data = "<style type=\"text/css\">
    /*DL, DT, DD TAGS LIST DATA*/
dl {
    margin-bottom:50px;
}
 
dl dt {
    background:#5f9be3;
    color:#fff;
    float:left; 
    font-weight:bold; 
    margin-right:10px; 
    padding:5px;  
    width:150px;
    clear: both;
}
 
dl dd {
    margin:2px 0; 
    padding:5px 0;
}
</style>";
        # print fields
        foreach ($this->data as $value) {
            if ($this->dateFields) {
                foreach ($this->dateFields as $date_field) {
                    $value[$date_field] = date($this->dateFormat, strtotime($value[$date_field]));
                }
            }
            $view_data .= "<dl>";
            foreach ($value as $key => $itemVal) {
                if ($itemVal != '0' && $itemVal == '') {
                    $itemVal = "&nbsp;";
                }
                $view_data .= "<dt>{$key} </dt>";
                $view_data .= "<dd>{$itemVal}</dd>";
            }
            $view_data .= "</dl>";
        }
        return $view_data;
    }
}
