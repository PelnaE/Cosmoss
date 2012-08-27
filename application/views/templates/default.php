<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <?php if (!empty($stylesheets)): ?>

            <?php foreach ($stylesheets as $stylesheet): ?>

                <link rel="stylesheet" href="<?= URL::site('assets/css/' . $stylesheet . '.css') ?>" />

            <?php endforeach; ?>

        <?php endif; ?>   

        <title><?= $page_title ?> &mdash; <?= $site_name ?></title>
    </head>
    <body>
        <div id="container">
            <div class="head">
                <a href="<?= URL::site('/') ?>"><h1><?= $site_name ?></h1></a>
            </div>
            <div class="content">
                <?php if (!isset($content)): ?>
                
                    <h3><?=__('error_404')?></h3>
                    <p><?=__('error_404_descr')?></p>
                    
                <?php else: ?>
                    
                    <?= $content ?>
                    
                <?php endif; ?>
                    
            </div>
            <div class="footer">
                &copy; 2012 reGative. All rights reserved.<br />
                Built on Kohana Framework 3.2. 

                <?php $user_session = Session::instance()->get('user'); ?>

                <?php if (!empty($user_session)): ?>

                    <a href="<?= URL::site('cp') ?>">To Admin CP</a>

                <?php endif; ?>

            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <?php if (!empty($scripts)): ?>

            <?php foreach ($scripts as $script): ?>

                <script src="<?= URL::site('assets/js/' . $script . '.js') ?>"></script>

            <?php endforeach; ?>

        <?php endif; ?>

    </body>
</html>