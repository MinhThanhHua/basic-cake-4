<div class="login-form">
    <p class="title">ログイン</p>
    <div class="form">
        <?= $this->Form->create() ?>
        <div class="form-input">
            <p class="p-title">メールアドレス,パスワードを入力してください</p>
            <?= $this->Form->text('email', [
                'placeholder' => 'メールアドレス',
                'class' => ($this->request->getSession()->check('Flash.msgLogin')) ? 'user-err' : '',
                'required' => true
            ]) ?>
            <?= $this->Form->password('password', [
                'placeholder' => 'パスワード',
                'class' => ($this->request->getSession()->check('Flash.msgLogin')) ? 'user-err' : '',
                'required' => true
            ]) ?>
            <?= $this->Flash->render('msgLogin') ?? '' ?>
            <?= $this->Form->button('<p>ログイン</p>', [
                'name' => 'btnLogin',
                'class' => 'btn-disabled',
                'escapeTitle' => false
            ]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        if (checkFormInput()) {
            $('button[name=btnLogin]').removeClass('btn-disabled');
        }

        $('button[name=btnLogin]').click(function () {
            if (checkFormInput()) {
                $(this).addClass('btn-disabled');
            }
        });

        $('input[name=email], input[name=password]').on('input', function () {
            if (checkFormInput()) {
                $('button[name=btnLogin]').removeClass('btn-disabled');
            } else {
                if (!$('button[name=btnLogin]').hasClass('btn-disabled')) {
                    $('button[name=btnLogin]').addClass('btn-disabled');
                }
            }
        });
    });

    function checkFormInput() {
        if ($('input[name=email]').val().trim() !== '' && $('input[name=password]').val().trim() !== '') {
            return true;
        }
        return false;
    }
</script>
