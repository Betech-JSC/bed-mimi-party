#!/usr/bin/env node

const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

// Check if PHP is available
function checkPHP() {
    try {
        execSync('php --version', { stdio: 'ignore' });
        return true;
    } catch (error) {
        return false;
    }
}

// Check if required files exist
function checkRequiredFiles() {
    const ziggyFile = path.join(__dirname, '../public/build/ziggy.frontend.js');
    const i18nFile = path.join(__dirname, '../public/build/locales/i18n.js');
    
    return {
        ziggy: fs.existsSync(ziggyFile),
        i18n: fs.existsSync(i18nFile)
    };
}

// Create minimal fallback files if they don't exist
function createFallbackFiles() {
    const buildDir = path.join(__dirname, '../public/build');
    const localesDir = path.join(buildDir, 'locales');
    
    // Create directories if they don't exist
    if (!fs.existsSync(buildDir)) {
        fs.mkdirSync(buildDir, { recursive: true });
    }
    if (!fs.existsSync(localesDir)) {
        fs.mkdirSync(localesDir, { recursive: true });
    }
    
    const ziggyFile = path.join(buildDir, 'ziggy.frontend.js');
    const i18nFile = path.join(localesDir, 'i18n.js');
    
    // Create minimal ziggy file if it doesn't exist
    if (!fs.existsSync(ziggyFile)) {
        const minimalZiggy = `const Ziggy = {"url":"","port":null,"defaults":{},"routes":{}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
`;
        fs.writeFileSync(ziggyFile, minimalZiggy);
        console.log('⚠️  Created minimal ziggy.frontend.js file');
    }
    
    // Create minimal i18n file if it doesn't exist
    if (!fs.existsSync(i18nFile)) {
        const minimalI18n = `export default {};
`;
        fs.writeFileSync(i18nFile, minimalI18n);
        console.log('⚠️  Created minimal i18n.js file');
    }
    
    console.log('⚠️  WARNING: These are minimal fallback files. For production, generate them locally with:');
    console.log('   php artisan vue-i18n:generate');
    console.log('   php artisan ziggy:generate public/build/ziggy.frontend.js --group=frontend');
    console.log('   Then commit them to your repository.');
}

// Main execution
const hasPHP = checkPHP();
const files = checkRequiredFiles();

if (hasPHP) {
    console.log('✓ PHP found, generating routes and i18n files...');
    try {
        execSync('php artisan vue-i18n:generate', { stdio: 'inherit' });
        execSync('php artisan ziggy:generate public/build/ziggy.frontend.js --group=frontend', { stdio: 'inherit' });
        console.log('✓ Routes and i18n files generated successfully');
    } catch (error) {
        console.error('✗ Error generating files with PHP:', error.message);
        process.exit(1);
    }
} else {
    console.log('⚠️  PHP not found, skipping route and i18n generation');
    
    if (!files.ziggy || !files.i18n) {
        console.log('⚠️  Required files missing, creating minimal fallback files...');
        createFallbackFiles();
        console.log('⚠️  Note: You should generate these files locally with PHP and commit them, or ensure they exist before deployment');
    } else {
        console.log('✓ Required files already exist, skipping generation');
    }
}

