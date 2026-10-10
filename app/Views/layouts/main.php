<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zen Supply POS — a focused point-of-sale workspace for martial arts gear retailers.">
    <title><?= esc($pageTitle) ?> · Zen Supply POS</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>?v=3">
    <script src="<?= base_url('assets/js/app.js') ?>" defer></script>
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>

    <header class="site-header">
        <div class="shell nav-shell">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="Zen Supply POS home">
                <span class="brand-mark" aria-hidden="true">Z</span>
                <span>
                    <strong>Zen Supply</strong>
                    <small>Point of sale</small>
                </span>
            </a>

            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
                <span class="sr-only">Toggle navigation</span>
                <span></span><span></span><span></span>
            </button>

            <nav class="primary-navigation" id="primary-navigation" aria-label="Primary navigation">
                <a class="<?= $activePage === 'home' ? 'active' : '' ?>" href="<?= site_url('/') ?>" <?= $activePage === 'home' ? 'aria-current="page"' : '' ?>>Home</a>
                <?php if (session()->has('user_id')): ?>
                <a class="<?= $activePage === 'customers' ? 'active' : '' ?>" href="<?= site_url('customers') ?>" <?= $activePage === 'customers' ? 'aria-current="page"' : '' ?>>Customers</a>
                <a class="<?= $activePage === 'users' ? 'active' : '' ?>" href="<?= site_url('users') ?>" <?= $activePage === 'users' ? 'aria-current="page"' : '' ?>>Users</a>
                <?php else: ?>
                <a class="<?= $activePage === 'login' ? 'active' : '' ?>" href="<?= site_url('login') ?>" <?= $activePage === 'login' ? 'aria-current="page"' : '' ?>>Staff sign in</a>
                <?php endif; ?>
                <a class="<?= $activePage === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>" <?= $activePage === 'about' ? 'aria-current="page"' : '' ?>>About</a>
            </nav>
            <?php if (session()->has('user_id')): ?>
                <div class="staff-session"><span>Signed in as <strong><?= esc(session()->get('full_name')) ?></strong></span><form action="<?= site_url('logout') ?>" method="post"><?= csrf_field() ?><button type="submit">Sign out</button></form></div>
            <?php endif; ?>

        </div>
    </header>

    <?php if ($message = session()->getFlashdata('success')): ?>
        <div class="shell flash-message success-message" role="status"><?= esc($message) ?></div>
    <?php elseif ($message = session()->getFlashdata('error')): ?>
        <div class="shell flash-message error-message" role="alert"><?= esc($message) ?></div>
    <?php endif; ?>

    <main id="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer">
        <div class="shell footer-inner">
            <div class="footer-brand">
                <span class="brand-mark" aria-hidden="true">Z</span>
                <div><strong>Zen Supply POS</strong><p>Specialist martial-arts retail, organized for the counter.</p></div>
            </div>
            <div class="footer-meta"><strong>Sample flagship</strong><p>Makati City · Mon–Sat, 9 AM–8 PM</p></div>
            <nav class="footer-nav" aria-label="Footer navigation">
                <a href="<?= site_url('/') ?>">Dashboard</a>
                <?php if (session()->has('user_id')): ?>
                <a href="<?= site_url('customers') ?>">Customers</a>
                <a href="<?= site_url('users') ?>">Users</a>
                <?php else: ?>
                <a href="<?= site_url('login') ?>">Staff sign in</a>
                <?php endif; ?>
                <a href="<?= site_url('about') ?>">About</a>
            </nav>
        </div>
        <div class="shell footer-bottom"><span>Zen Supply retail concept</span><span>Makati City · <?= date('Y') ?></span></div>
    </footer>
</body>
</html>
