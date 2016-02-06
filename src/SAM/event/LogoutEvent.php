<?php

namespace SAM\Event

use pocketmine\event\Cancellable;
use pocketmine\Player;
use SAM\SAM

class PlayerDeauthenticateEvent extends SimpleAuthEvent implements Cancellable{
	public static $handlerList = null;
	/** @var Player */
	private $player;
	/**
	 * @param SimpleAuth $plugin
	 * @param Player     $player
	 */
	public function __construct(SimpleAuth $plugin, Player $player){
		$this->player = $player;
		parent::__construct($plugin);
	}
	/**
	 * @return Player
	 */
	public function getPlayer(){
		return $this->player;
	}
}
