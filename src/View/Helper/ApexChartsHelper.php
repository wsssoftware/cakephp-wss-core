<?php
declare(strict_types=1);

namespace Toolkit\View\Helper;

use Cake\Error\FatalErrorException;
use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use Cake\View\View;
use Toolkit\ApexCharts\ApexChart;

/**
 * ApexChars helper
 */
class ApexChartsHelper extends Helper
{

    use StringTemplateTrait;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'templates' => [],
    ];

    /**
     * @var \Toolkit\ApexCharts\ApexChart[]
     */
    protected array $_chartsConfigs;

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->_chartsConfigs = $this->getView()->get('_chartsConfigs', []);
    }

    /**
     * @param string $name
     * @return \Toolkit\ApexCharts\ApexChart
     */
    public function getChartConfig(string $name): ApexChart
    {
        $chartId = 'apex_chart_' . ApexChart::generateChartId($name);
        if (empty($this->_chartsConfigs[$chartId])) {
            throw new FatalErrorException('Chart config not found');
        }

        return $this->_chartsConfigs[$chartId];
    }

    /**
     * @param string $name
     * @param string $key
     * @return string
     */
    public function render(string $name, string $key = ''): string
    {
        $apexChart = $this->getChartConfig($name . $key);
        return $this->getView()->element('Toolkit.apex_chart', compact('apexChart'));
    }

}
