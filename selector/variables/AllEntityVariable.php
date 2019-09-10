<?php

namespace selector\variables;

use pocketmine\Server;

use pocketmine\command\CommandSender;

class AllEntityVariable implements IVariable {

    public function getVariable() : string {
        return "e";
    }

    public function getEntities(CommandSender $sender, string $args, array $arguments) : array {
        $array = [];
        foreach (Server::getInstance()->getLevels() as $level) {
            $array = array_merge($array, $level->getEntities());
        }
        return $array;
    }
}