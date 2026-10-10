<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="dashboard-hero shell" aria-labelledby="hero-title">
    <div class="hero-visual">
        <div class="hero-copy">
            <span class="eyebrow light">Zen Supply · Makati flagship</span>
            <h1 id="hero-title">Everything the counter needs, before the next bell.</h1>
            <p>A focused store overview for combat-sports gear, customer relationships and day-to-day team operations.</p>
            <div class="hero-actions">
                <a class="button primary" href="<?= site_url('customers') ?>">Open customer directory <span aria-hidden="true">→</span></a>
                <a class="button ghost" href="<?= site_url('about') ?>">Store information</a>
            </div>
        </div>
        <div class="hero-caption">
            <span>Featured department</span>
            <strong>Striking essentials</strong>
            <small>Gloves · Wraps · Pads · Protection</small>
        </div>
    </div>

    <aside class="shift-card" aria-label="Current store status">
        <div class="shift-card-heading">
            <div>
                <span class="eyebrow">Live counter</span>
                <h2>Open shift</h2>
            </div>
            <span class="open-pill"><i aria-hidden="true"></i> Open</span>
        </div>
        <dl class="shift-facts">
            <div><dt>Register</dt><dd>Counter 01</dd></div>
            <div><dt>Staff on duty</dt><dd>4 members</dd></div>
            <div><dt>Pickup orders</dt><dd>3 ready</dd></div>
            <div><dt>Next stock check</dt><dd>5:30 PM</dd></div>
        </dl>
        <div class="payment-strip">
            <span>Accepted today</span>
            <div><b>Cash</b><b>Card</b><b>GCash</b></div>
        </div>
        <p class="demo-disclosure">Today’s figures are sample store data prepared for the Zen Supply concept.</p>
    </aside>
</section>

<nav class="shell route-ribbon" aria-label="Quick access">
    <a href="<?= site_url('customers') ?>"><span>01 / DIRECTORY</span><strong>Customer accounts</strong><span class="route-arrow" aria-hidden="true">↗</span></a>
    <a href="<?= site_url('users') ?>"><span>02 / TEAM</span><strong>User accounts</strong><span class="route-arrow" aria-hidden="true">↗</span></a>
    <a href="<?= site_url('about') ?>"><span>03 / STORE</span><strong>About Zen Supply</strong><span class="route-arrow" aria-hidden="true">↗</span></a>
</nav>

<section class="shell dashboard-section" aria-labelledby="overview-title">
    <div class="section-heading compact-heading">
        <div>
            <span class="eyebrow">Today’s performance</span>
            <h2 id="overview-title">Store pulse</h2>
        </div>
        <span class="updated-label">Updated for the current demo session</span>
    </div>

    <div class="metric-grid refined-metrics">
        <article class="metric-card featured" data-glyph="↗">
            <div class="metric-top"><span>Net sales</span><i>+12.4%</i></div>
            <strong>₱24,860</strong>
            <small>₱2,742 above yesterday</small>
            <div class="mini-bars" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
        </article>
        <article class="metric-card" data-glyph="▦">
            <div class="metric-top"><span>Transactions</span><i>38 sales</i></div>
            <strong>₱654</strong>
            <small>Average order value</small>
            <div class="metric-foot"><span>27 member</span><span>11 walk-in</span></div>
        </article>
        <article class="metric-card" data-glyph="◎">
            <div class="metric-top"><span>Units sold</span><i>61 items</i></div>
            <strong>1.6</strong>
            <small>Items per transaction</small>
            <div class="metric-foot"><span>Gloves lead</span><span>23% mix</span></div>
        </article>
        <article class="metric-card warning" data-glyph="!">
            <div class="metric-top"><span>Inventory alerts</span><i>Action needed</i></div>
            <strong>7</strong>
            <small>4 shown in priority queue</small>
            <div class="metric-foot"><span>2 critical</span><span>5 low</span></div>
        </article>
    </div>
</section>

