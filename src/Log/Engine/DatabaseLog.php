<?php
declare(strict_types=1);


namespace Toolkit\Log\Engine;


use AppCore\Model\Table\LogsTable;
use Cake\Log\Engine\BaseLog;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class DatabaseLog extends BaseLog
{

    /**
     * @var \Toolkit\Model\Table\LogsTable|\Cake\ORM\Table
     */
    private LogsTable|Table $Logs;

    /**
     * DatabaseLog constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = []) {
        parent::__construct($config);
        $this->Logs = TableRegistry::getTableLocator()->get('Toolkit.Logs');
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return bool|void
     */
    public function log($level, $message, array $context = [])
    {
        if ($this->getConfig('type')) {
            $level = $this->getConfig('type');
        } elseif ($this->getConfig('file')) {
            $level = $this->getConfig('file');
        }

        return $this->Logs->log($level, $message, $context);
    }
}