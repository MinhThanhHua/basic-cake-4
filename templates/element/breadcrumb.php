<?php
$breadCrumbPageTitle = [
    'Account/index' => [
        'breadcrumb' => [
            $this->Html->link('Top', ['controller' => 'Web', 'action' => 'index']),
            $this->Html->link('定数マスター管理', ['controller' => 'Account', 'action' => 'index'])
        ]
    ]
];
?>

<?php if (isset($breadCrumbPageTitle[$controllerAction]['breadcrumb'])): ?>
    <div class="breadcrumb-top">
        <ul class="breadcrumb-list">
            <?php foreach ($breadCrumbPageTitle[$controllerAction]['breadcrumb'] as $title): ?>
                <li>
                    <?= $title ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

