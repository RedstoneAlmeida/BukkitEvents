<?php

namespace BE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Loader extends PluginBase implements Listener{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

}
