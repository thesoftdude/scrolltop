<?php

namespace softdude\scrolltop\assets;

use craft\web\AssetBundle;

class ScrolltopAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/dist';
        $this->js = ['scrolltop.min.js'];
        parent::init();
    }
} 