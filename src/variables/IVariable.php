<?php

namespace selector\variables;

use pocketmine\command\CommandSender;

interface IVariable {
    
    public function getVariable() : string;
    
    public function getEntities(CommandSender $sender, string $args, array $arguments) : array;

    public function selectEntities(CommandSender $sender, array $entities, array $arguments) : array;
}