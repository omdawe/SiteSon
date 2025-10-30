<?php
// Get the requested path
 $requestUri = $_SERVER['REQUEST_URI'];
 $path = parse_url($requestUri, PHP_URL_PATH);

// Handle root path explicitly
if ($path === '/' || $path === '') {
    $path = '/';
} else {
    // Remove trailing slash for other paths
    $path = rtrim($path, '/');
    
    // Get special path handling from config
    $specialPaths = $siteConfig['settings']['specialPaths'] ?? [];
    $handled = false;
    
    foreach ($specialPaths as $basePath => $config) {
        if (strpos($path, $basePath) === 0) {
            if ($config['allowTrailingSlash'] ?? false) {
                // Keep the path as is for these pages
                $handled = true;
            } else {
                // For these pages, ensure no trailing slash
                $path = rtrim($path, '/');
            }
            break;
        }
    }
    
    if (!$handled) {
        // For non-special pages, ensure no trailing slash
        $path = rtrim($path, '/');
    }
}

// Load the site configuration
 $jsonFile = __DIR__ . '/admin/site.json';
if (!file_exists($jsonFile)) {
    http_response_code(500);
    die("Site configuration not found");
}

 $siteConfig = json_decode(file_get_contents($jsonFile), true);
if ($siteConfig === null) {
    http_response_code(500);
    die("Error parsing site configuration");
}

// Check if the page exists
 $pageConfig = isset($siteConfig['pages'][$path]) ? $siteConfig['pages'][$path] : null;

// Handle page not found with configurable logic
if ($pageConfig === null) {
    $pageNotFoundConfig = $siteConfig['settings']['pageNotFound'] ?? [];
    
    // Check for dynamic page handling
    if (!empty($pageNotFoundConfig['dynamicPages'])) {
        foreach ($pageNotFoundConfig['dynamicPages'] as $pattern => $handler) {
            if (preg_match($pattern, $path)) {
                // Apply dynamic page configuration
                if (isset($handler['transform'])) {
                    $newPath = preg_replace($pattern, $handler['transform'], $path);
                    if (isset($siteConfig['pages'][$newPath])) {
                        $pageConfig = $siteConfig['pages'][$newPath];
                        break;
                    }
                }
            }
        }
    }
    
    // If still not found, use the 404 page
    if ($pageConfig === null) {
        $pageConfig = $siteConfig['404'] ?? null;
        http_response_code(404);
    }
}

// Execute PHP Code (executed before page content) if it exists
if (isset($pageConfig['phpCode']) && !empty($pageConfig['phpCode'])) {
    // Capture any output and discard it
    ob_start();
    eval('?>' . $pageConfig['phpCode']);
    ob_end_clean();
}

// Function to process template with PHP execution
function processTemplate($templateContent, $siteConfig) {
    ob_start();
    try {
        eval('?>' . $templateContent);
        return ob_get_clean();
    } catch (ParseError $e) {
        // If there's a PHP syntax error, return the original content
        ob_end_clean();
        return $templateContent;
    } catch (Error $e) {
        // If there's any other PHP error, return the original content
        ob_end_clean();
        return $templateContent;
    }
}

// Generate menu HTML with configurable classes
 $menuItemsHtml = '';
 $menuConfig = $siteConfig['menus']['main'] ?? [];
 $menuActiveClass = $siteConfig['settings']['menuActiveClass'] ?? ' active';
 $menuBaseClasses = $siteConfig['settings']['menuBaseClasses'] ?? 'nav-item';
 $menuLinkClasses = $siteConfig['settings']['menuLinkClasses'] ?? 'nav-link';

foreach ($menuConfig as $menuItem) {
    $activeClass = ($menuItem['url'] === $path) ? $menuActiveClass : '';
    $menuItemsHtml .= '<li class="' . htmlspecialchars($menuBaseClasses) . '"><a class="' . htmlspecialchars($menuLinkClasses) . $activeClass . '" href="' . htmlspecialchars($menuItem['url']) . '">' . htmlspecialchars($menuItem['text']) . '</a></li>';
}

