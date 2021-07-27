<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

trait SeriesTrait
{

    /**
     * @var array
     */
    protected array $_series = [];

    /**
     * @param string $name
     * @param string|null $type
     * @param array $data
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function addSerie(string $name, string $type = null, array $data = []): self
    {
        $serie = [
            'name' => $name,
            'data' => $data,
        ];
        if (!empty($type)) {
            $serie['type'] = $type;
        }
        $this->_series[] = $serie;

        return $this;
    }

    /**
     * @param int $index
     * @param float|int|array $data
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function appendSerieData(int $index, float|int|array $data): self
    {
        if (!is_array($data)) {
            $data = [$data];
        }
        foreach ($data as $datum) {
            $this->_series[$index]['data'][] = $datum;
        }

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function resetSeries(): self
    {
        $this->_series = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setSeries(): void
    {
        if (!empty($this->_series)) {
            $this->setConfig('series', $this->_series);
        }
    }

}