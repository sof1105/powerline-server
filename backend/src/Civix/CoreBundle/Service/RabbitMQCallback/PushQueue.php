<?php

namespace Civix\CoreBundle\Service\RabbitMQCallback;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Civix\CoreBundle\Service\PushSender;
use Civix\CoreBundle\Service\Representative\RepresentativeSTManager;

class PushQueue implements ConsumerInterface
{
    private $executorsArray;

    public function __construct(PushSender $pushSender, RepresentativeSTManager $repManager)
    {
        $this->executorsArray = array();
        $this->executorsArray[] = $pushSender;
        $this->executorsArray[] = $repManager;
    }

    public function execute(AMQPMessage $msg)
    {
        $executeParams = unserialize($msg->body);

        foreach ($this->executorsArray as $executorObj) {
            if (method_exists($executorObj, $executeParams['method'])) {
                call_user_func_array(
                    array($executorObj, $executeParams['method']),
                    $executeParams['params']
                );
            }
        }
    }
}
