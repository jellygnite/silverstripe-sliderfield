<?php

namespace Jellygnite\SliderField;

use SilverStripe\Forms\Form;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\TextField;

/**
 * Field for a numeric slider
 *
 * @author Damian Mooyman
 * @package sliderfield
 */
class SliderField extends TextField
{

    public function Type()
    {
        return 'slider numeric text';
    }

    protected $orientation = 'horizontal';

    /**
     * Gets the orientation of this field
     *
     * @return string Either 'horizontal' or 'vertical'
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set the orientation of this field to horizontal or vertical
     *
     * @param string $orientation Either 'horizontal' or 'vertical'
     * @return self
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * Max slider value
     *
     * @var integer
     */
    protected $maximum;

    /**
     * Minimum slider value
     *
     * @var integer
     */
    protected $minimum;


    /**
     * Step of slider
     *
     * @var integer
     */
    protected $step;
	

    /**
     * Unit of slider
     *
     * @var string
     */
    protected $unit;
	
    /**
     * Create a SliderField object
     *
     * @param string $name
     * @param string $title
     * @param int $minimum
     * @param int $maximum
     * @param mixed $value
     * @param int $maxLength
     * @param Form $form
     */
    public function __construct($name, $title = null, $minimum = null, $maximum = null, $value = '', $maxLength = null, $form = null)
    {
        parent::__construct($name, $title, $value, $maxLength, $form);

        $this->setMaximum($maximum);
        $this->setMinimum($minimum);
    }

    /**
     * Get the maximum range value
     *
     * @return integer
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * Set the maximum range value
     *
     * @param int $maximum
     */
    public function setMaximum($maximum)
    {
        if ($maximum === null) {
            $maximum = self::config()->default_maximum;
        }
        $this->maximum = $maximum;
    }

    /**
     * Get the minimum range value
     *
     * @return integer
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * Set the minimum range value
     *
     * @param int $minimum
     */
    public function setMinimum($minimum)
    {
        if ($minimum === null) {
            $minimum = self::config()->default_minimum;
        }
        $this->minimum = $minimum;
    }

    /**
     * Get the step value
     *
     * @return integer
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set the step value
     *
     * @param int $step
     */
    public function setStep($step)
    {
        if ($step === null) {
            $step = self::config()->default_step;
        }
        $this->step = $step;
    }

    /**
     * Get the unit label
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the unit label
     *
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }


    public function Field($properties = array())
    {
        Requirements::javascript('silverstripe/admin: thirdparty/jquery-ui/jquery-ui.js');
        Requirements::javascript('jellygnite/silverstripe-sliderfield:client/dist/js/sliderfield.js');
        Requirements::css('jellygnite/silverstripe-sliderfield:client/dist/styles/sliderfield.css');
        return parent::Field($properties);
    }

    public function getAttributes()
    {
        return array_merge(
            parent::getAttributes(),
            array(
                'value' => $this->dataValue(),
                'data-min' => $this->getMinimum(),
                'data-max' => $this->getMaximum(),
                'data-orientation' => $this->getOrientation(),
                'data-step' => $this->getStep(),
                'data-unit' => $this->getUnit()
            )
        );
    }
}
