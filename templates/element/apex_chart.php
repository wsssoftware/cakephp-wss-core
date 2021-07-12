<?php
/**
 * @var \App\View\AppView|\AppAdmin\View\AppView|\Cake\View\View $this
 * @var \Toolkit\ApexCharts\ApexChart $apexChart
 */

$optionsVar = $apexChart->getVariableChartId() . '_options';
$chartVar = $apexChart->getVariableChartId();
$htmlId = $apexChart->getHtmlChartId();

?>
<div id="<?= $htmlId ?>" class="w-100">
    <h4>dsdsa</h4>
</div>
<script type="text/javascript">
    window.addEventListener("load", function () {
        let <?= $optionsVar ?> = <?= $apexChart->getJsonOptions() ?>;
        let <?= $chartVar ?> = new ApexCharts(document.querySelector("#<?= $htmlId ?>"), <?= $optionsVar ?>);
        Toolkit.apexCharts.appendChart('<?= $chartVar ?>', <?= $chartVar ?>, <?= $apexChart->getRefreshTime() ?>);
        <?= $chartVar ?>.render();

    }, false);
</script>
