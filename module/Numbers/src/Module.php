<?php

namespace Numbers;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

		public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\NumbersTable::class => function($container) {
                    $tableGateway = $container->get(Model\NumbersTableGateway::class);
                    return new Model\NumbersTable($tableGateway);
                },
                Model\NumbersTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Numbers());
                    return new TableGateway('numbers', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\NumbersController::class => function($container) {
                    return new Controller\NumbersController(
                        $container->get(Model\NumbersTable::class)
                    );
                },
            ],
        ];
    }
}