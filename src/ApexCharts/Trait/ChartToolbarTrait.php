<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait ChartToolbarTrait
{

    /**
     * @var array
     */
    protected array $_chatToolbarCustomIcons = [];

    /**
     * Display the toolbar / menu in the top right corner.
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarShow(bool $show): self
    {
        $this->setConfig('chart.toolbar.show', $show);

        return $this;
    }

    /**
     * Sets the left offset of the toolbar.
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarOffsetX(int $offsetX): self
    {
        $this->setConfig('chart.toolbar.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the toolbar.
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarOffsetY(int $offsetY): self
    {
        $this->setConfig('chart.toolbar.offsetY', $offsetY);

        return $this;
    }

    /**
     * Show the download menu / hamburger icon in the toolbar. If you want to display a custom icon instead of hamburger icon, you can provide HTML string in this property.
     * download: true
     * OR
     * download: '<img src="/static/icons/download.png" class="ico-download" width="20">'
     *
     * @param bool|string $download
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsDownload(bool|string $download): self
    {
        $this->setConfig('chart.toolbar.tools.download', $download);

        return $this;
    }

    /**
     * Show the rectangle selection icon in the toolbar. If you want to display a custom icon for selection, you can provide HTML string in this property.
     *
     * @note Make sure to also enable chart.selection when showing the selection tool.
     * @param bool|string $selection
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsSelection(bool|string $selection): self
    {
        $this->setConfig('chart.toolbar.tools.selection', $selection);

        return $this;
    }

    /**
     * Show the zoom icon which is used for zooming by dragging selection on the chart area.
     * If you want to display a custom icon for zoom, you can provide HTML string in this property.
     *
     * @param bool|string $zoom
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsZoom(bool|string $zoom): self
    {
        $this->setConfig('chart.toolbar.tools.zoom', $zoom);

        return $this;
    }

    /**
     * Show the zoom-in icon which zooms in 50% from the visible chart area.
     * If you want to display a custom icon for zoom-in, you can provide HTML string in this property.
     *
     * @param bool|string $zoomin
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsZoomin(bool|string $zoomin): self
    {
        $this->setConfig('chart.toolbar.tools.zoomin', $zoomin);

        return $this;
    }

    /**
     * Show the zoom-out icon which zooms out 50% from the visible chart area.
     * If you want to display a custom icon for zoom-out, you can provide HTML string in this property.
     *
     * @param bool|string $zoomout
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsZoomout(bool|string $zoomout): self
    {
        $this->setConfig('chart.toolbar.tools.zoomout', $zoomout);

        return $this;
    }

    /**
     * Show the panning icon in the toolbar.
     *
     * @param bool|string $pan
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsPan(bool|string $pan): self
    {
        $this->setConfig('chart.toolbar.tools.pan', $pan);

        return $this;
    }

    /**
     * Reset the chart data to it’s initial state after zommin/zoomout/panning.
     * If you want to display a custom icon for reset, you can provide HTML string in this property.
     *
     * @param bool|string $reset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function setChartToolbarToolsReset(bool|string $reset): self
    {
        $this->setConfig('chart.toolbar.tools.reset', $reset);

        return $this;
    }

    /**
     * Allows to add additional icon buttons in the toolbar.
     * In the below example, index should be used to place at a particular position in the toolbar.
     *
     * @note On $onClickFunctionBody available params on js functions is "chart", "options" and "e"
     * @param string $icon
     * @param int $index
     * @param string $title
     * @param string $class
     * @param string $onClickFunctionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function addChartToolbarToolsCustomIcon(string $icon, int $index, string $title, string $class, string $onClickFunctionBody): self
    {
        $customIcon = [
            'icon' => $icon,
            'index' => $index,
            'title' => $title,
            'class' => $class,
            'click' => $this->_buildJsFunction($onClickFunctionBody, ['chart', 'options', 'e'])
        ];

        $this->_chatToolbarCustomIcons[] = $customIcon;

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function resetChartToolbarToolsCustomIcons(): self
    {
        $this->_chatToolbarCustomIcons = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setChartToolbarCustomIcons(): void
    {
        if (!empty($this->_chatToolbarCustomIcons)) {
            $this->setConfig('chart.toolbar.tools.customIcons', $this->_chatToolbarCustomIcons);
        }
    }


}