<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;
use Cake\Utility\Hash;

class Tooltip
{

    /**
     * @var bool
     */
    protected bool $_enabled = true;

    /**
     * @var string
     */
    protected string $_xFormat;

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->_enabled = $enabled;
    }

    /**
     * @param string $xFormat
     */
    public function setXFormat(string $xFormat): void
    {
        $this->_xFormat = $xFormat;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $options = [
            'enabled' => $this->_enabled,
        ];
        if (!empty($this->_xFormat)) {
            $options = Hash::insert($options, 'x.format', $this->_xFormat);
        }

        return $options;
    }
}