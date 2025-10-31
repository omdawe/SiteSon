<?php
// Get the correct path to site.json
 $jsonFile = __DIR__ . '/site.json';

// If file does not exist, create a new one with default structure
if (!file_exists($jsonFile)) {
    $defaultConfig = [
        'site' => [
            'name' => 'My Website',
            'logo' => '/images/logo.png',
            'favicon' => '/favicon.ico',
            'meta' => [
                'description' => 'Default website description.',
                'keywords' => 'default, keywords'
            ]
        ],
        'pages' => [
            '/' => [
                'title' => 'Home',
                'content' => '<h1>Welcome to Our Website</h1><p>This is the home page content. Customize this text to match your needs.</p>',
                'meta' => [
                    'description' => 'Welcome to our website',
                    'keywords' => 'home, main, welcome'
                ],
                'phpCode' => '',
                'customCss' => '',
                'customJs' => ''
            ],
            '/about' => [
                'title' => 'About Us',
                'content' => '<h1>About Us</h1><p>Learn more about our company and what we do.</p>',
                'meta' => [
                    'description' => 'Learn about our company',
                    'keywords' => 'about, company, information'
                ],
                'phpCode' => '',
                'customCss' => '',
                'customJs' => ''
            ],
            '/contact' => [
                'title' => 'Contact Us',
                'content' => '<h1>Contact Us</h1><p>Get in touch with us through our contact form.</p>',
                'meta' => [
                    'description' => 'Contact us for more information',
                    'keywords' => 'contact, email, phone'
                ],
                'phpCode' => '',
                'customCss' => '',
                'customJs' => ''
            ]
        ],
        'templates' => [
            'main' => '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{title} - {siteName}</title>

    <!-- Meta Tags -->
    <meta name="description" content="{metaDescription}">
    <meta name="keywords" content="{metaKeywords}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{favicon}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {headExtras}

    <style>
        {css}
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    
    <!-- Header -->
    <header>
        {header}
    </header>

    <!-- Navigation -->
    <nav>
        {menu}
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            {content}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        {footer}
    </footer>

    <!-- WhatsApp Button (floating) -->
    {whatsappButton}

    <!-- Bootstrap 5 JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        {javascript}
    </script>

</body>
</html>',
            'header' => '<!-- Header -->
<header class="py-3 border-bottom bg-white">
    <div class="container d-flex flex-wrap justify-content-center justify-content-md-between align-items-center">
        <!-- Logo -->
        <a href="/" class="d-flex align-items-center mb-2 mb-md-0 text-decoration-none">
            <img src="{logo}" alt="{siteName}" class="img-fluid" style="max-height: 60px;">
        </a>
    </div>
</header>',
            'menu' => '<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand d-lg-none" href="/">{siteName}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0">
                {menuItems}
            </ul>
        </div>
    </div>
</nav>',
            'footer' => '<!-- Footer -->
<footer class="bg-light text-center text-lg-start mt-4">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">About Us</h5>
        <p>
          We are a company dedicated to providing excellent products and services to our customers.
        </p>
        <p>Business Hours: 9:00 - 17:00 Mon - Fri</p>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="/" class="text-decoration-none">Home</a></li>
          <li><a href="/about" class="text-decoration-none">About</a></li>
          <li><a href="/contact" class="text-decoration-none">Contact</a></li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">Contact Us</h5>
        <p>
          Email: <a href="mailto:info@example.com">info@example.com</a><br>
          Phone: +1 (555) 123-4567
        </p>
        <div class="d-flex justify-content-center mb-3">
          <a href="#" class="me-4 text-reset">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="me-4 text-reset">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="me-4 text-reset">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    &copy; {year} {siteName}. All Rights Reserved.
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->',
            'whatsappButton' => '<!-- WhatsApp Floating Chat Button -->
<div class="position-fixed bottom-0 end-0 p-4" style="z-index:1050;">
  <a href="https://wa.me/{whatsappNumber}" target="_blank"
     class="d-flex align-items-center justify-content-center text-white"
     style="
       width:65px;
       height:65px;
       background-color:#25D366;
       border-radius:50%;
       box-shadow:0 4px 10px rgba(0,0,0,0.3);
       text-decoration:none;
       position:relative;
       transition:transform 0.2s ease-in-out;
     "
     title="Chat on WhatsApp"
     onmouseover="this.style.transform=\'scale(1.1)\';"
     onmouseout="this.style.transform=\'scale(1)\';">
      <img src="/images/whatsapp-icon.png" alt="WhatsApp"
           style="width:32px;height:32px;filter:brightness(0) invert(1);">
      <!-- Optional small notification bubble -->
      <span style="
        position:absolute;
        top:10px;
        right:10px;
        width:10px;
        height:10px;
        background-color:#fff;
        border-radius:50%;
        border:2px solid #25D366;
      "></span>
  </a>
</div>',
            'css' => '',
            'javascript' => '',
            'headExtras' => ''
        ],
        'menus' => [
            'main' => [
                ['text' => 'Home', 'url' => '/'],
                ['text' => 'About', 'url' => '/about'],
                ['text' => 'Contact', 'url' => '/contact']
            ]
        ],
        'settings' => [
            'whatsapp' => [
                'number' => '',
                'active' => false
            ]
        ]
    ];

    file_put_contents($jsonFile, json_encode($defaultConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

// Load and decode JSON
$siteConfig = json_decode(file_get_contents($jsonFile), true);

// Check if JSON was parsed correctly
if ($siteConfig === null) {
    die("Error parsing site.json: " . json_last_error_msg());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'save_page':
                $path = $_POST['path'];
                $oldPath = $_POST['old_path'] ?? $path;
                
                // If path changed, remove old entry
                if ($oldPath !== $path && isset($siteConfig['pages'][$oldPath])) {
                    unset($siteConfig['pages'][$oldPath]);
                }
                
                // Update or add page
                $siteConfig['pages'][$path] = [
                    'title' => $_POST['title'],
                    'content' => $_POST['content'],
                    'meta' => [
                        'description' => $_POST['meta_description'],
                        'keywords' => $_POST['meta_keywords']
                    ],
                    'phpCode' => $_POST['php_code'],
                    'customCss' => $_POST['custom_css'],
                    'customJs' => $_POST['custom_js']
                ];
                
                // Set the current page to the newly saved page
                $_GET['page'] = $path;
                break;
                
            case 'delete_page':
                $path = $_POST['path'];
                if (isset($siteConfig['pages'][$path])) {
                    unset($siteConfig['pages'][$path]);
                }
                break;
                
            case 'save_template':
                $templateName = $_POST['template_name'];
                $siteConfig['templates'][$templateName] = $_POST['template_content'];
                break;
                
            case 'save_site':
                $siteConfig['site']['name'] = $_POST['site_name'];
                $siteConfig['site']['logo'] = $_POST['site_logo'];
                $siteConfig['site']['favicon'] = $_POST['site_favicon'];
                $siteConfig['site']['meta']['description'] = $_POST['site_meta_description'];
                $siteConfig['site']['meta']['keywords'] = $_POST['site_meta_keywords'];
                break;
                
            case 'save_menu':
                // Simplified menu saving without submenus
                $menuItems = json_decode($_POST['menu_items'], true);
                if (is_array($menuItems)) {
                    // Create a simple flat menu structure
                    $simpleMenu = [];
                    foreach ($menuItems as $item) {
                        if (isset($item['text']) && isset($item['url'])) {
                            $simpleMenu[] = [
                                'text' => $item['text'],
                                'url' => $item['url']
                            ];
                        }
                    }
                    $siteConfig['menus']['main'] = $simpleMenu;
                }
                break;
                
            case 'save_settings':
                $siteConfig['settings']['whatsapp']['number'] = $_POST['whatsapp_number'];
                $siteConfig['settings']['whatsapp']['active'] = isset($_POST['whatsapp_active']) ? true : false;
                break;
        }
        
        // Save the configuration
        file_put_contents($jsonFile, json_encode($siteConfig, JSON_PRETTY_PRINT));
        header('Location: /admin/layout/index-control/');
        exit;
    }
}

// Get current page for editing
 $currentPage = null;
if (isset($_GET['page'])) {
    $pagePath = $_GET['page'];
    if ($pagePath === 'new') {
        $currentPage = [
            'path' => '',
            'title' => '',
            'content' => '',
            'meta' => [
                'description' => '',
                'keywords' => ''
            ],
            'phpCode' => '',
            'customCss' => '',
            'customJs' => ''
        ];
    } else {
        if (isset($siteConfig['pages'][$pagePath])) {
            $currentPage = $siteConfig['pages'][$pagePath];
            $currentPage['path'] = $pagePath; // Add the path to the page data
        }
    }
}

// Get current template for editing
 $currentTemplate = null;
if (isset($_GET['template'])) {
    $templateName = $_GET['template'];
    if (isset($siteConfig['templates'][$templateName])) {
        $currentTemplate = [
            'name' => $templateName,
            'content' => $siteConfig['templates'][$templateName]
        ];
    }
}

// Ensure menus array exists with a simple flat structure
if (!isset($siteConfig['menus']) || !isset($siteConfig['menus']['main'])) {
    // Initialize with default menu if not exists
    $siteConfig['menus']['main'] = [
        ['text' => 'Home', 'url' => '/'],
        ['text' => 'About', 'url' => '/about'],
        ['text' => 'Contact', 'url' => '/contact'],
        ['text' => 'Product', 'url' => '/products'],
        ['text' => 'FAQ', 'url' => '/FAQ/'],
        ['text' => 'products2', 'url' => '/products2/']
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
    <style>
        body { padding: 20px; }
        .sidebar { border-right: 1px solid #ddd; padding-right: 20px; }
        .main-content { padding-left: 20px; }
        .page-list { margin-bottom: 20px; }
        .page-list .page-item { padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .page-list .page-item:last-child { border-bottom: none; }
        .page-list .page-item.active { background-color: #f8f9fa; }
        .template-list { margin-bottom: 20px; }
        .template-list .template-item { padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .template-list .template-item:last-child { border-bottom: none; }
        .editor-wrapper { 
            margin-bottom: 20px; 
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        .editor-toolbar { 
            background-color: #f8f9fa;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .CodeMirror { 
            height: 300px; 
            font-size: 14px;
        }
        .fullscreen-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: white;
            display: none;
            flex-direction: column;
            padding: 0;
        }
        .fullscreen-container.active {
            display: flex;
        }
        .fullscreen-toolbar {
            background-color: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .fullscreen-content {
            flex: 1;
            overflow: auto;
            padding: 0;
        }
        .fullscreen-content .CodeMirror {
            height: 100%;
        }
        .editor-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .menu-item-container {
            margin-bottom: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f8f9fa;
            cursor: move;
        }
        .menu-item-container:hover {
            background-color: #e9ecef;
        }
        .menu-item-container.sortable-ghost {
            opacity: 0.4;
        }
        .menu-item-container.sortable-drag {
            opacity: 0.8;
        }
        .debug-info {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .menu-handle {
            cursor: move;
            margin-right: 10px;
            color: #6c757d;
            font-size: 18px;
        }
        .menu-item-content {
            display: flex;
            align-items: center;
        }
        .menu-controls {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h3>Admin Panel</h3>
                
                <div class="page-list">
                    <h4>Pages</h4>
                    <a href="?page=new" class="btn btn-sm btn-success mb-3">Add New Page</a>
                    <div class="list-group">
                        <?php if (isset($siteConfig['pages']) && is_array($siteConfig['pages'])): ?>
                            <?php foreach ($siteConfig['pages'] as $path => $page): ?>
                                <div class="page-item <?= (isset($_GET['page']) && $_GET['page'] === $path) ? 'active' : '' ?>">
                                    <div>
                                        <strong><?= htmlspecialchars($path) ?></strong>
                                        <div class="text-muted"><?= htmlspecialchars($page['title']) ?></div>
                                    </div>
                                    <div>
                                        <a href="?page=<?= urlencode($path) ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <form method="post" style="display: inline;">
                                            <input type="hidden" name="action" value="delete_page">
                                            <input type="hidden" name="path" value="<?= htmlspecialchars($path) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                No pages found. <a href="?page=new" class="btn btn-sm btn-primary">Add a page</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="template-list">
                    <h4>Templates</h4>
                    <div class="list-group">
                        <a href="?template=main" class="list-group-item list-group-item-action">Main Template</a>
                        <a href="?template=header" class="list-group-item list-group-item-action">Header Template</a>
                        <a href="?template=menu" class="list-group-item list-group-item-action">Menu Template</a>
                        <a href="?template=footer" class="list-group-item list-group-item-action">Footer Template</a>
                        <a href="?template=whatsappButton" class="list-group-item list-group-item-action">WhatsApp Button Template</a>
                        <a href="?template=css" class="list-group-item list-group-item-action">CSS Template</a>
                        <a href="?template=javascript" class="list-group-item list-group-item-action">JavaScript Template</a>
                    </div>
                </div>
                
                <div class="mb-3">
                    <a href="?tab=site" class="btn btn-info w-100">Site Settings</a>
                </div>
                
                <div class="mb-3">
                    <a href="?tab=menu" class="btn btn-info w-100">Edit Menu</a>
                    <a href="?template=menu" class="btn btn-sm btn-secondary w-100 mt-1">Menu Template</a>
                </div>
                
                <div class="mb-3">
                    <a href="?tab=settings" class="btn btn-info w-100">Edit WhatsApp Number</a>
                </div>
            </div>
            
            <div class="col-md-9 main-content">
                <?php if ($currentPage !== null): ?>
                    <!-- Page Editor -->
                    <h2><?= $currentPage['path'] ? 'Edit Page' : 'Add New Page' ?></h2>
                    
                    <form method="post">
                        <input type="hidden" name="action" value="save_page">
                        <input type="hidden" name="old_path" value="<?= htmlspecialchars($currentPage['path']) ?>">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="path" class="form-label">Page URL (Path)</label>
                                <input type="text" class="form-control" id="path" name="path" value="<?= htmlspecialchars($currentPage['path']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label">Page Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($currentPage['title']) ?>" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?= htmlspecialchars($currentPage['meta']['description']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?= htmlspecialchars($currentPage['meta']['keywords']) ?>">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="editor-label">PHP Code (executed before page content)</div>
                            <div class="editor-wrapper">
                                <div class="editor-toolbar">
                                    <button type="button" class="btn btn-sm btn-secondary php-fullscreen-btn">Fullscreen</button>
                                </div>
                                <textarea id="php_code" name="php_code" class="form-control"><?= htmlspecialchars($currentPage['phpCode']) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="editor-label">Page Content (HTML/PHP)</div>
                            <div class="editor-wrapper">
                                <div class="editor-toolbar">
                                    <button type="button" class="btn btn-sm btn-secondary content-fullscreen-btn">Fullscreen</button>
                                </div>
                                <textarea id="content" name="content" class="form-control"><?= htmlspecialchars($currentPage['content']) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="custom_css" class="form-label">Custom CSS</label>
                                <div class="editor-wrapper">
                                    <textarea id="custom_css" name="custom_css" class="form-control"><?= htmlspecialchars($currentPage['customCss']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="custom_js" class="form-label">Custom JavaScript</label>
                                <div class="editor-wrapper">
                                    <textarea id="custom_js" name="custom_js" class="form-control"><?= htmlspecialchars($currentPage['customJs']) ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Page</button>
                            <?php if ($currentPage['path']): ?>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Page</button>
                            <?php endif; ?>
                        </div>
                    </form>
                    
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this page? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="action" value="delete_page">
                                        <input type="hidden" name="path" value="<?= htmlspecialchars($currentPage['path']) ?>">
                                        <button type="submit" class="btn btn-danger">Delete Page</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($currentTemplate !== null): ?>
                    <!-- Template Editor -->
                    <h2>Edit Template: <?= htmlspecialchars($currentTemplate['name']) ?></h2>
                    
                    <form method="post">
                        <input type="hidden" name="action" value="save_template">
                        <input type="hidden" name="template_name" value="<?= htmlspecialchars($currentTemplate['name']) ?>">
                        
                        <div class="mb-3">
                            <div class="editor-label">Template Content</div>
                            <div class="editor-wrapper">
                                <div class="editor-toolbar">
                                    <button type="button" class="btn btn-sm btn-secondary template-fullscreen-btn">Fullscreen</button>
                                </div>
                                <textarea id="template_content" name="template_content" class="form-control"><?= htmlspecialchars($currentTemplate['content']) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Template</button>
                        </div>
                    </form>
                    
                <?php elseif (isset($_GET['tab'])): ?>
                    <!-- Tab Content -->
                    <?php if ($_GET['tab'] === 'site'): ?>
                        <!-- Site Settings -->
                        <h2>Site Settings</h2>
                        <form method="post">
                            <input type="hidden" name="action" value="save_site">
                            <div class="mb-3">
                                <label for="site_name" class="form-label">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" value="<?= htmlspecialchars($siteConfig['site']['name']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="site_logo" class="form-label">Logo URL</label>
                                <input type="text" class="form-control" id="site_logo" name="site_logo" value="<?= htmlspecialchars($siteConfig['site']['logo']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="site_favicon" class="form-label">Favicon URL</label>
                                <input type="text" class="form-control" id="site_favicon" name="site_favicon" value="<?= htmlspecialchars($siteConfig['site']['favicon']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="site_meta_description" class="form-label">Meta Description</label>
                                <input type="text" class="form-control" id="site_meta_description" name="site_meta_description" value="<?= htmlspecialchars($siteConfig['site']['meta']['description']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="site_meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="site_meta_keywords" name="site_meta_keywords" value="<?= htmlspecialchars($siteConfig['site']['meta']['keywords']) ?>">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </form>
                        
                    <?php elseif ($_GET['tab'] === 'menu'): ?>
                        <!-- Menu Settings - Simplified Version -->
                        <h2>Edit Menu</h2>
                        <div class="alert alert-info">
                            <strong>Instructions:</strong>
                            <ul>
                                <li>Drag and drop menu items to reorder them</li>
                                <li>Edit the text and URL for each menu item</li>
                                <li>Use the "Remove" button to delete menu items</li>
                            </ul>
                        </div>
                        <form method="post" id="menu-form">
                            <input type="hidden" name="action" value="save_menu">
                            <input type="hidden" id="menu_items" name="menu_items" value="<?= htmlspecialchars(json_encode($siteConfig['menus']['main'])) ?>">
                            
                            <div class="mb-3">
                                <label class="form-label">Menu Items</label>
                                <div id="menu-editor">
                                    <!-- Menu items will be added here by JavaScript -->
                                    <div class="alert alert-info">Loading menu items...</div>
                                </div>
                                <button type="button" id="add-menu-item" class="btn btn-sm btn-success mt-2">Add Menu Item</button>
                            </div>
                            
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save Menu</button>
                            </div>
                        </form>
                        
                    <?php elseif ($_GET['tab'] === 'settings'): ?>
                        <!-- Other Settings -->
                        <h2>Edit WhatsApp Number</h2>
                        <form method="post">
                            <input type="hidden" name="action" value="save_settings">
                            
                            <div class="mb-3">
                                <h4>WhatsApp Settings</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="whatsapp_active" name="whatsapp_active" <?= isset($siteConfig['settings']['whatsapp']['active']) && $siteConfig['settings']['whatsapp']['active'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="whatsapp_active">
                                        Enable WhatsApp Button
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                                <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?= htmlspecialchars($siteConfig['settings']['whatsapp']['number']) ?>">
                            </div>
                            
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </form>
                    <?php endif; ?>
                    
                <?php else: ?>
                    <!-- Dashboard -->
                    <h2>Admin Dashboard</h2>
                    <p>Select a page to edit or choose a settings tab from the sidebar.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Fullscreen containers -->
    <div id="php-fullscreen" class="fullscreen-container">
        <div class="fullscreen-toolbar">
            <h4>PHP Code Editor</h4>
            <button type="button" class="btn btn-sm btn-secondary exit-fullscreen-btn">Exit Fullscreen</button>
        </div>
        <div class="fullscreen-content">
            <div id="php-fullscreen-editor"></div>
        </div>
    </div>

    <div id="content-fullscreen" class="fullscreen-container">
        <div class="fullscreen-toolbar">
            <h4>Content Editor</h4>
            <button type="button" class="btn btn-sm btn-secondary exit-fullscreen-btn">Exit Fullscreen</button>
        </div>
        <div class="fullscreen-content">
            <div id="content-fullscreen-editor"></div>
        </div>
    </div>

    <div id="template-fullscreen" class="fullscreen-container">
        <div class="fullscreen-toolbar">
            <h4>Template Editor</h4>
            <button type="button" class="btn btn-sm btn-secondary exit-fullscreen-btn">Exit Fullscreen</button>
        </div>
        <div class="fullscreen-content">
            <div id="template-fullscreen-editor"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/edit/closebrackets.min.js"></script>
    <!-- SortableJS for drag and drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize CodeMirror editors
            var editors = {};
            
            // PHP Code Editor
            if (document.getElementById('php_code')) {
                editors.php = CodeMirror.fromTextArea(document.getElementById('php_code'), {
                    mode: 'htmlmixed',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 4,
                    indentWithTabs: false,
                    lineWrapping: true
                });
                
                setTimeout(function() {
                    editors.php.refresh();
                }, 100);
            }
            
            // Content Editor
            if (document.getElementById('content')) {
                editors.content = CodeMirror.fromTextArea(document.getElementById('content'), {
                    mode: 'htmlmixed',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 4,
                    indentWithTabs: false,
                    lineWrapping: true
                });
                
                setTimeout(function() {
                    editors.content.refresh();
                }, 100);
            }
            
            // Template Editor
            if (document.getElementById('template_content')) {
                editors.template = CodeMirror.fromTextArea(document.getElementById('template_content'), {
                    mode: 'htmlmixed',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 4,
                    indentWithTabs: false,
                    lineWrapping: true
                });
                
                setTimeout(function() {
                    editors.template.refresh();
                }, 100);
            }
            
            // Custom CSS Editor
            if (document.getElementById('custom_css')) {
                editors.css = CodeMirror.fromTextArea(document.getElementById('custom_css'), {
                    mode: 'css',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 4,
                    indentWithTabs: false,
                    lineWrapping: true
                });
                
                setTimeout(function() {
                    editors.css.refresh();
                }, 100);
            }
            
            // Custom JS Editor
            if (document.getElementById('custom_js')) {
                editors.js = CodeMirror.fromTextArea(document.getElementById('custom_js'), {
                    mode: 'javascript',
                    theme: 'monokai',
                    lineNumbers: true,
                    autoCloseBrackets: true,
                    matchBrackets: true,
                    indentUnit: 4,
                    indentWithTabs: false,
                    lineWrapping: true
                });
                
                setTimeout(function() {
                    editors.js.refresh();
                }, 100);
            }
            
            // Fullscreen functionality
            var fullscreenEditors = {};
            
            // PHP Fullscreen
            var phpFullscreenBtn = document.querySelector('.php-fullscreen-btn');
            if (phpFullscreenBtn) {
                phpFullscreenBtn.addEventListener('click', function() {
                    if (!fullscreenEditors.php) {
                        fullscreenEditors.php = CodeMirror(document.getElementById('php-fullscreen-editor'), {
                            value: editors.php.getValue(),
                            mode: 'htmlmixed',
                            theme: 'monokai',
                            lineNumbers: true,
                            autoCloseBrackets: true,
                            matchBrackets: true,
                            indentUnit: 4,
                            indentWithTabs: false,
                            lineWrapping: true
                        });
                    } else {
                        fullscreenEditors.php.setValue(editors.php.getValue());
                    }
                    
                    document.getElementById('php-fullscreen').classList.add('active');
                    setTimeout(function() {
                        fullscreenEditors.php.refresh();
                    }, 100);
                });
            }
            
            // Content Fullscreen
            var contentFullscreenBtn = document.querySelector('.content-fullscreen-btn');
            if (contentFullscreenBtn) {
                contentFullscreenBtn.addEventListener('click', function() {
                    if (!fullscreenEditors.content) {
                        fullscreenEditors.content = CodeMirror(document.getElementById('content-fullscreen-editor'), {
                            value: editors.content.getValue(),
                            mode: 'htmlmixed',
                            theme: 'monokai',
                            lineNumbers: true,
                            autoCloseBrackets: true,
                            matchBrackets: true,
                            indentUnit: 4,
                            indentWithTabs: false,
                            lineWrapping: true
                        });
                    } else {
                        fullscreenEditors.content.setValue(editors.content.getValue());
                    }
                    
                    document.getElementById('content-fullscreen').classList.add('active');
                    setTimeout(function() {
                        fullscreenEditors.content.refresh();
                    }, 100);
                });
            }
            
            // Template Fullscreen
            var templateFullscreenBtn = document.querySelector('.template-fullscreen-btn');
            if (templateFullscreenBtn) {
                templateFullscreenBtn.addEventListener('click', function() {
                    if (!fullscreenEditors.template) {
                        fullscreenEditors.template = CodeMirror(document.getElementById('template-fullscreen-editor'), {
                            value: editors.template.getValue(),
                            mode: 'htmlmixed',
                            theme: 'monokai',
                            lineNumbers: true,
                            autoCloseBrackets: true,
                            matchBrackets: true,
                            indentUnit: 4,
                            indentWithTabs: false,
                            lineWrapping: true
                        });
                    } else {
                        fullscreenEditors.template.setValue(editors.template.getValue());
                    }
                    
                    document.getElementById('template-fullscreen').classList.add('active');
                    setTimeout(function() {
                        fullscreenEditors.template.refresh();
                    }, 100);
                });
            }
            
            // Exit Fullscreen
            document.querySelectorAll('.exit-fullscreen-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var container = this.closest('.fullscreen-container');
                    container.classList.remove('active');
                    
                    // Update the original editor with the new content
                    if (container.id === 'php-fullscreen' && fullscreenEditors.php) {
                        editors.php.setValue(fullscreenEditors.php.getValue());
                    } else if (container.id === 'content-fullscreen' && fullscreenEditors.content) {
                        editors.content.setValue(fullscreenEditors.content.getValue());
                    } else if (container.id === 'template-fullscreen' && fullscreenEditors.template) {
                        editors.template.setValue(fullscreenEditors.template.getValue());
                    }
                });
            });
            
            // Simplified Menu editor functionality
            var menuEditor = document.getElementById('menu-editor');
            var addMenuItemBtn = document.getElementById('add-menu-item');
            
            if (menuEditor && addMenuItemBtn) {
                // Get menu items from PHP
                var menuItems = <?= json_encode($siteConfig['menus']['main']) ?>;
                
                // Function to generate a unique ID for menu items
                function generateUniqueId() {
                    return 'menu-' + Math.random().toString(36).substr(2, 9);
                }
                
                // Function to render menu items
                function renderMenuItems(items) {
                    // Clear the container
                    menuEditor.innerHTML = '';
                    
                    // Check if there are menu items
                    if (!items || items.length === 0) {
                        menuEditor.innerHTML = '<div class="alert alert-info">No menu items found. Click "Add Menu Item" to add one.</div>';
                        return;
                    }
                    
                    // Create a list container for the items
                    var listContainer = document.createElement('div');
                    listContainer.className = 'menu-list';
                    
                    // Loop through menu items and create HTML for each
                    items.forEach(function(item) {
                        // Create menu item container
                        var menuItemDiv = document.createElement('div');
                        menuItemDiv.className = 'menu-item-container';
                        menuItemDiv.dataset.id = item.id || generateUniqueId();
                        
                        // Create HTML for the menu item
                        menuItemDiv.innerHTML = `
                            <div class="menu-item-header">
                                <span class="menu-handle">?</span>
                                <div class="menu-item-content">
                                    <div class="row flex-grow-1">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control menu-text" placeholder="Text" value="${item.text || ''}" data-id="${menuItemDiv.dataset.id}">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control menu-url" placeholder="URL" value="${item.url || ''}" data-id="${menuItemDiv.dataset.id}">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="menu-controls">
                                                <button type="button" class="btn btn-sm btn-danger remove-menu-item" data-id="${menuItemDiv.dataset.id}">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        // Add to list container
                        listContainer.appendChild(menuItemDiv);
                    });
                    
                    // Add the list container to the parent container
                    menuEditor.appendChild(listContainer);
                    
                    // Initialize Sortable for this level
                    new Sortable(listContainer, {
                        animation: 150,
                        handle: '.menu-handle',
                        ghostClass: 'sortable-ghost',
                        dragClass: 'sortable-drag',
                        onEnd: function(evt) {
                            updateMenuStructure();
                        }
                    });
                    
                    // Add event listeners
                    addMenuItemEventListeners();
                }
                
                // Function to add event listeners to menu items
                function addMenuItemEventListeners() {
                    // Add change event to text inputs
                    document.querySelectorAll('.menu-text').forEach(function(input) {
                        input.addEventListener('change', function() {
                            var id = this.getAttribute('data-id');
                            updateMenuItem(id, 'text', this.value);
                        });
                    });
                    
                    // Add change event to url inputs
                    document.querySelectorAll('.menu-url').forEach(function(input) {
                        input.addEventListener('change', function() {
                            var id = this.getAttribute('data-id');
                            updateMenuItem(id, 'url', this.value);
                        });
                    });
                    
                    // Add click event to remove buttons
                    document.querySelectorAll('.remove-menu-item').forEach(function(button) {
                        button.addEventListener('click', function() {
                            var id = this.getAttribute('data-id');
                            removeMenuItem(id);
                        });
                    });
                }
                
                // Function to find a menu item by ID
                function findMenuItem(id) {
                    for (var i = 0; i < menuItems.length; i++) {
                        if (menuItems[i].id === id) {
                            return menuItems[i];
                        }
                    }
                    return null;
                }
                
                // Function to update a menu item property
                function updateMenuItem(id, property, value) {
                    var item = findMenuItem(id);
                    if (item) {
                        item[property] = value;
                        updateMenuItemsField();
                    }
                }
                
                // Function to remove a menu item
                function removeMenuItem(id) {
                    for (var i = 0; i < menuItems.length; i++) {
                        if (menuItems[i].id === id) {
                            menuItems.splice(i, 1);
                            break;
                        }
                    }
                    renderMenuItems(menuItems);
                    updateMenuItemsField();
                }
                
                // Function to update the menu structure after drag and drop
                function updateMenuStructure() {
                    // Reorder the menuItems array based on the DOM order
                    var newOrder = [];
                    var itemElements = menuEditor.querySelectorAll('.menu-item-container');
                    
                    itemElements.forEach(function(itemElement) {
                        var id = itemElement.dataset.id;
                        var item = findMenuItem(id);
                        if (item) {
                            newOrder.push(item);
                        }
                    });
                    
                    menuItems = newOrder;
                    updateMenuItemsField();
                }
                
                // Function to update the hidden menu items field
                function updateMenuItemsField() {
                    var menuItemsField = document.getElementById('menu_items');
                    if (menuItemsField) {
                        menuItemsField.value = JSON.stringify(menuItems);
                    }
                }
                
                // Add event listener to add menu item button
                addMenuItemBtn.addEventListener('click', function() {
                    menuItems.push({
                        id: generateUniqueId(),
                        text: '',
                        url: ''
                    });
                    renderMenuItems(menuItems);
                    updateMenuItemsField();
                });
                
                // Initial render of menu items
                renderMenuItems(menuItems);
            }
        });
    </script>
</body>
</html>
