<?php

namespace BE\inventory\event;

use pocketmine\event\Cancellable;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\event\inventory\InventoryEvent;

class PrepareItemCraftEvent extends InventoryEvent implements Cancellable{

}
