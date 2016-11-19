<?php

namespace BE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\inventory\InventoryTransactionEvent;
use BE\event\InventoryClickEvent;

class Loader extends PluginBase implements Listener{

    public static $instance;

    public static function getInstance(){
        return self::$instance;
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onTransaction(InventoryTransactionEvent $ev){
        $failed = [];
        foreach(Server::getInstance()->getOnlinePlayers() as $player) {
            while (!$ev->getQueue()->getTransactions()->isEmpty()) {
                if (!$this->getInv($player)) {
                    return;
                }
                $transaction = $ev->getQueue()->getTransactions()->dequeue();
                if ($transaction->getInventory() instanceof ContainerInventory || $transaction->getInventory() instanceof PlayerInventory) {
                    $player->getServer()->getPluginManager()->callEvent($event = new InventoryClickEvent($transaction->getInventory(), $player, $transaction->getSlot(), $transaction->getInventory()->getItem($transaction->getSlot())));
                    if ($event->isCancelled()) {
                        $ev->setCancelled(true);
                    }
                    if ($ev->isCancelled()) {
                        $transaction->sendSlotUpdate($player);
                        continue;
                    } elseif (!$transaction->execute($player)) {
                        $transaction->addFailure();
                        if ($transaction->getFailures() >= SimpleTransactionQueue::DEFAULT_ALLOWED_RETRIES) {
                            $failed[] = $transaction;
                        } else {
                            $transaction->sendSlotUpdate($player);
                            $ev->getQueue()->getTransactions()->enqueue($transaction);
                        }
                        continue;
                    }
                   
                    $transaction->setSuccess();
                    $transaction->sendSlotUpdate($player);

                    foreach ($failed as $f) {
                        $f->sendSlotUpdate($player);
                    }
                }
            }
        }
    }

}
