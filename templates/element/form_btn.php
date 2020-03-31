<div class="table-button">
    <?php
    if ($page == 'add' || $page == 'edit') {
        echo $this->Form->button('<p>確認</p>', ['id' => 'submitData', 'class' => "button-1 $class"]);
    } elseif ($page == 'detail') {
    if (($allowAccept[$controller] && in_array('edit', $allowAccept[$controller])) || $roleAdmin) {
         echo $this->Form->button('<p>編集</p>', [
                'class' => "button-1 $class",
                'type' => 'button',
                'onclick' => 'location.href = `' . $this->Url->build([
                        'controller' => $controllerAction[0],
                        'action' => 'edit',
                        $id
                    ]) . '`'
            ]);
        }
    } else {
        // Page is confirm
        echo $this->Form->button('<p>登録</p>', ['class' => 'button-1', 'id' => 'submitData']);
    }
    ?>
    <?= $this->Form->button('<p>戻る</p>', [
        'class' => 'button-2',
        'id' => 'btnBack',
        'type' => ($page !== 'confirm') ? 'button' : 'submit'
    ]) ?>
</div>

<script>
    $(document).ready(function () {
        $('#btnBack').click(function () {

            <?php if (in_array($controllerAction[0], LIST_CONTROLLER_IS_CHILD)): ?>
                <?php if ($page !== 'confirm'): ?>
                    <?php if ($this->request->getSession()->check(DETAIL_BUTTON_BACK) && $page !== 'detail'): ?>
                        return location.href = '<?= $this->Url->build([
                            'controller' => $controllerAction[0],
                            'action' => 'detail',
                            $this->request->getParam('pass')[0]
                        ]) ?>';
                    <?php else: ?>
                        return location.href = '<?= $this->Url->build([
                            'controller' => $controllerAction[0],
                            'action' => $controllerAction[1],
                            '?' => [
                                'parent' => $this->request->getSession()->read(MASTER_CONSTANT_ID)
                            ]
                        ]) ?>';
                    <?php endif; ?>
                <?php else: ?>
                    return form.action = '<?= $this->Url->build([
                        'controller' => $controllerAction[0],
                        'action' => $controllerAction[1],
                        $id ?? ''
                    ]) ?>';
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($page !== 'confirm'): ?>
                <?php if ($this->request->getSession()->check(DETAIL_BUTTON_BACK) && $page !== 'detail'): ?>
                    return location.href = '<?= $this->Url->build([
                        'controller' => $controllerAction[0],
                        'action' => 'detail',
                        $this->request->getParam('pass')[0]
                    ]) ?>';
                <?php else: ?>
                    return location.href = '<?= $this->Url->build([
                        'controller' => $controllerAction[0],
                        'action' => $controllerAction[1],
                    ]) ?>';
                <?php endif; ?>
            <?php else: ?>
                return form.action = '<?= $this->Url->build([
                    'controller' => $controllerAction[0],
                    'action' => $controllerAction[1],
                    $id ?? ''
                ]) ?>';
            <?php endif; ?>
        })
    })
</script>
