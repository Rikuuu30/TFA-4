<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="directory-header shell user-header">
    <div>
        <span class="eyebrow">02 / Team directory</span>
        <h1>User accounts</h1>
        <p>Staff accounts saved in the Zen Supply team directory.</p>
    </div>
    <div class="directory-actions"><div class="record-count"><span>Directory total</span><strong><?= count($users) ?> staff profiles</strong></div><a class="button primary" href="<?= site_url('users/new') ?>">Add staff account <span aria-hidden="true">+</span></a></div>
</section>

<section class="shell directory-panel" data-directory>
    <div class="table-toolbar">
        <label class="search-field">
            <span class="sr-only">Search users</span>
            <span aria-hidden="true">⌕</span>
            <input type="search" placeholder="Search staff name or username…" data-table-search autocomplete="off">
        </label>
        <p data-results-label>Showing all <?= count($users) ?> users</p>
    </div>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th scope="col">Staff member</th>
                    <th scope="col">Username</th>
                    <th scope="col">Account created</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr data-table-row>
                    <td data-label="Staff member">
                        <div class="identity-cell">
                            <img class="staff-avatar" src="<?= esc(! empty($user['avatar']) ? base_url('uploads/' . $user['avatar']) : base_url('assets/images/user-placeholder.svg'), 'attr') ?>" alt="" loading="lazy" width="42" height="42">
                            <span><strong><?= esc($user['full_name']) ?></strong><small>Staff #<?= esc((string) $user['id']) ?></small></span>
                        </div>
                    </td>
                    <td data-label="Username"><span class="username">@<?= esc($user['username']) ?></span></td>
                    <td data-label="Account created"><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></td>
                    <td data-label="Actions"><a class="table-action" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="empty-state" data-empty-state <?= $users === [] ? '' : 'hidden' ?>>
        <strong>No users found</strong>
        <p><?= $users === [] ? 'Add your first staff profile to begin the team directory.' : 'Try another staff name or username.' ?></p>
    </div>
</section>
<?= $this->endSection() ?>
