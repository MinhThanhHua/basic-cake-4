<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="">
    <title><?= CONFIG_FOR_ONCE_PAGE[$controllerAction]['title'] ?? '' ?></title>

    <!-- [css]-->
    <?= $this->Html->css(CSS_DEFAULT_COMMON) ?>
    <?= $this->Html->css(CONFIG_FOR_ONCE_PAGE[$controllerAction]['css'] ?? []) ?>
    <!-- [/css]-->

    <!-- [js]-->
    <?= $this->Html->script(JS_DEFAULT_COMMON) ?>
    <!-- [/js]-->

</head>
<body>
<div class="wrapper">
    <!--[header]-->
    <?= $this->element('header', ['controllerAction' => $controllerAction]) ?>
    <!--[/header]-->

    <div class="wrapper-content">
        <!--[nav]-->
        <?= $this->element('nav_menu', ['controllerAction' => $controllerAction]) ?>
        <!--[/nav]-->

        <!--[layout-wrap]-->
        <?= $this->fetch('content') ?>
        <!--[/layout-wrap]-->
    </div>
</div>
<!-- [js]-->
<?= $this->Html->script(CONFIG_FOR_ONCE_PAGE[$controllerAction]['js'] ?? []) ?>
<!-- [/js]-->
</body>
</html>
