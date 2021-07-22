<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;

trait TitleTrait
{

    /**
     * Text to display as a title of chart
     *
     * @param string $text
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\TitleTrait
     */
    public function titleText(string $text): self
    {
        $this->setConfig('title.text', $text);

        return $this;
    }

    /**
     * Alignment of title relative to chart area.
     * Possible Options:
     *  - left
     *  - center
     *  - right
     *
     * @param string $align
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\TitleTrait
     */
    public function titleAlign(string $align): self
    {
        $valid = ['left', 'center', 'right'];
        if (!in_array($align, $valid)) {
            throw new ApexChartWrongOptionException('titleAlign', null, $valid);
        }
        $this->setConfig('title.align', $align);

        return $this;
    }

    /**
     * Vertical spacing around the title text
     *
     * @param int $margin
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\TitleTrait
     */
    public function titleMargin(int $margin): self
    {
        $this->setConfig('title.margin', $margin);

        return $this;
    }

    /**
     * Sets the left offset for title text
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\TitleTrait
     */
    public function titleOffsetX(int $offset): self
    {
        $this->setConfig('title.offsetX', $offset);

        return $this;
    }

    /**
     * Sets the top offset for title text
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\TitleTrait
     */
    public function titleOffsetY(int $offset): self
    {
        $this->setConfig('title.offsetY', $offset);

        return $this;
    }

}