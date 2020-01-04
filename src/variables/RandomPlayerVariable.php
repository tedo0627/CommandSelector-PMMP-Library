<?php

namespace selector\variables;

use pocketmine\Server;

use pocketmine\command\CommandSender;

class RandomPlayerVariable implements IVariable {

    public function getVariable() : string {
        return "r";
    }

    public function getEntities(CommandSender $sender, string $args, array $arguments) : array {
        $players = Server::getInstance()->getOnlinePlayers();
        $players = array_values($players);
        shuffle($players);
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