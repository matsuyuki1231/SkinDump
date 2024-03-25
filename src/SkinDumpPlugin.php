<?php

namespace matsuyuki\SkinDump;

use matsuyuki\SkinDump\listener\PlayerChangeSkinEventListener;
use matsuyuki\SkinDump\listener\PlayerJoinEventListener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class SkinDumpPlugin extends PluginBase {
    protected function onEnable():void {
        if (!extension_loaded("gd")) {
            Server::getInstance()->getLogger()->error("module \"gd\" not installed");
            Server::getInstance()->getPluginManager()->disablePlugin($this);
            return;
        }
        new FileSerializeInitializer($this->getDataFolder());
        Server::getInstance()->getPluginManager()->registerEvents(new PlayerJoinEventListener($this->getDataFolder()), $this);
        Server::getInstance()->getPluginManager()->registerEvents(new PlayerChangeSkinEventListener($this->getDataFolder()), $this);
    }

}