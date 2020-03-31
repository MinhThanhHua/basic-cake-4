<?php
if ($controllerAction[1] == 'add') {
    echo $this->Form->button('<p>新規作成</p>', [
        'class' => 'btn-top-right',
        'type' => 'button',
        'onclick' => 'location.href =`' . $this->Url->build([
                'controller' => $controllerAction[0],
                'action' => $controllerAction[1]
            ]) . '`',
        'escapeTitle' => false
    ]);
}

if ($controllerAction[1] == 'detail') {
    echo $this->Form->button('<p>詳細</p>', [
        'class' => 'button-list ' . $class ?? '',
        'onclick' => 'location.href = `' . $this->Url->build([
                'controller' => $controllerAction[0],
                'action' => $controllerAction[1],
                $id
            ]) . '`',
        'escapeTitle' => false
    ]);
}

if ($controllerAction[1] == 'edit') {
    echo $this->Form->button('<p>編集</p>', [
        'class' => 'button-list list-btn-2 ' . $class ?? '',
        'onclick' => 'location.href = `' . $this->Url->build([
                'controller' => $controllerAction[0],
                'action' => $controllerAction[1],
                $id
            ]) . '`',
        'escapeTitle' => false
    ]);
}

if ($controllerAction[1] == 'delete') {
    echo $this->Form->button(($text != '') ? "<p>$text</p>" : '<p>削除</p>', [
        'class' => "button-list list-btn-3 accessDelete " . $class ?? '',
        'data-toggle' => "modal",
        'data-target' => '#myModal',
        'type' => 'button',
        'data-id' => $id,
        'escapeTitle' => false
    ]);
}
