<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Error\FatalErrorException;

class Xaxis
{

    public const TYPE_CATEGORY = 'category';
    public const TYPE_DATETIME = 'datetime';
    public const TYPE_NUMERIC = 'numeric';

    public const VALID_TYPES = [
        self::TYPE_CATEGORY,
        self::TYPE_DATETIME,
        self::TYPE_NUMERIC,
    ];




    /**
     * @var string
     */
    protected string $_type = self::TYPE_CATEGORY;



    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        if (!in_array($type, self::VALID_TYPES)) {
            throw new FatalErrorException('Wrong Xaxis type');
        }
        $this->_type = $type;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'type' => $this->_type,
        ];
    }
}