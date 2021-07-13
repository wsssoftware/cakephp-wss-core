<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Core\Configure;
use Cake\Error\FatalErrorException;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;

class Yaxis
{

    /**
     * @var bool
     */
    protected bool $_labelShow = true;

    /**
     * @var string
     */
    protected string $_formatter;

    /**
     * @param bool $labelShow
     */
    public function setLabelsShow(bool $labelShow): void
    {
        $this->_labelShow = $labelShow;
    }

    /**
     * @param $currency
     * @param string|null $locale
     * @return self
     */
    public function setCurrencyFormatter($currency, string $locale = null): self
    {
        if (empty($locale)) {
            $locale = str_replace('_', '-', Configure::read('App.defaultLocale', 'en_US'));
        }
        $this->_formatter = "###FUNCTION###function (value) { return Toolkit.apexCharts.formatters.currency(value, '$locale', '$currency') },###FUNCTION###";

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $options = [
            'labels' => [
                'show' => $this->_labelShow,
            ]
        ];
        if (!empty($this->_formatter)) {
            $options = Hash::insert($options, 'labels.formatter', $this->_formatter);
        }
        return $options;
    }
}