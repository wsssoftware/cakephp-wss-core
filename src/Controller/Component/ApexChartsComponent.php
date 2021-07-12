<?php
declare(strict_types=1);

namespace Toolkit\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\EventManager;
use Cake\View\JsonView;
use Toolkit\ApexCharts\ApexChart;

/**
 * ApexChars component
 */
class ApexChartsComponent extends Component
{

    /**
     * @var ApexChart[]
     */
    protected array $_chartsConfigs = [];

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        EventManager::instance()->on(
            'Controller.beforeRender',
            function ()
            {
                $this->getController()->set('_chartsConfigs', $this->_chartsConfigs);
                $this->_setView();
            }
        );
    }

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function setChart(ApexChart $apexCharts): void
    {
        $this->_chartsConfigs[$apexCharts->getVariableChartId()] = $apexCharts;
    }

    /**
     *
     */
    private function _setView()
    {
        if (!empty($this->getController()->getRequest()->getHeader('chartUpdate'))) {
            $_apexChartItem = [];
            foreach ($this->_chartsConfigs as $chartsConfig) {
                $_apexChartItem[$chartsConfig->getVariableChartId()] = $chartsConfig->getJsonData();
            }
            $this->getController()->set('_apexChartItem', $_apexChartItem);
            $this->getController()->viewBuilder()->setOption('serialize', '_apexChartItem');
            $this->getController()->viewBuilder()->setClassName(JsonView::class);
        }
    }
}
