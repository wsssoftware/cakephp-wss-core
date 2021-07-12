<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;

class Grid
{

    public const POSITION_FRONT = 'front';
    public const POSITION_BACK = 'back';

    public const VALID_POSITIONS = [
        self::POSITION_FRONT,
        self::POSITION_BACK,
    ];


    /**
     * @var bool
     */
    protected bool $_show = true;

    /**
     * @var string
     */
    protected string $_borderColor = '#90A4AE';

    /**
     * @var string
     */
    protected string $_position = self::POSITION_BACK;

    /**
     * @var bool
     */
    protected bool $_xaxisShow = false;

    /**
     * @var bool
     */
    protected bool $_yaxisShow = false;

    /**
     * @param bool $show
     */
    public function setShow(bool $show): void
    {
        $this->_show = $show;
    }

    /**
     * @param string $borderColor
     */
    public function setBorderColor(string $borderColor): void
    {
        $this->_borderColor = $borderColor;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        if (!in_array($position, self::VALID_POSITIONS)) {
            throw new FatalErrorException('Wrong grid position');
        }
        $this->_position = $position;
    }

    /**
     * @param bool $xaxisShow
     */
    public function setXaxisShow(bool $xaxisShow): void
    {
        $this->_xaxisShow = $xaxisShow;
    }

    /**
     * @param bool $yaxisShow
     */
    public function setYaxisShow(bool $yaxisShow): void
    {
        $this->_yaxisShow = $yaxisShow;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'show' => $this->_show,
            'borderColor' => $this->_borderColor,
            'position' => $this->_position,
            'xaxis:' => [
                'lines' => [
                    'show' => $this->_xaxisShow,
                ],
            ],
            'yaxis:' => [
                'lines' => [
                    'show' => $this->_yaxisShow,
                ],
            ],
        ];
    }
}