# BukkitEvents
Based in Bukkit Events(BUKKIT API) , transfer Bukkit events to PocketMine/Genisys/ClearSky/Imagicalmine and others

## Working Events
- InventoryClickEvent( `use BE\inventory\event\InventoryClickEvent;` )

## How to Use?!
###### Use code:
```php
## Class:
use BE\inventory\event\InventoryClickEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\inventory\ChestInventory;
use pocketmine\inventory\PlayerInventory;

class YOUCLASS extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    ## Event to work
    public function onClick(InventoryClickEvent $event){
        $player = $event->getWhoClicked();
        $inventory = $event->getInventory();
        if(!$inventory instanceof ChestInventory){
            return;
        }
        if($event->getSlot() == 1 or $event->getItem()->getId() == 1){
            $event->setCancelled(true);
            $player->sendMessage("working");
        }
    }
}
```
