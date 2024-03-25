<?php

declare(strict_types=1);

namespace matsuyuki\SkinDump\listener;

use matsuyuki\SkinDump\async_task\SaveSkinTask;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChangeSkinEvent;
use pocketmine\Server;

class PlayerChangeSkinEventListener implements Listener {
    private string $dataPath;

    public function __construct(string $dataPath) {
        $this->dataPath = $dataPath;
    }

    /** @priority MONITOR */
    public function onChangeSkin(PlayerChangeSkinEvent $event):void {
        $player = $event->getPlayer();
        Server::getInstance()->getAsyncPool()->submitTask(new SaveSkinTask($player->getName(), $player->getSkin()->getSkinData(), $this->dataPath));
    }

}