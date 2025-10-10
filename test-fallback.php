<?php
/**
 * Test script to verify fallback implementation
 * This simulates the WordPress functions used in functions.php
 */

// Simulate WordPress functions
function get_template_directory() {
    return '/Users/alexandremachado/Local Sites/finance-theme';
}

function get_template_directory_uri() {
    return 'http://localhost/finance-theme';
}

// Test the fallback logic
$built_css = get_template_directory() . '/dist/main.css';
$fallback_css = get_template_directory() . '/assets/fallback.css';
$built_js = get_template_directory() . '/dist/main.js';
$fallback_js = get_template_directory() . '/assets/fallback.js';

echo "=== Fallback System Test ===\n\n";

echo "Built CSS exists: " . (file_exists($built_css) ? 'YES' : 'NO') . "\n";
echo "Fallback CSS exists: " . (file_exists($fallback_css) ? 'YES' : 'NO') . "\n";
echo "Built JS exists: " . (file_exists($built_js) ? 'YES' : 'NO') . "\n";
echo "Fallback JS exists: " . (file_exists($fallback_js) ? 'YES' : 'NO') . "\n\n";

echo "=== Asset Loading Logic ===\n\n";

// CSS Logic
if (file_exists($built_css)) {
    echo "CSS: Would load built file - /dist/main.css\n";
} elseif (file_exists($fallback_css)) {
    echo "CSS: Would load fallback file - /assets/fallback.css ✓\n";
} else {
    echo "CSS: No CSS files found! ❌\n";
}

// JS Logic
if (file_exists($built_js)) {
    echo "JS: Would load built file - /dist/main.js\n";
} elseif (file_exists($fallback_js)) {
    echo "JS: Would load fallback file - /assets/fallback.js ✓\n";
} else {
    echo "JS: No JS files found! ❌\n";
}

echo "\n=== File Sizes ===\n\n";
echo "Fallback CSS: " . number_format(filesize($fallback_css)) . " bytes\n";
echo "Fallback JS: " . number_format(filesize($fallback_js)) . " bytes\n";

echo "\n=== Test Complete ===\n";