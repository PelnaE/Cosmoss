<h2><a href="<?= URL::site('cp') ?>"><?= __('admincp') ?></a> &mdash; <a href="<?= URL::site('cp/entries') ?>"><?= __('entries') ?></a></h2>
<?php $user_session = Session::instance()->get('user'); ?>

<?php if(empty($user_session)):?>
<h3>Session error!</h3><p>You must be signed in!</p>
<?php else: ?>
<?php if (!empty($success)): ?>
    <p>Article has been saved!</p><a href="'<?= URL::site('cp/entries') ?>'"></a>
<?php endif; ?>
    
<?php foreach ($entries as $entry): ?>
    <form action="<?= URL::site('cp/entries/edit/' .$entry->id) ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= Security::token() ?>" />
        <input type="text" name="title" value="<?= $entry->title ?>" /><br />
        <textarea name="content" id="" cols="30" rows="10"><?= $entry->content ?></textarea><br />
        <input type="submit" value="Edit!" />
    </form>
    
<?php endforeach; ?>
    
<?php endif; ?>