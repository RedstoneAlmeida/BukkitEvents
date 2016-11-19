# BukkitEvents
Based in Bukkit Events(BUKKIT API) , transfer Bukkit events to PocketMine/Genisys/ClearSky/Imagicalmine and others

## Working Events
- InventoryClickEvent( `use BE\inventory\event\InventoryClickEvent;` )

## How to Use?!
###### Use code:
```
## Class:
use BE\event\InventoryClickEvent;

    ## Event to work
    public function onClick(InventoryClickEvent $event){


    }
```
###### Or
```
$this->getServer()->getPluginManager()->getPlugin("BE-BukkitEvents");
```
