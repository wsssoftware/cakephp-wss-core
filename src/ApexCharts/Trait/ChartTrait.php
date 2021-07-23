<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Utilities\Colors;

trait ChartTrait
{

    /**
     * Background color for the chart area. If you want to set background with css, use .apexcharts-canvas to set it.
     *
     * @param string $background
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartBackground(string $background): self
    {
        Colors::validateColorOrFail($background);
        $this->setConfig('chart.background', $background);

        return $this;
    }

}