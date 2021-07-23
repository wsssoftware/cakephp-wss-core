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

    private function _setLocales(): void
    {
        $this->setConfig('chart.defaultLocale', 'default');
        $this->setConfig('chart.locales', [
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
        ]);
    }

}