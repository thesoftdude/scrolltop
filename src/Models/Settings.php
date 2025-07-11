<?php

namespace softdude\scrolltop\Models;

use craft\base\Model;

class Settings extends Model
{
    // Enable/disable
    public bool $enabled = true;
    
    // Button appearance
    public string $buttonText = '↑';
    public string $buttonColor = '#222222';
    public string $buttonHoverColor = '#444444';
    public string $textColor = '#ffffff';
    public int $buttonSize = 48;
    public float $opacity = 0.7;
    public float $hoverOpacity = 1.0;
    public string $borderRadius = '50%';
    public string $boxShadow = '0 2px 8px rgba(0,0,0,0.2)';
    public int $zIndex = 9999;
    
    // Position and spacing
    public string $position = 'bottom-right';
    public int $bottomDistance = 30;
    public int $rightDistance = 30;
    
    // Behavior
    public int $scrollThreshold = 200;
    public bool $enableAnimation = true;
    public string $animationSpeed = 'smooth';
    
    // Icon options
    public string $iconType = 'arrow';
    public string $customSvg = '';

    public function rules(): array
    {
        return [
            [['enabled', 'enableAnimation'], 'boolean'],
            [['buttonText', 'buttonColor', 'buttonHoverColor', 'textColor', 'position', 'animationSpeed', 'iconType', 'customSvg', 'borderRadius', 'boxShadow'], 'string'],
            [['buttonSize', 'bottomDistance', 'rightDistance', 'scrollThreshold', 'zIndex'], 'integer'],
            [['opacity', 'hoverOpacity'], 'number', 'min' => 0.1, 'max' => 1.0],
            [['buttonSize'], 'integer', 'min' => 20, 'max' => 100],
            [['scrollThreshold'], 'integer', 'min' => 50, 'max' => 1000],
            [['bottomDistance', 'rightDistance'], 'integer', 'min' => 10, 'max' => 100],
            [['zIndex'], 'integer', 'min' => 1, 'max' => 99999],
            [['position'], 'in', 'range' => ['bottom-right', 'bottom-left', 'top-right', 'top-left']],
            [['animationSpeed'], 'in', 'range' => ['smooth', 'fast', 'slow']],
            [['iconType'], 'in', 'range' => ['arrow', 'chevron', 'doubleArrow', 'triangle', 'caret', 'arrowUp', 'chevronUp', 'home', 'top', 'custom', 'text']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'enabled' => 'Enable Scroll-to-Top Button',
            'buttonText' => 'Button Text',
            'buttonColor' => 'Button Color',
            'buttonHoverColor' => 'Button Hover Color',
            'textColor' => 'Text/Icon Color',
            'buttonSize' => 'Button Size (px)',
            'opacity' => 'Button Opacity',
            'hoverOpacity' => 'Hover Opacity',
            'borderRadius' => 'Border Radius',
            'boxShadow' => 'Box Shadow',
            'zIndex' => 'Z-Index',
            'position' => 'Position',
            'bottomDistance' => 'Bottom Distance (px)',
            'rightDistance' => 'Right Distance (px)',
            'scrollThreshold' => 'Scroll Threshold (px)',
            'enableAnimation' => 'Enable Animation',
            'animationSpeed' => 'Animation Speed',
            'iconType' => 'Icon Type',
            'customSvg' => 'Custom SVG',
        ];
    }
} 