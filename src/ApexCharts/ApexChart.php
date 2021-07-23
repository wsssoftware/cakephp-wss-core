<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Core\Configure;
use Cake\Core\InstanceConfigTrait;
use Cake\Datasource\ModelAwareTrait;
use Cake\Error\FatalErrorException;
use Toolkit\ApexCharts\Trait\AnnotationsTrait;
use Toolkit\ApexCharts\Trait\ChartAnimationsTrait;
use Toolkit\ApexCharts\Trait\ChartBrushTrait;
use Toolkit\ApexCharts\Trait\ChartTrait;
use Toolkit\ApexCharts\Trait\ColorsTrait;
use Toolkit\ApexCharts\Trait\SubtitleTrait;
use Toolkit\ApexCharts\Trait\TitleTrait;
use Toolkit\Utilities\Arrays;

abstract class ApexChart
{

    use ModelAwareTrait;
    use InstanceConfigTrait;

    use AnnotationsTrait;
    use ChartTrait;
    use ChartAnimationsTrait;
    use ChartBrushTrait;
    use ColorsTrait;
    use SubtitleTrait;
    use TitleTrait;

    public const ID_PREFIX = 'apex_chart_';

    /**
     * @var int
     */
    protected static int $_refreshTime = 30;

    /**
     * Default config for chart.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    /**
     * @var string
     */
    protected string $_id;

    /**
     * @param int $_refreshTime
     */
    public static function setRefreshTime(int $_refreshTime): void
    {
        if ($_refreshTime < 1 || $_refreshTime !== -1) {
            throw new FatalErrorException('Refresh time must to be greater than zero or -1 for non refresh.');
        }
        self::$_refreshTime = $_refreshTime;
    }

    /**
     * @return int
     */
    public static function getRefreshTime(): int
    {
        return self::$_refreshTime;
    }

    /**
     * ApexChart constructor.
     *
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        $this->_id = static::generateId($id);
        $this->initialize();
    }


    /**
     * @param string|null $id
     * @return string
     */
    public static function generateId(string $id = null): string
    {
        return static::ID_PREFIX . md5(static::class . $id);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getHtmlId(): string
    {
        return str_replace('_', '-', $this->_id);
    }

    /**
     * @return void
     */
    abstract public function initialize(): void;

    /**
     * @return void
     */
    abstract public function configure(): void;

    /**
     * @return array
     */
    abstract public function getData(): array;

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $this->setAnnotationsOptions();
        $this->_setLocales();
        $this->setColorsOptions();
        $options = $this->getConfig();
        Arrays::globalKSort($options);
        return $options;
    }

    /**
     * @return string
     */
    public function getOptionsJson(): string
    {
        $debug = Configure::read('debug', false);
        if ($debug) {
            $json = json_encode($this->getOptions(), JSON_PRETTY_PRINT);
        } else {
            $json = json_encode($this->getOptions());
        }
        return $this->_replaceQuotesFromJson($json);
    }

    /**
     * @param string $json
     * @return string
     */
    protected function _replaceQuotesFromJson(string $json): string
    {
        return str_replace(['"###QUOTES###', '###QUOTES###"', "'###QUOTES###", "###QUOTES###'"], '', $json);
    }


}