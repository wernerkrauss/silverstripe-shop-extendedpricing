<?php
namespace  MarkGuinn\ExendedPricing;


use SilverStripe\Forms\DatetimeField;

class PromoDatetimeField extends DatetimeField
{
    public function __construct($name, $title = null, $value = "")
    {
        parent::__construct($name, $title, $value);
        $this->dateField->setConfig("showcalendar", true);
    }

    /**
     * @param mixed $val
     * @param null $data
     * @return DatetimeField|void
     */
    public function setValue($val, $data=null)
    {
        if ($val == array('date' => '', 'time' => '')) {
            $val = null;
        }
        parent::setValue($val, $data);
    }
}
