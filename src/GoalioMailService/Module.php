<?php
namespace GoalioMailService;

use GoalioMailService\Mail\Service\Message;
use Zend\Mvc\MvcEvent;
use Zend\Loader\StandardAutoloader;
use Zend\Loader\AutoloaderFactory;

class Module {

    public function getAutoloaderConfig() {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'shared' => array(
                'goaliomailservice_message'   => false
            ),
            'factories' => array(
                'goaliomailservice_message'   => function ($sm) {
                    $message = new Message($sm);
                    return $message;
                },
                'goaliomailservice_options'   => 'GoalioMailService\Mail\Options\Service\TransportOptionsFactory',
                'goaliomailservice_transport' => 'GoalioMailService\Mail\Transport\Service\TransportFactory',
                'goaliomailservice_renderer'  => 'GoalioMailService\Mail\View\MailPhpRendererFactory',
            ),
        );
    }
}

