<?php

namespace SAM\event

use pocketmine\event\Cancellable;
use pocketmine\Player;
use SAM\SAM;

class LoginEvent extends SAMEvent implements Cancellable{
	public static $handlerList = null;
	/** @var Player */
	private $player;
	/**
	 * @param SAM $plugin
	 * @param Player     $player
	 */
	public function __construct(SAM $plugin, Player $player){
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
