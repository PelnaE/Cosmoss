<h2><a href="<?= URL::site('cp') ?>"><?= __('admincp') ?></a> &mdash; <a href="<?= URL::site('cp/entries') ?>"><?= __('entries') ?></a> &mdash; <a href="<?= URL::site('cp/entries/write') ?>"><?= __('write_entry') ?></a></h2>

<?php $user_session = Session::instance()->get('user'); ?>

<?php if (empty($user_session)): ?>
    <h3>Session Error!</h3>
    <p>Please check if you are logged in!</p>
<?php else: ?>
    
    <form action="<?= URL::site('cp/entries/write') ?>" method="post">
        
        <input type="hidden" name="csrf_token" value="<?= Security::token() ?>" />
        
        <?= __('title') ?> <input style="width: 350px;" type="text" name="title" /><br />
        
        <?= __('slug') ?> (<?= __('slug_describ') ?>) <input type="text" name="slug" /><br />
        
        <textarea name="content" ></textarea><br />
        
        <input type="text" name="author" value="<?php  foreach ($author as $my) : echo $my['name']; endforeach; ?>"/><br />
        
        <input type="submit" value="Submit" />
        
    </form>
        
        <?php  endif; ?>