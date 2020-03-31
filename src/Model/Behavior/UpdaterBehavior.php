<?php
namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;

/**
 * Updater behavior
 */
class UpdaterBehavior extends Behavior
{
    public function beforeSave(Event $event, Entity $entity)
    {
        $now = Time::now();

        if ($entity->isNew()) {
            $entity->{'created_at'} = $now;
        }

        $entity->{'updated_at'} = $now;
    }
}
