<?php

namespace selector\arguments;

use pocketmine\Player;

use pocketmine\command\CommandSender;

use selector\variables\NearestPlayerVariable;

class LimitArgument extends BaseArgument {
    
    public function getArgument() : string {
        return "c";
    }

    public function selectEntities(CommandSender $sender, string $argument, array $arguments, array $entities) : array {
        $value = $this->getValue($argument);
        if (!is_numeric($value)) {
            return [];
        }
        $limit = intval($value);

        if ($sender instanceof Player) {
            uasort($entities, function($a, $b) use ($sender) {
                return $sender->distanceSquared($a) - $sender->distanceSquared($b);
            });
        }

        if ($limit < 0) {
            $limit *= -1;
            $entities = array_reverse($entities);
        }

        $array = [];
        foreach ($entities as $entity) {
            if (count($array) >= $limit) {
                break;
            }

            $array[] = $entity;
        }
        
        return $array;
    }
}