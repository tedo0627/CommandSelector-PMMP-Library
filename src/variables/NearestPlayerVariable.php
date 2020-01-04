<?php

namespace selector\variables;

use pocketmine\command\CommandSender;

use pocketmine\level\Position;


use selector\arguments\LimitArgument;

class NearestPlayerVariable implements IVariable {

    public function getVariable() : string {
        return "p";
    }

    public function getEntities(CommandSender $sender, string $args, array $arguments) : array {
        if (!($sender instanceof Position)) {
            return [];
        }

        $players = $sender->getLevel()->getPlayers();
        if (count($players) == 0) {
            return [];
        }

        $players = array_values($players);
        uasort($players, function($a, $b) use ($sender) {
            return $sender->distanceSquared($a) - $sender->distanceSquared($b);
        });

        return $players;
    }
    
    public function selectEntities(CommandSender $sender, array $entities, array $arguments) : array {
        foreach ($arguments as $argument) {
            if ($argument instanceof LimitArgument) {
                return $entities;
            }
        }

        if (count($entities) > 0) {
            return [$entities[0]];
        }
        return $entities;
    }
}