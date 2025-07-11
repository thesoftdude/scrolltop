# Scrolltop Plugin for Craft CMS 5

A lightweight Craft CMS 5 plugin that adds a customizable scroll-to-top button to your site.

## Features

- Adds a customizable scroll-to-top button to your frontend
- Control Panel settings for easy customization
- Smooth scrolls the page to the top
- Lightweight: only **2.4 KB** minified
- Enable/disable toggle
- Customizable position, colors, size, and animation

## Installation

1. Place the `scrolltop` folder in your project's root directory (same level as your Craft installation)
2. Add the plugin to your Craft site's `composer.json` by adding this repository:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./scrolltop"
        }
    ]
}
```

3. Install the plugin via Composer:

```bash
composer require softdude/scrolltop
```

4. Install the plugin in Craft's Control Panel or via command line:

```bash
./craft plugin/install scrolltop
```

## Usage

Once installed and enabled, the plugin will automatically add a scroll-to-top button to your site's frontend. The button will appear after scrolling down and will smoothly scroll the page to the top when clicked.

## Customization

All customization is done through the Craft Control Panel:

1. Go to **Scroll to Top** in your Control Panel
2. Configure the button settings:
   - **Enable/Disable**: Turn the button on or off
   - **Position**: Choose from bottom-right, bottom-left, top-right, top-left
   - **Colors**: Customize button color, hover color, and text color
   - **Size**: Adjust button size (default: 48px)
   - **Icon**: Choose from various icon types or use custom SVG
   - **Animation**: Enable/disable smooth scrolling and adjust speed
   - **Threshold**: Set scroll distance before button appears

## File Structure

```
scrolltop/
├── src/
│   ├── assets/              # Asset files
│   │   ├── dist/
│   │   │   └── scrolltop.min.js  # Combined CSS & JS (2.4 KB)
│   │   └── ScrolltopAsset.php
│   ├── controllers/
│   ├── Models/
│   ├── templates/
│   └── Scrolltop.php
├── composer.json
└── README.md
```

## Development & Building

### Local Development
```bash
# Install Node.js dependencies
npm install

# Build the plugin
npm run build

# Watch for changes and auto-build
npm run watch
```

### Building for Distribution
```bash
# Using the build script
./build.sh

# Or using npm
npm run build
```

This will create distribution packages in the `dist/` folder:
- `scrolltop-v0.1.0.zip`
- `scrolltop-v0.1.0.tar.gz`

### Automated Builds
This plugin uses GitHub Actions for automated builds. When you push a tag (e.g., `v0.1.0`), it will automatically:
1. Build the plugin
2. Create a GitHub release
3. Upload distribution packages

## Support

For issues or questions, please refer to the Craft CMS documentation or create an issue in the plugin repository. 