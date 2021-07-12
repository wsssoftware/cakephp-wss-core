<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;

use Cake\Core\Configure;
use Cake\Core\InstanceConfigTrait;
use Cake\Datasource\ModelAwareTrait;
use Cake\Error\FatalErrorException;
use Cake\Routing\Router;
use Cake\Utility\Hash;

abstract class ApexChart
{

    use ModelAwareTrait;
    use InstanceConfigTrait;

    /**
     * @var string
     */
    protected string $_chartId;

    /**
     * @var string
     */
    protected string $_loadingText;

    /**
     * @var string
     */
    protected string $_loadingErrorText;

    /**
     * @var \Toolkit\ApexCharts\Chart
     */
    public Chart $Chart;

    /**
     * @var \Toolkit\ApexCharts\Grid
     */
    public Grid $Grid;

    /**
     * @var \Toolkit\ApexCharts\Legend
     */
    public Legend $Legend;

    /**
     * @var string[]
     */
    public array $_labels = [];

    /**
     * @var array
     */
    public array $_series = [];

    /**
     * @var string[]
     */
    public array $_colors = [];

    /**
     * @var array
     */
    protected array $_options = [
        'xaxis' => [
            'type' => 'datetime',
        ]
    ];

    /**
     * @var int
     */
    protected int $_refreshTime = 30;

    /**
     * TableAbstract constructor.
     */
    public function __construct()
    {
        $this->_loadingText = __('Carregando') . '...';
        $this->_loadingErrorText = __('Algo deu errado ao carregar o gráfico! Tente atualizar a página.');
        $this->_chartId = self::generateChartId($this::class);
        $this->Chart = new Chart();
        $this->Grid = new Grid();
        $this->Legend = new Legend();
        $this->define();
        if (!empty(Router::getRequest()->getHeader('chartUpdate'))) {
            $this->data();
        }
    }

    /**
     * Define the chart configuration
     */
    abstract public function define(): void;

    /**
     * Define the chart configuration
     */
    abstract public function data(): void;

    /**
     * @return array
     */
    public function getJsonData(): array
    {
        $options = Hash::insert([], 'series', $this->_series);
        if (!empty($this->_labels)) {
            $options = Hash::insert($options, 'labels', $this->_labels);
        }

        return $options;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function generateChartId(string $name): string
    {
        return md5($name);
    }

    /**
     * @param string $name
     * @param string $color
     * @return self
     */
    public function addSerie(string $name, string $color): self
    {
        $this->_series[] = [
            'name' => $name,
            'data' => [],
        ];
        $this->_colors[] = $color;

        return $this;
    }

    /**
     * @param string $name
     * @return self
     */
    public function resetSeries(string $name): self
    {
        $this->_series = [];
        $this->_colors = [];

        return $this;
    }

    /**
     * @param string $label
     * @param mixed $data
     */
    public function appendData(string $label, array $data) {
        $this->_labels[] = $label;
        foreach ($data as $index => $value) {
            $this->_series[$index]['data'][] = $value;
        }
    }

    /**
     * @return int
     */
    public function getRefreshTime(): int
    {
        return $this->_refreshTime;
    }

    /**
     * @param int $refreshTime
     * @return self
     */
    public function setRefreshTime(int $refreshTime): self
    {
        if ($refreshTime < 2) {
            throw new FatalErrorException('Refresh time must be greater than 4');
        }
        $this->_refreshTime = $refreshTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getChartId(): string
    {
        return $this->_chartId;
    }

    /**
     * @return string
     */
    public function getVariableChartId(): string
    {
        return 'apex_chart_' . $this->_chartId;
    }

    /**
     * @return string
     */
    public function getHtmlChartId(): string
    {
        return 'apex-chart-' . $this->_chartId;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $options = $this->_options;

        $options = Hash::insert($options, 'chart', $this->Chart->getOptions());
        $options = Hash::insert($options, 'grid', $this->Grid->getOptions());
        $options = Hash::insert($options, 'legend', $this->Legend->getOptions());
        $options = Hash::insert($options, 'series', []);
        $options = Hash::insert($options, 'colors', $this->_colors);
        $options = Hash::insert($options, 'noData.text', __('Nenhum dado'));
        if (!empty($this->_labels)) {
            $options = Hash::insert($options, 'labels', []);
        }

        return $options;
    }

    /**
     * @return string
     */
    public function getJsonOptions(): string
    {
        $debug = Configure::read('debug', false);
        if ($debug) {
            return json_encode($this->getOptions(), \JSON_PRETTY_PRINT);
        }
        return json_encode($this->getOptions());
    }

}