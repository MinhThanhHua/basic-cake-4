<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="">

    <title><?= TITLE_HEADER[$controllerAction]['head'] ?? '' ?></title>

    <!-- [css]-->
    <?= $this->Html->css([
        'login.css',
        'custom.css',
        'login_error.css'
    ]) ?>
    <!-- [/css]-->

    <!-- [js]-->
    <?= $this->Html->script([
        'jquery.min.js',
    ]) ?>
    <!-- [/js]-->

</head>
<body>
<?= $this->fetch('content') ?>
</body>
</html>
