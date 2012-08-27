<h2><a href="<?=URL::site('cp')?>"><?=__('admincp')?></a> &mdash; <a href="<?=URL::site('cp/pages')?>"><?=__('pages')?></a></h2>
<?php $user_session = Session::instance()->get('user'); ?>

<?php if (empty($user_session)): ?>
    <h3>Session Error!</h3>
    <p>Please check if you are logged in!</p>
<?php else: ?>
    
    <?php
if(!empty($pages)):
    foreach ($pages as $page):
    ?><p><?php echo $page['id']; ?>. <a href="<?php echo URL::site('cp/pages/edit/'.$page['id']); ?>"><?php echo $page['title']; ?></a></p>
    <?php endforeach;
endif;
endif;
?>
