<?php

namespace SAM;

use pocketmine\permission\Permission;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

use pocketmine\utils\TextFormat;


class LoginCommand implements CommandExecutor {
  
  public function __construct(SAM $plugin){
        $this->plugin = $plugin;
  }
  
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "login":
    			if($sender->hasPermission("sam.login")){
    				//Player Sender
    				if($sender instanceof Player){
    					$cfg = $this->plugin->getConfig()->getAll();
    					//Check if login is enabled
    					if($cfg["login"]["enabled"]){
    						//Check args
    						if(count($args) == 1){
    							$status = SAM::getAPI()->authenticatePlayer($sender, $args[0]);
    							if($status == SAM::SUCCESS){
    								$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["login"]["login-success"]));
    							}elseif($status == SAM::ERR_WRONG_PASSWORD){
    								$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["errors"]["wrong-password"]));
    							}elseif($status == SAM::ERR_USER_ALREADY_AUTHENTICATED){
    								$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["login"]["already-login"]));
    							}elseif($status == SAM::ERR_USER_NOT_REGISTERED){
    								$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["errors"]["user-not-registered"]));
    							}elseif($status == SAM::CANCELLED){
    								$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["operation-cancelled"]));
    							}else{
    								$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["errors"]["generic"]));
    							}
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["login"]["command"]));
    						}
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", $cfg["prefix"] . SAM::getAPI()->getConfigLanguage()->getAll()["login"]["disabled"]));
    					}
    					break;
    				}else{ //Console Sender
    					$sender->sendMessage($this->plugin->translateColors("&", SAM::PREFIX . "You can only perform this command as a player"));
    					break;
    				}
    			}else{
    				$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    				break;
    			}
    			return true;
    			}
    	}
}
?> 
  
  
