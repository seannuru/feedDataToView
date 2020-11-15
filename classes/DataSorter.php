<?php
namespace DataViewer;

class DataSorter
{
    public $data;
    public $field;
    public $currencyField = [];
    public $ascDesc = 'ASC';

    /**
     * DataSorter constructor.
     * @param $data
     * @param $field
     * @param $currencyField
     * @param string $ascDesc
     */
    public function __construct($data, $field, $currencyField, $ascDesc = 'ASC')
    {
        foreach (['data', 'field','currencyField','ascDesc'] as $var) {
            $this->$var = $$var;
        }
    }

    /**
     * @return array
     */
    public function sort()
    {
        foreach (['field','currencyField','ascDesc'] as $var) {
            $$var = $this->$var;
        }
        usort($this->data, function ($a, $b) use ($field, $currencyField, $ascDesc) {
            if ($a[$field] == $b[$field]) {
                return 0;
            }
            if (in_array($field, $currencyField)) {
                $a[$field] = floatval(str_replace("$", "", $a[$field]));
                $b[$field] = floatval(str_replace("$", "", $b[$field]));
            }
            if ($ascDesc == 'DESC') {
                return $a[$field] > $b[$field]?-1:1;
            } else {
                return $a[$field] < $b[$field]?-1:1;
            }
        });
        return $this->data;
    }
}
