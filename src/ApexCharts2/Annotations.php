<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;
use Cake\I18n\FrozenTime;

class Annotations
{

    public const X_AXIS = 'xaxis';
    public const Y_AXIS = 'yaxis';
    public const VALID_AXIS = [
        self::X_AXIS,
        self::Y_AXIS,
    ];

    /**
     * @var array
     */
    protected array $_xaxis = [];

    /**
     * @var array
     */
    protected array $_yaxis = [];

    /**
     * @param string $axis
     * @param mixed $position
     * @param string $text
     * @param string $background
     * @param string $color
     * @param array $options
     * @return $this
     */
    public function new(string $axis, mixed $position, string $text, string $background = '#775DD0', string $color = '#fff', array $options = []): self
    {
        $options += [
            'strokeDashArray' => 3,
            'borderColor' => $background,
            'label' => [
                'style' => [
                    'background' => $background,
                    'color' => $color
                ],
                'text' => $text
            ]
        ];

        if ($axis === self::X_AXIS) {
            if ($position instanceof FrozenTime) {
                $options['x'] = "###FUNCTION###new Date('{$position->format('Y-m-d H:i')}').getTime()###FUNCTION###";
            } else {
                $options['x'] = $position;
            }
            $this->_xaxis[] = $options;
        } elseif ($axis === self::Y_AXIS) {
            $options['y'] = $position;
            $this->_yaxis[] = $options;
        } else {
            throw new FatalErrorException('Invalid axis');
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'position' => 'front',
            'xaxis' => $this->_xaxis,
            'yaxis' => $this->_yaxis,
        ];
    }
}