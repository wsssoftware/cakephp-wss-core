<?php

declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;

class Chart
{

    public const TYPE_LINE = 'line';
    public const TYPE_AREA = 'area';
    public const TYPE_BAR = 'bar';
    public const TYPE_RADAR = 'radar';
    public const TYPE_HISTOGRAM = 'histogram';
    public const TYPE_PIE = 'pie';
    public const TYPE_DONUT = 'donut';
    public const TYPE_RADIAL_BAR = 'radialBar';
    public const TYPE_SCATTER = 'scatter';
    public const TYPE_BUBBLE = 'bubble';
    public const TYPE_HEATMAP = 'heatmap';
    public const TYPE_CANDLESTICK = 'candlestick';

    public const VALID_TYPES = [
        self::TYPE_LINE,
        self::TYPE_AREA,
        self::TYPE_BAR,
        self::TYPE_RADAR,
        self::TYPE_HISTOGRAM,
        self::TYPE_PIE,
        self::TYPE_DONUT,
        self::TYPE_RADIAL_BAR,
        self::TYPE_SCATTER,
        self::TYPE_BUBBLE,
        self::TYPE_HEATMAP,
        self::TYPE_CANDLESTICK,
    ];

    /**
     * @var string
     */
    protected string $_type = self::TYPE_LINE;

    /**
     * @var string
     */
    protected string $_defaultLocale = 'default';

    /**
     * @var string
     */
    protected string $_background = '#fff';

    /**
     * @var string
     */
    protected string $_foreColor = '#373d3f';

    /**
     * @var int|string
     */
    protected int|string $_height ='auto';

    /**
     * @var int|string
     */
    protected int|string $_width ='100%';

    /**
     * Background color for the chart area. If you want to set background with css, use .apexcharts-canvas to set it.
     *
     * @param string $background
     */
    public function setBackground(string $background): void
    {
        $this->_background = $background;
    }

    /**
     * Sets the text color for the chart. Defaults to #373d3f
     *
     * @param string $foreColor
     */
    public function setForeColor(string $foreColor): void
    {
        $this->_foreColor = $foreColor;
    }

    /**
     * Height of the chart. The default value ‘auto’ is calculated based on the golden ratio 1.618 which roughly translates to a 16:10 aspect ratio.
     * @note If you provide a percentage value '100%', make sure to have a fixed height parent.
     *
     * @param int|string $height
     */
    public function setHeight(int|string $height): void
    {
        $this->_height = $height;
    }

    /**
     * Width of the chart.
     *
     * @param int|string $width
     */
    public function setWidth(int|string $width): void
    {
        $this->_width = $width;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        if (!in_array($type, self::VALID_TYPES)) {
            throw new FatalErrorException('Wrong chart type');
        }
        $this->_type = $type;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'type' => $this->_type,
            'defaultLocale' => $this->_defaultLocale,
            'locales' => $this->_getLocale(),
            'background' => $this->_background,
            'foreColor' => $this->_foreColor,
        ];
    }

    /**
     * @return array
     */
    protected function _getLocale(): array
    {
        return [
            [
                'name' => "default",
                'options' => [
                    'months' => [
                        __d('toolkit', 'Janeiro'),
                        __d('toolkit', 'Fevereiro'),
                        __d('toolkit', 'Março'),
                        __d('toolkit', 'Abril'),
                        __d('toolkit', 'Maio'),
                        __d('toolkit', 'Junho'),
                        __d('toolkit', 'Julho'),
                        __d('toolkit', 'Agosto'),
                        __d('toolkit', 'Setembro'),
                        __d('toolkit', 'Outubro'),
                        __d('toolkit', 'Novembro'),
                        __d('toolkit', 'Dezembro')
                    ],
                    'shortMonths' => [
                        __d('toolkit', 'Jan'),
                        __d('toolkit', 'Fev'),
                        __d('toolkit', 'Mar'),
                        __d('toolkit', 'Abr'),
                        __d('toolkit', 'Mai'),
                        __d('toolkit', 'Jun'),
                        __d('toolkit', 'Jul'),
                        __d('toolkit', 'Ago'),
                        __d('toolkit', 'Set'),
                        __d('toolkit', 'Out'),
                        __d('toolkit', 'Nov'),
                        __d('toolkit', 'Dez')
                    ],
                    'days' => [__d('toolkit', 'Domingo'), __d('toolkit', 'Segunda'), __d('toolkit', 'Terça'), __d('toolkit', 'Quarta'), __d('toolkit', 'Quinta'), __d('toolkit', 'Sexta'), __d('toolkit', 'Sábado')],
                    'shortDays' => [__d('toolkit', 'Dom'), __d('toolkit', 'Seg'), __d('toolkit', 'Ter'), __d('toolkit', 'Qua'), __d('toolkit', 'Qui'), __d('toolkit', 'Sex'), __d('toolkit', 'Sab')],
                    'toolbar' => [
                        'exportToSVG' => __d('toolkit', 'Baixar SVG'),
                        'exportToPNG' => __d('toolkit', 'Baixar PNG'),
                        'exportToCSV' => __d('toolkit', 'Baixar CSV'),
                        'menu' => __d('toolkit', 'Menu'),
                        'selection' => __d('toolkit', 'Selecionar'),
                        'selectionZoom' => __d('toolkit', 'Selecionar Zoom'),
                        'zoomIn' => __d('toolkit', 'Aumentar'),
                        'zoomOut' => __d('toolkit', 'Diminuir'),
                        'pan' => __d('toolkit', 'Navegação'),
                        'reset' => __d('toolkit', 'Reiniciar Zoom'),
                    ]
                ]
            ]
        ];
    }
}