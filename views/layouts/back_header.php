<!DOCTYPE html>
<html lang="<?= config('site.lang') ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#333399">

    <title><?= config('site.name') ?></title>

    <link rel="canonical" href="<?= url() ?>">

    <!-- Site icon -->
    <link rel="icon" href="<?= config('site.logo.64') ?>" type="image/png" sizes="64x64">
    <link rel="icon" href="<?= config('site.logo.128') ?>" type="image/png" sizes="128x128">
    <link rel="shortcut icon" href="<?= config('site.logo.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= config('site.logo.64') ?>">

    <?= resource('cdn/back_head.php') ?>
</head>