// Process menu template with PHP execution
 $menuTemplate = processTemplate($siteConfig['templates']['menu'], $siteConfig);
 $menuHtml = str_replace('{menuItems}', $menuItemsHtml, $menuTemplate);
 $menuHtml = str_replace('{siteName}', htmlspecialchars($siteConfig['site']['name']), $menuHtml);

// Process header template with PHP execution
 $headerTemplate = processTemplate($siteConfig['templates']['header'], $siteConfig);
 $headerHtml = str_replace('{logo}', htmlspecialchars($siteConfig['site']['logo']), $headerTemplate);
 $headerHtml = str_replace('{siteName}', htmlspecialchars($siteConfig['site']['name']), $headerHtml);

// Process footer template with PHP execution
 $footerTemplate = processTemplate($siteConfig['templates']['footer'], $siteConfig);
 $footerHtml = str_replace('{year}', date('Y'), $footerTemplate);
 $footerHtml = str_replace('{siteName}', htmlspecialchars($siteConfig['site']['name']), $footerHtml);

// Prepare WhatsApp button if active
 $whatsappButton = '';
if (isset($siteConfig['settings']['whatsapp']['active']) && $siteConfig['settings']['whatsapp']['active']) {
    $whatsappTemplate = processTemplate($siteConfig['templates']['whatsappButton'], $siteConfig);
    $whatsappButton = str_replace('{whatsappNumber}', $siteConfig['settings']['whatsapp']['number'], $whatsappTemplate);
}

// Prepare Open Graph tags with configurable defaults
 $ogConfig = $siteConfig['settings']['openGraph'] ?? [];
 $ogTags = '';
 $ogTitle = $pageConfig['title'] . ' - ' . $siteConfig['site']['name'];
 $ogDescription = $pageConfig['meta']['description'] ?: ($siteConfig['site']['meta']['description'] ?? '');
 $ogImage = $pageConfig['meta']['image'] ?? ($ogConfig['defaultImage'] ?? '/images/og-default.jpg');
 $ogUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

 $ogTags .= '<meta property="og:title" content="' . htmlspecialchars($ogTitle) . '">' . "\n";
 $ogTags .= '<meta property="og:description" content="' . htmlspecialchars($ogDescription) . '">' . "\n";
 $ogTags .= '<meta property="og:type" content="website">' . "\n";
 $ogTags .= '<meta property="og:locale" content="' . htmlspecialchars($ogConfig['locale'] ?? 'en_GB') . '">' . "\n";
 $ogTags .= '<meta property="og:url" content="' . htmlspecialchars($ogUrl) . '">' . "\n";
 $ogTags .= '<meta property="og:image" content="' . htmlspecialchars($ogImage) . '">' . "\n";
 $ogTags .= '<meta property="og:image:secure_url" content="' . htmlspecialchars($ogImage) . '">' . "\n";
 $ogTags .= '<meta property="og:image:type" content="' . htmlspecialchars($ogConfig['imageType'] ?? 'image/jpeg') . '">' . "\n";
 $ogTags .= '<meta property="og:image:height" content="' . htmlspecialchars($ogConfig['imageHeight'] ?? 550) . '">' . "\n";
 $ogTags .= '<meta property="og:image:width" content="' . htmlspecialchars($ogConfig['imageWidth'] ?? 550) . '">' . "\n";
 $ogTags .= '<meta property="og:image:alt" content="' . htmlspecialchars($ogTitle) . '">' . "\n";

// Add JSON-LD structured data
 $ogTags .= '<script type="application/ld+json">' . "\n";
 $ogTags .= '{' . "\n";
 $ogTags .= '"@context": "http://schema.org",' . "\n";
 $ogTags .= '"@type": "WebPage",' . "\n";
 $ogTags .= '"name": "' . htmlspecialchars($ogTitle) . '",' . "\n";
 $ogTags .= '"description": "' . htmlspecialchars($ogDescription) . '",' . "\n";
 $ogTags .= '"url": "' . htmlspecialchars($ogUrl) . '",' . "\n";
 $ogTags .= '"image": "' . htmlspecialchars($ogImage) . '"' . "\n";
 $ogTags .= '}' . "\n";
 $ogTags .= '</script>' . "\n";

