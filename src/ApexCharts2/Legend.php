<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;

class Legend
{

    public const POSITION_TOP = 'top';
    public const POSITION_RIGHT = 'right';
    public const POSITION_BOTTOM = 'bottom';
    public const POSITION_LEFT = 'left';

    public const VALID_POSITIONS = [
        self::POSITION_TOP,
        self::POSITION_RIGHT,
        self::POSITION_BOTTOM,
        self::POSITION_LEFT,
    ];

    public const HORIZONTAL_ALIGN_LEFT = 'left';
    public const HORIZONTAL_ALIGN_CENTER = 'center';
    public const HORIZONTAL_ALIGN_RIGHT = 'right';

    public const VALID_HORIZONTAL_ALIGNS = [
        self::HORIZONTAL_ALIGN_LEFT,
        self::HORIZONTAL_ALIGN_CENTER,
        self::HORIZONTAL_ALIGN_RIGHT,
    ];



    /**
     * @var bool
     */
    protected bool $_show = true;

    /**
     * @var bool
     */
    protected bool $_showForSingleSeries = false;

    /**
     * @var bool
     */
    protected bool $_showForNullSeries = true;

    /**
     * @var bool
     */
    protected bool $_showForZeroSeries = true;

    /**
     * @var string
     */
    protected string $_position = self::POSITION_BOTTOM;

    /**
     * @var string
     */
    protected string $_horizontalAlign = self::HORIZONTAL_ALIGN_CENTER;

    /**
     * @var bool
     */
    protected bool $_floating = false;

    /**
     * @var string
     */
    protected string $_fontSize = '14px';

    /**
     * @var string
     */
    protected string $_fontFamily = 'Helvetica, Arial';

    /**
     * @var int
     */
    protected int $_fontWeight = 400;

    /**
     * @var bool
     */
    protected bool $_inverseOrder = false;

    /**
     * @var bool
     */
    protected bool $_onClickToggleDataSeries = true;

    /**
     * @var bool
     */
    protected bool $_onHoverHighlightDataSeries = true;

    /**
     * @param bool $show
     */
    public function setShow(bool $show): void
    {
        $this->_show = $show;
    }

    /**
     * @param bool $showForSingleSeries
     */
    public function setShowForSingleSeries(bool $showForSingleSeries): void
    {
        $this->_showForSingleSeries = $showForSingleSeries;
    }

    /**
     * @param bool $showForNullSeries
     */
    public function setShowForNullSeries(bool $showForNullSeries): void
    {
        $this->_showForNullSeries = $showForNullSeries;
    }

    /**
     * @param bool $showForZeroSeries
     */
    public function setShowForZeroSeries(bool $showForZeroSeries): void
    {
        $this->_showForZeroSeries = $showForZeroSeries;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        if (!in_array($position, self::VALID_POSITIONS)) {
            throw new FatalErrorException('Wrong legend position');
        }
        $this->_position = $position;
    }

    /**
     * @param string $horizontalAlign
     */
    public function setHorizontalAlign(string $horizontalAlign): void
    {
        if (!in_array($horizontalAlign, self::VALID_HORIZONTAL_ALIGNS)) {
            throw new FatalErrorException('Wrong legend horizontal align');
        }
        $this->_horizontalAlign = $horizontalAlign;
    }

    /**
     * @param bool $floating
     */
    public function setFloating(bool $floating): void
    {
        $this->_floating = $floating;
    }

    /**
     * @param string $fontSize
     */
    public function setFontSize(string $fontSize): void
    {
        $this->_fontSize = $fontSize;
    }

    /**
     * @param string $fontFamily
     */
    public function setFontFamily(string $fontFamily): void
    {
        $this->_fontFamily = $fontFamily;
    }

    /**
     * @param int $fontWeight
     */
    public function setFontWeight(int $fontWeight): void
    {
        $this->_fontWeight = $fontWeight;
    }

    /**
     * @param bool $_inverseOrder
     */
    public function setInverseOrder(bool $_inverseOrder): void
    {
        $this->_inverseOrder = $_inverseOrder;
    }

    /**
     * @param bool $onClickToggleDataSeries
     */
    public function setOnClickToggleDataSeries(bool $onClickToggleDataSeries): void
    {
        $this->_onClickToggleDataSeries = $onClickToggleDataSeries;
    }

    /**
     * @param bool $onHoverHighlightDataSeries
     */
    public function setOnHoverHighlightDataSeries(bool $onHoverHighlightDataSeries): void
    {
        $this->_onHoverHighlightDataSeries = $onHoverHighlightDataSeries;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'show' => $this->_show,
            'showForSingleSeries' => $this->_showForSingleSeries,
            'showForNullSeries' => $this->_showForNullSeries,
            'showForZeroSeries' => $this->_showForZeroSeries,
            'position' => $this->_position,
            'horizontalAlign' => $this->_horizontalAlign,
            'floating' => $this->_floating,
            'fontSize' => $this->_fontSize,
            'fontFamily' => $this->_fontFamily,
            'fontWeight' => $this->_fontWeight,
            'inverseOrder' => $this->_inverseOrder,
            'onItemClick:' => [
                'toggleDataSeries' => $this->_onClickToggleDataSeries,
            ],
            'onItemHover' => [
                'highlightDataSeries' => $this->_onHoverHighlightDataSeries,
            ],
        ];
    }
}