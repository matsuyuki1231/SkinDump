<?php

declare(strict_types=1);

namespace matsuyuki\SkinDump;

use pocketmine\utils\SingletonTrait;

class FileSerializeInitializer {
    use SingletonTrait;

    public const DIR = "skins";

    private string $path;

    public function __construct(string $pluginDataPath) {
        $this->path = $pluginDataPath. DIRECTORY_SEPARATOR. self::DIR;
        if (!is_dir($this->path)) {
            mkdir($this->path);
        }
        self::setInstance($this);
    }

}