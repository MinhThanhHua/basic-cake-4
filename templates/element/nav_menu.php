<article id="menu">
    <nav class="navbar-menu">
        <div class="navbar-brand-left">
            <span>メニュー </span>
            <button class="js-navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-expanded="true"></button>
        </div>
        <ul class="navbar-nav">
            <li>
                <?= $this->Html->link('Top ', [
                    'controller' => 'Web',
                    'action' => 'index'
                ], [
                    'class' => ($controller == 'Web') ? 'active' : ''
                ]) ?>
            </li>
            <li>
                <?= $this->Html->link('管理ユーザー管理 ', [
                    'controller' => 'Account',
                    'action' => 'index'
                ], [
                    'class' => ($controller == 'Account') ? 'active' : ''
                ]) ?>
            </li>
        </ul>
    </nav>
</article>
