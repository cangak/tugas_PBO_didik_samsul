<?php
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Ambil role dari session
$currentRole = $_SESSION['role_nama'] ?? null;

// Ambil data menu dari database
$menuModel = new Menu();
$menus = $menuModel->getAllActive();

// Filter menu berdasarkan role_access (nama role, bukan ID)
$filteredMenus = array_filter($menus, function ($menu) use ($currentRole) {
    // Kalau role_access kosong → menu bisa diakses siapa pun
    if (empty($menu['role_access'])) return true;

    // Pisahkan berdasarkan koma
    $roles = array_map('trim', explode(',', strtolower($menu['role_access'])));
    return in_array(strtolower($currentRole), $roles);
});

// Susun menu jadi tree
$menuTree = [];
foreach ($filteredMenus as $menu) {
    if (empty($menu['parent_id'])) {
        $menu['children'] = [];
        $menuTree[$menu['id']] = $menu;
    }
}

foreach ($filteredMenus as $menu) {
    if (!empty($menu['parent_id']) && isset($menuTree[$menu['parent_id']])) {
        $menuTree[$menu['parent_id']]['children'][] = $menu;
    }
}

// Fungsi cek aktif
function isMenuActive($menu, $uri)
{
    $rawPath = parse_url($menu['url'] ?? '', PHP_URL_PATH);
    $menuPath = trim($rawPath ?? '', '/');

    if ($menuPath === '' || $menuPath === '#') {
        return false;
    }

    return str_starts_with($uri, $menuPath);
}

// Fungsi cek aktif parent
function isParentActive($menu, $uri)
{
    if (isMenuActive($menu, $uri)) {
        return true;
    }

    if (!empty($menu['children'])) {
        foreach ($menu['children'] as $child) {
            if (isMenuActive($child, $uri)) {
                return true;
            }
        }
    }

    return false;
}
?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?= BASEURL ?>/home">
                        <img src="<?= BASEURL ?>/assets/compiled/svg/logo.svg" alt="Logo" />
                    </a>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <?php foreach ($menuTree as $menu): ?>
                    <?php
                        $isActiveParent = isParentActive($menu, $uri);
                        $hasChildren = !empty($menu['children']);
                        $itemClass = $hasChildren ? 'sidebar-item has-sub' : 'sidebar-item';
                        if ($isActiveParent) $itemClass .= ' active';
                    ?>

                    <li class="<?= $itemClass ?>">
                        <a href="<?= $hasChildren ? '#' : '/' . htmlspecialchars($menu['url']) ?>" class="sidebar-link">
                            <i class="<?= htmlspecialchars($menu['icon']) ?>"></i>
                            <span><?= htmlspecialchars($menu['title']) ?></span>
                        </a>

                        <?php if ($hasChildren): ?>
                            <ul class="submenu <?= $isActiveParent ? 'active' : '' ?>">
                                <?php foreach ($menu['children'] as $child): ?>
                                    <?php $isActiveChild = isMenuActive($child, $uri); ?>
                                    <li class="submenu-item <?= $isActiveChild ? 'active' : '' ?>">
                                        <a href="/<?= htmlspecialchars($child['url']) ?>">
                                            <?= htmlspecialchars($child['title']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
