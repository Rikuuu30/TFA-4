<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="directory-header shell user-header form-page-header">
    <div>
        <span class="eyebrow">02 / Team directory</span>
        <h1><?= $user === null ? 'Add staff account' : 'Edit staff account' ?></h1>
        <p><?= $user === null ? 'Create a staff directory entry with a unique username.' : 'Update the staff member’s account details or profile image.' ?></p>
    </div>
    <a class="button ghost" href="<?= site_url('users') ?>">Back to users</a>
</section>

<section class="shell form-panel">
    <?php if ($formErrors !== []): ?>
        <div class="form-alert" role="alert">
            <strong>Please review the highlighted fields.</strong>
            <p>Correct the information below and submit the form again.</p>
        </div>
    <?php endif; ?>

    <form action="<?= esc($formAction, 'attr') ?>" method="post" enctype="multipart/form-data" novalidate>
        <?= csrf_field() ?>
        <div class="form-field">
            <label for="username">Username <span aria-hidden="true">*</span></label>
            <input id="username" name="username" type="text" maxlength="50" autocomplete="username" value="<?= esc(old('username', $user['username'] ?? ''), 'attr') ?>" required aria-invalid="<?= isset($formErrors['username']) ? 'true' : 'false' ?>" aria-describedby="username-help<?= isset($formErrors['username']) ? ' username-error' : '' ?>">
            <small id="username-help">Must be unique; up to 50 characters.</small>
            <?php if (isset($formErrors['username'])): ?><p class="field-error" id="username-error"><?= esc($formErrors['username']) ?></p><?php endif; ?>
        </div>

        <div class="form-field">
            <label for="full_name">Full name <span aria-hidden="true">*</span></label>
            <input id="full_name" name="full_name" type="text" maxlength="100" autocomplete="name" value="<?= esc(old('full_name', $user['full_name'] ?? ''), 'attr') ?>" required aria-invalid="<?= isset($formErrors['full_name']) ? 'true' : 'false' ?>" aria-describedby="full-name-help<?= isset($formErrors['full_name']) ? ' full-name-error' : '' ?>">
            <small id="full-name-help">The name shown in the staff directory.</small>
            <?php if (isset($formErrors['full_name'])): ?><p class="field-error" id="full-name-error"><?= esc($formErrors['full_name']) ?></p><?php endif; ?>
        </div>

        <div class="form-field">
            <label for="password">Password <?= $user === null ? '<span aria-hidden="true">*</span>' : '<span class="optional-label">Optional</span>' ?></label>
            <input id="password" name="password" type="password" autocomplete="<?= $user === null ? 'new-password' : 'new-password' ?>" minlength="12" maxlength="255" <?= $user === null ? 'required' : '' ?> aria-describedby="password-help<?= isset($formErrors['password']) ? ' password-error' : '' ?>">
            <small id="password-help"><?= $user === null ? 'At least 12 characters. The password is stored as a secure hash.' : 'Leave blank to keep the current password; enter at least 12 characters to change it.' ?></small>
            <?php if (isset($formErrors['password'])): ?><p class="field-error" id="password-error"><?= esc($formErrors['password']) ?></p><?php endif; ?>
        </div>

        <?php if ($user !== null): ?>
            <div class="form-field avatar-field">
                <label for="avatar">Profile image <span class="optional-label">Optional</span></label>
                <div class="avatar-upload-row">
                    <img class="avatar-preview" src="<?= esc(! empty($user['avatar']) ? base_url('uploads/' . $user['avatar']) : base_url('assets/images/user-placeholder.svg'), 'attr') ?>" alt="Current profile image" width="72" height="72">
                    <div>
                        <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,.jpg,.jpeg,.png" aria-describedby="avatar-help avatar-error">
                        <small id="avatar-help">Choose a JPG or PNG image up to 2 MB. It will be cropped to a 256 × 256 thumbnail.</small>
                    </div>
                </div>
                <?php if (isset($formErrors['avatar'])): ?><p class="field-error" id="avatar-error"><?= esc($formErrors['avatar']) ?></p><?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="form-actions">
            <a class="button secondary" href="<?= site_url('users') ?>">Cancel</a>
            <button class="button primary" type="submit"><?= $user === null ? 'Save staff account' : 'Save changes' ?></button>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
