<?php

declare(strict_types=1);

namespace Eren5960\DebugCommand;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\MainLogger;

class Main extends PluginBase{
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		$mode = array_shift($args) ?? 'anything';
		if(!in_array($mode, ['on', 'off'])){
			$sender->sendMessage('Usage: /debug <on/off>');
			return false;
		}

		$logger = Server::getInstance()->getLogger();
		if($logger instanceof MainLogger){
			$logger->setLogDebug($mode === 'on');
			$sender->sendMessage('Debug mode is ' . ($mode === 'on' ? 'enabled' : 'disabled') . '.');
		}else{
			$sender->sendMessage('Unexpected Logger: ' . get_class($logger));
		}
		return true;
	}
}