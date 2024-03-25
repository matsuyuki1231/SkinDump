<?php

declare(strict_types=1);

namespace matsuyuki\SkinDump\async_task;

use matsuyuki\SkinDump\FileSerializeInitializer;
use matsuyuki\SkinDump\SkinConverter;
use pocketmine\scheduler\AsyncTask;

class SaveSkinTask extends AsyncTask {
    private string $playerName;
    private string $skinData;
    private string $dataPath;

    public function __construct(string $playerName, string $skinData, string $dataPath) {
        $this->playerName = $playerName;
        $this->skinData = $skinData;
        $this->dataPath = $dataPath;
    }

    public function onRun():void {
        imagepng(
            SkinConverter::convert($this->skinData),
            $this->dataPath. DIRECTORY_SEPARATOR. FileSerializeInitializer::DIR. DIRECTORY_SEPARATOR. $this->playerName. ".png",
            0,
            PNG_NO_FILTER
        );
    }

}