<?php

declare(strict_types=1);

namespace matsuyuki\SkinDump\listener;

use matsuyuki\SkinDump\async_task\SaveSkinTask;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Server;

class PlayerJoinEventListener implements Listener {
    private string $dataPath;

    public function __construct(string $dataPath) {
        $this->dataPath = $dataPath;
    }
    /** @priority MONITOR */
    public function onJoin(PlayerJoinEvent $event):void {
        $player = $event->getPlayer();
        Server::getInstance()->getAsyncPool()->submitTask(new SaveSkinTask($player->getName(), $player->getSkin()->getSkinData(), $this->dataPath));
    }

}