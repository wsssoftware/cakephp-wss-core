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
     * @return string
     */
    public function render(string $name): string
    {
        $apexChart = $this->getChartConfig($name);
        return $this->getView()->element('Toolkit.apex_chart', compact('apexChart'));
    }

}
