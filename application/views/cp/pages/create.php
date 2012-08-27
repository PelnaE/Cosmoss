<h2>
    
    <a href="<?=URL::site('cp')?>"><?=__('admincp')?></a> 
    
    &mdash; 
    
    <a href="<?=URL::site('cp/pages')?>"><?=__('pages')?></a>
    
    &mdash;
    
    <a href="<?=URL::site('cp/pages/create')?>"><?=__('create_page')?></a>
    
</h2>
<?php $user_session = Session::instance()->get('user'); ?>

<?php if (empty($user_session)): ?>
    <h3>Session Error!</h3>
    <p>Please check if you are logged in!</p>
<?php else: ?>
    <form action="<?php echo URL::site('cp/pages/create'); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo Security::token(); ?>" />
        <?=__('title')?>: <input style="width: 350px;"type="text" name="title" /><br />
        <textarea name="content" ></textarea><br />
        <input type="text" name="author" value="<?php foreach ($author as $my) : echo $my['name'];
    endforeach; ?>"/><br />
        <input type="submit" value="Submit" />
    </form><?php
endif;
?>