<?php

namespace selector\arguments;

use pocketmine\Player;

use pocketmine\command\CommandSender;

class YRotationArgument extends BaseArgument {
    
    public function getArgument() : string {
        return "ry";
    }

    public function selectEntities(CommandSender $sender, string $argument, array $arguments, array $entities) : array {
        $array = [];
        $value = $this->getValue($argument);
        if (is_numeric($value)) {
            $y = floatval($value);
            foreach ($entities as $entity) {
                if ($entity->getYaw() == $y) {
                    $array[] = $entity;
                }
            }
            return $array;
        }

        $split = explode("..", $value);
        if (count($split) < 2) {
            return [];
        }

        if ($split[0] == "") {
            $y = floatval($split[1]);
            foreach ($entities as $entity) {
                if ($entity->getYaw() <= $y) {
                    $array[] = $entity;
                }
            }
            return $array;
        }

        if ($split[1] == "") {
            $y = floatval($split[0]);
            foreach ($entities as $entity) {
                if ($entity->getYaw() >= $y) {
                    $array[] = $entity;
                }
            }
            return $array;
        }

        $min = floatval($split[0]);
        $max = floatval($split[1]);

        foreach ($entities as $entity) {
            $yaw = $entity->getYaw();
            if ($min <= $yaw && $yaw <= $max) {
                $array[] = $entity;
            }
        }
        return $array;
    }
}