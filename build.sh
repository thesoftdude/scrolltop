#!/bin/bash

# Build script for Scrolltop Plugin
echo "Building Scrolltop Plugin..."

# Get version from composer.json
VERSION=$(grep '"version"' composer.json | cut -d'"' -f4)
PLUGIN_NAME="scrolltop"
BUILD_DIR="build"
DIST_DIR="dist"

# Clean previous builds
rm -rf $BUILD_DIR $DIST_DIR
mkdir -p $BUILD_DIR $DIST_DIR

# Copy source files
echo "Copying source files..."
cp -r src/ $BUILD_DIR/
# Remove source files from build (keep only minified)
rm -rf $BUILD_DIR/assets/src/
cp composer.json $BUILD_DIR/
cp README.md $BUILD_DIR/
cp LICENSE $BUILD_DIR/ 2>/dev/null || echo "No LICENSE file found"

# Create zip file
echo "Creating distribution package..."
cd $BUILD_DIR
zip -r ../$DIST_DIR/${PLUGIN_NAME}-v${VERSION}.zip . -x "*.DS_Store" "*/.*"
cd ..

# Create tar.gz file
echo "Creating tar.gz package..."
cd $BUILD_DIR
tar -czf ../$DIST_DIR/${PLUGIN_NAME}-v${VERSION}.tar.gz --exclude="*.DS_Store" --exclude="*/.*" .
cd ..

# Clean up
rm -rf $BUILD_DIR

echo "Build complete!"
echo "Packages created:"
echo "  - $DIST_DIR/${PLUGIN_NAME}-v${VERSION}.zip"
echo "  - $DIST_DIR/${PLUGIN_NAME}-v${VERSION}.tar.gz"
echo ""
echo "File sizes:"
if [ -d "$DIST_DIR" ]; then
    ls -lh $DIST_DIR/
else
    echo "No distribution files created"
fi 