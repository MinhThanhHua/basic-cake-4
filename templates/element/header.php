<div class="header">
    <div class="header-button">
        <p><?= USER_ROLE[$isLogin->role] ?? '' ?></p>
    </div>
    <p class="header-title"><?= CONFIG_FOR_ONCE_PAGE[$controllerAction]['title'] ?? '' ?></p>
    <div class="select-common">
        <select class="select-option">
            <option class="display-none"><?= h($isLogin->user_name ?? '') ?></option>
            <option value="<?= $this->Url->build(['controller' => 'Web', 'action' => 'logout']); ?>">ログアウト</option>
        </select>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.select-option').on('change', function () {
            let urlLogout = '<?= $this->Url->build(['controller' => 'Web', 'action' => 'logout']); ?>';
            if ($("option:selected", this).val() === urlLogout) {
                window.location = '<?= SERVER_DOMAIN ?>' + urlLogout;
            }
        })
    });
</script>