// Prepare JavaScript - use template exactly as defined in site.json
 $templateJs = $siteConfig['templates']['javascript'] ?? '';
 $customJs = isset($pageConfig['customJs']) ? $pageConfig['customJs'] : '';

 $placeholders = [
    '{title}' => htmlspecialchars($pageConfig['title']),
    '{siteName}' => htmlspecialchars($siteConfig['site']['name']),
    '{metaDescription}' => htmlspecialchars($pageConfig['meta']['description'] ?? $siteConfig['site']['meta']['description']),
    '{metaKeywords}' => htmlspecialchars($pageConfig['meta']['keywords'] ?? $siteConfig['site']['meta']['keywords']),
    '{favicon}' => htmlspecialchars($siteConfig['site']['favicon']),
    '{header}' => $headerHtml,
    '{menu}' => $menuHtml,
    '{footer}' => $footerHtml,
    '{whatsappButton}' => $whatsappButton,
    '{css}' => $siteConfig['templates']['css'] . (isset($pageConfig['customCss']) ? $pageConfig['customCss'] : ''),
    '{javascript}' => $templateJs, // Only template JavaScript (with jQuery if needed)
    '{headExtras}' => $ogTags . (isset($pageConfig['customHead']) ? $pageConfig['customHead'] : '')
];

// Get the main template
 $template = $siteConfig['templates']['main'];

// Replace placeholders in the template
 $html = $template;
foreach ($placeholders as $placeholder => $value) {
    $html = str_replace($placeholder, $value, $html);
}

// Process custom JavaScript with PHP execution (like page content)
 $customJsScript = '';
if (!empty($customJs)) {
    // Process the custom JavaScript as PHP code first
    ob_start();
    try {
        eval('?>' . $customJs);
        $customJsContent = ob_get_clean();
    } catch (ParseError $e) {
        // If there's a PHP syntax error, use the original content
        ob_end_clean();
        $customJsContent = $customJs;
    } catch (Error $e) {
        // If there's any other PHP error, use the original content
        ob_end_clean();
        $customJsContent = $customJs;
    }
    
    // Clean up the custom JavaScript to remove any existing script tags
    $customJsClean = trim($customJsContent);
    
    // Remove any existing <script> tags from the beginning
    if (strpos($customJsClean, '<script>') === 0) {
        $customJsClean = substr($customJsClean, 8);
    }
    if (strpos($customJsClean, '<script type="text/javascript">') === 0) {
        $customJsClean = substr($customJsClean, 31);
    }
    
    // Remove any existing </script> tags from the end
    if (substr($customJsClean, -9) === '</script>') {
        $customJsClean = substr($customJsClean, 0, -9);
    }
    
    // Wrap in proper script tags
    $customJsScript = "\n<script>\n" . trim($customJsClean) . "\n</script>\n";
}

// Add custom JavaScript at the end of the body
if (!empty($customJsScript)) {
    $html = str_replace('</body>', $customJsScript . '</body>', $html);
}

// Extract content placeholder
 $contentPlaceholder = '{content}';
 $contentPos = strpos($html, $contentPlaceholder);

if ($contentPos !== false) {
    // Split HTML at content placeholder
    $htmlBefore = substr($html, 0, $contentPos);
    $htmlAfter = substr($html, $contentPos + strlen($contentPlaceholder));
    
    // Output HTML before content
    echo $htmlBefore;
    
    // Determine if we should evaluate the content or just output it
    $is404Page = ($pageConfig === $siteConfig['404']);

    if ($is404Page) {
        // For the 404 page, the content is just plain HTML, so echo it directly.
        echo $pageConfig['content'];
    } else {
        // For regular pages that might contain PHP code, use eval.
        eval('?>' . $pageConfig['content']);
    }
    
    // Output HTML after content
    echo $htmlAfter;
} else {
    // If no content placeholder, just replace it in the HTML
    $html = str_replace($contentPlaceholder, $pageConfig['content'], $html);
    echo $html;
}
?>
