<?php

namespace softdude\scrolltop;

use craft\base\Plugin;
use craft\web\View;
use yii\base\Event;
use softdude\scrolltop\assets\ScrolltopAsset;
use softdude\scrolltop\Models\Settings;

class Scrolltop extends Plugin
{
    public static ?Scrolltop $plugin = null;
    public bool $hasCpSettings = true;
    public bool $hasCpSection = true;
    public string $schemaVersion = '1.0.0';
    public ?string $name = 'Scroll to Top';
    public const VERSION = '0.1.0';

    public function init(): void
    {
        parent::init();
        self::$plugin = $this;
        
        // Set controller namespace
        $this->controllerNamespace = 'softdude\\scrolltop\\controllers';

        // Register routes for CP section
        if (!\Craft::$app->getRequest()->getIsConsoleRequest()) {
            \Craft::$app->getUrlManager()->addRules([
                'scrolltop' => 'scrolltop/settings/index',
            ], false);
        }

        // Register asset bundle on frontend requests
        Event::on(
            View::class,
            View::EVENT_BEGIN_BODY,
            function () {
                if (!\Craft::$app->getRequest()->getIsCpRequest()) {
                    \Craft::$app->getView()->registerAssetBundle(ScrolltopAsset::class);
                    
                    // Inject settings into JavaScript
                    $settings = $this->getSettings();
                    $js = "window.scrolltopSettings = " . json_encode([
                        'enabled' => (bool)$settings->enabled,
                        'buttonText' => $settings->buttonText,
                        'buttonColor' => '#' . ltrim($settings->buttonColor, '#'),
                        'buttonHoverColor' => '#' . ltrim($settings->buttonHoverColor, '#'),
                        'textColor' => '#' . ltrim($settings->textColor, '#'),
                        'buttonSize' => (int)$settings->buttonSize,
                        'opacity' => (float)$settings->opacity,
                        'hoverOpacity' => (float)$settings->hoverOpacity,
                        'borderRadius' => $settings->borderRadius,
                        'boxShadow' => $settings->boxShadow,
                        'zIndex' => (int)$settings->zIndex,
                        'position' => $settings->position,
                        'bottomDistance' => (int)$settings->bottomDistance,
                        'rightDistance' => (int)$settings->rightDistance,
                        'scrollThreshold' => (int)$settings->scrollThreshold,
                        'enableAnimation' => (bool)$settings->enableAnimation,
                        'animationSpeed' => $settings->animationSpeed,
                        'iconType' => $settings->iconType,
                        'customSvg' => $settings->customSvg,
                    ]) . ";";
                    
                    \Craft::$app->getView()->registerJs($js, View::POS_HEAD);
                }
            }
        );
    }

    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    protected function settingsHtml(): string
    {
        return \Craft::$app->getView()->renderTemplate(
            'scrolltop/settings',
            ['settings' => $this->getSettings()]
        );
    }

    public function getCpNavItem(): ?array
    {
        $nav = parent::getCpNavItem();
        $nav['label'] = 'Scroll to Top';
        $nav['url'] = 'scrolltop';
        return $nav;
    }
} 