<section class="shell operations-grid" aria-label="Merchandising and stock overview">
    <article class="panel product-panel">
        <header class="panel-header">
            <div>
                <span class="eyebrow">Merchandising</span>
                <h2>Fast-moving gear</h2>
            </div>
            <span class="panel-note">Units sold today</span>
        </header>
        <div class="product-list">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="product-row">
                    <span class="product-rank"><?= esc($product['rank']) ?></span>
                    <div class="product-symbol" aria-hidden="true"><?= esc(strtoupper(substr($product['category'], 0, 1))) ?></div>
                    <div class="product-name">
                        <strong><?= esc($product['name']) ?></strong>
                        <small><?= esc($product['sku']) ?> · <?= esc($product['category']) ?></small>
                    </div>
                    <div class="product-price"><strong><?= esc($product['price']) ?></strong><small><?= esc((string) $product['stock']) ?> in stock</small></div>
                    <div class="sold-count"><strong><?= esc((string) $product['sold']) ?></strong><small>sold</small></div>
                </div>
            <?php endforeach; ?>
        </div>
    </article>

    <aside class="panel alert-panel">
        <header class="panel-header">
            <div>
                <span class="eyebrow">Inventory</span>
                <h2>Restock queue</h2>
            </div>
            <span class="alert-count">4 priority</span>
        </header>
        <div class="alert-list">
            <?php foreach ($stockAlerts as $item): ?>
                <div class="stock-alert">
                    <span class="stock-dot <?= esc($item['level']) ?>" aria-hidden="true"></span>
                    <div><strong><?= esc($item['name']) ?></strong><small><?= esc($item['sku']) ?></small></div>
                    <span class="stock-remaining"><?= esc((string) $item['remaining']) ?> left</span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="alert-summary"><span>Suggested reorder value</span><strong>₱18,740</strong></div>
    </aside>
</section>

<section class="shell dashboard-section" aria-labelledby="transactions-title">
    <article class="panel transactions-panel">
        <header class="panel-header">
            <div>
                <span class="eyebrow">Counter activity</span>
                <h2 id="transactions-title">Recent transactions</h2>
            </div>
            <span class="panel-note">Latest 5 of 38 sales</span>
        </header>
        <div class="table-scroll">
            <table class="transaction-table">
                <thead><tr><th>Receipt</th><th>Customer</th><th>Items</th><th>Payment</th><th>Time</th><th>Total</th></tr></thead>
                <tbody>
                <?php foreach ($recentTransactions as $transaction): ?>
                    <tr>
                        <td data-label="Receipt"><span class="receipt-number"><?= esc($transaction['receipt']) ?></span></td>
                        <td data-label="Customer"><strong><?= esc($transaction['customer']) ?></strong></td>
                        <td data-label="Items"><?= esc($transaction['items']) ?></td>
                        <td data-label="Payment"><span class="payment-tag"><?= esc($transaction['method']) ?></span></td>
                        <td data-label="Time"><?= esc($transaction['time']) ?></td>
                        <td data-label="Total"><strong><?= esc($transaction['total']) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </article>
</section>

<section class="shell discipline-section" aria-labelledby="departments-title">
    <div class="section-heading split-heading">
        <div>
            <span class="eyebrow">Shop by discipline</span>
            <h2 id="departments-title">Built around how athletes train.</h2>
        </div>
        <p>Each department combines apparel, protective equipment and training tools for its community.</p>
    </div>
    <div class="department-grid">
        <article class="department-card">
            <div class="department-image"><img src="<?= base_url('assets/images/image-2.png') ?>" alt="Boxing gloves, hand wraps and a focus mitt"><span>01</span></div>
            <div class="department-copy"><h3>Boxing &amp; Muay Thai</h3><p>Gloves from 8–16 oz, wraps, pads, shin guards, trunks and mouthguards.</p><small>124 active SKUs</small></div>
        </article>
        <article class="department-card">
            <div class="department-image"><img src="<?= base_url('assets/images/image-3.png') ?>" alt="Brazilian jiu-jitsu gi, black belt and rash guard"><span>02</span></div>
            <div class="department-copy"><h3>BJJ &amp; Judo</h3><p>Training and competition gis, belts, rash guards, grappling shorts and tape.</p><small>86 active SKUs</small></div>
        </article>
        <article class="department-card">
            <div class="department-image"><img src="<?= base_url('assets/images/image-4.png') ?>" alt="Karate uniform, belt and sparring protection"><span>03</span></div>
            <div class="department-copy"><h3>Karate &amp; Taekwondo</h3><p>Uniforms, belt ranks, approved sparring protection and club-order equipment.</p><small>93 active SKUs</small></div>
        </article>
        <article class="department-card">
            <div class="department-image"><img src="<?= base_url('assets/images/image-1.png') ?>" alt="Black training gloves, focus mitt and protective equipment"><span>04</span></div>
            <div class="department-copy"><h3>MMA &amp; Conditioning</h3><p>Hybrid gloves, fightwear, body protectors, bags and strength accessories.</p><small>71 active SKUs</small></div>
        </article>
    </div>
</section>

<section class="shell service-banner">
    <div><span class="eyebrow light">Built into the store experience</span><h2>Fit advice, club orders and pickup support.</h2></div>
    <div class="service-points"><span>Free glove fitting</span><span>Uniform sizing</span><span>Team quotations</span><span>Same-day pickup</span></div>
    <a class="button primary" href="<?= site_url('about') ?>">See store details</a>
</section>
<?= $this->endSection() ?>
