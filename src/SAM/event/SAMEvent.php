<?php

namespace SAM\Event

use pocketmine\event\plugin\PluginEvent;
use SAM\SAM

abstract class SAMEvent extends PluginEvent{
	/**
	 * @param SAM $plugin
	 */
	public function __construct(SimpleAuth $plugin){
		parent::__construct($plugin);
	}
}
