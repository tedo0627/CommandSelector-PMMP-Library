# CommandSelector-PMMP-Library
command selector library

## Install
Copy the downloaded selector folder to the src folder of the plugin.

## How to use
Suppose you want to process the command `/test @p`.  

```php
use selector\CommandSelector;

public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
    if ($label != "test") {
        return false;
    }

    if (count($args) < 1) {
        $sender->sendMessage("/test [target]");
        return false;
    }

    $selector = new CommandSelector();
    $entities = $selector->getEntities($sender, $args[0]);
    foreach ($entities as $entity) {
        // process
    }

    return true;
}
```
