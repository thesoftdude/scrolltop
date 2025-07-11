<?php

namespace softdude\scrolltop\controllers;

use craft\web\Controller;

class SettingsController extends Controller
{
    protected array|bool|int $allowAnonymous = false;

    public function actionIndex(): ?\yii\web\Response
    {
        $plugin = \Craft::$app->plugins->getPlugin('scrolltop');
        $settings = $plugin->getSettings();

        return $this->renderTemplate('scrolltop/settings', [
            'settings' => $settings,
            'plugin' => $plugin,
        ]);
    }
} 