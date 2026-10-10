<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="directory-header shell customer-header">
    <div>
        <span class="eyebrow">01 / Account directory</span>
        <h1>Customer accounts</h1>
        <p>Customer contact details saved in the Zen Supply customer database.</p>
    </div>
    <div class="directory-actions"><div class="record-count"><span>Directory total</span><strong><?= count($customers) ?> customers</strong></div><a class="button primary" href="<?= site_url('customers/new') ?>">Add customer <span aria-hidden="true">+</span></a></div>
</section>

<section class="shell directory-panel" data-directory>
    <div class="table-toolbar">
        <label class="search-field">
            <span class="sr-only">Search customers</span>
            <span aria-hidden="true">⌕</span>
            <input type="search" placeholder="Search name, email or phone…" data-table-search autocomplete="off">
        </label>
        <p data-results-label>Showing all <?= count($customers) ?> customers</p>
    </div>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th scope="col">Customer</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Account created</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr data-table-row>
                    <td data-label="Customer">
                        <div class="identity-cell">
                            <span class="identity-marker" aria-hidden="true"></span>
                            <span><strong><?= esc($customer['full_name']) ?></strong><small>Customer #<?= esc((string) $customer['id']) ?></small></span>
                        </div>
                    </td>
                    <td data-label="Email"><a href="mailto:<?= esc($customer['email'], 'attr') ?>"><?= esc($customer['email']) ?></a></td>
                    <td data-label="Phone">
                        <?php if ($customer['phone'] !== null && $customer['phone'] !== ''): ?>
                            <a href="tel:<?= esc(preg_replace('/[^+\d]/', '', $customer['phone']), 'attr') ?>"><?= esc($customer['phone']) ?></a>
                        <?php else: ?>
                            <span>Not provided</span>
                        <?php endif; ?>
                    </td>
                    <td data-label="Account created"><?= esc(date('M j, Y', strtotime($customer['created_at']))) ?></td>
                    <td data-label="Actions"><a class="table-action" href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="empty-state" data-empty-state <?= $customers === [] ? '' : 'hidden' ?>>
        <strong>No customers found</strong>
        <p><?= $customers === [] ? 'Add your first customer account to begin the directory.' : 'Try another name or contact detail.' ?></p>
    </div>
</section>
<?= $this->endSection() ?>
