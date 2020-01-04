<?php

namespace selector\variables;

use pocketmine\Server;

use pocketmine\command\CommandSender;

class AllPlayerVariable implements IVariable {

    public function getVariable() : string {
        return "a";
    }

    public function getEntities(CommandSender $sender, string $args, array $arguments) : array {
        $players = Server::getInstance()->getOnlinePlayers();
        $players = array_values($players);
        return $players;
    }
    
    public function selectEntities(CommandSender $sender, array $entities, array $arguments) : array {
        return $entities;
    }
}