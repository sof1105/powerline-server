<?php

namespace Civix\CoreBundle\Entity\Notification;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class IOSEndpoint extends AbstractEndpoint
{
    public function getPlatformMessage($message, $type, $entityData)
    {
        return json_encode(array('APNS' => json_encode(array('aps' => array(
            'alert' => $message,
            'entity' => json_encode($entityData),
            'type' => $type,
            'sound' => 'default',
            'title' => $type,
            'image' => 'www/images/notification_image.jpg',
        )))));
    }
}
