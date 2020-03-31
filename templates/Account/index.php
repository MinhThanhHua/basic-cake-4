<article class="content content-definition-list">

    <?= $this->element('breadcrumb') ?>

    <p class="search-ticket js-search-ticket">
        検索
    </p>
    <div class="form-search-ticket">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="box box-edit">
            <div class="box-label box-label-edit"><label for="#">ID</label></div>
            <div class="box-input box-input-edit">
                <div class="box-left">
                    <?= $this->Form->text('id', ['class' => 'id_ticket', 'value' => $data['id'] ?? '']) ?>
                </div>
            </div>
        </div>
        <div class="box box-edit">
            <div class="box-label box-label-edit"><label for="#">定数名</label></div>
            <div class="box-input box-input-edit">
                <div class="box-left">
                    <?= $this->Form->text('name', ['class' => 'id_ticket', 'value' => $data['name'] ?? '']) ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($data['limit'])) {
            echo  $this->Form->hidden('limit', ['value' => $data['limit']]);
        }
        ?>
        <?= $this->Form->button('search', ['class' => 'btn-hidden', 'id' => 'search']) ?>
        <?= $this->Form->end() ?>

        <div class="box-btn-search">
            <?= $this->Html->link('検索', '', ['id' => 'btnSearch']) ?>
        </div>
    </div>

    <?= $this->element('common_btn', ['controllerAction' => ['Master', 'add']]) ?>


    <?= $this->Flash->render('success') ?? '' ?>

    <!-- List data -->
    <div class="table-list-item">
        <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm "
               cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><p>ID</p></th>
                <th><p>定数名</p></th>
                <th><p>処理</p></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($listMaster)): ?>
                <?php foreach ($listMaster as $key => $master): ?>
                    <tr>
                        <th><p><?= $master->id ?></p></th>
                        <td><p><?= h($master->name ?? '') ?></p></td>
                        <td>
                            <?= $this->element('common_btn',
                                ['id' => $master->id, 'controllerAction' => ['Account', 'detail']]) ?>

                            <?= $this->element('common_btn',
                                ['id' => $master->id, 'controllerAction' => ['Account', 'edit']]) ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>

        <?= $this->element('pagination') ?>
    </div>
    <?= $this->Form->hidden('', ['id' => 'csrfToken', 'value' => $this->request->getAttribute('csrfToken')]) ?>
</article>
