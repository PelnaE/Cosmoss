<h2>
    
    <a href="<?=URL::site('cp')?>"><?=__('admincp')?></a> 
    
    &mdash; 
    
    <a href="<?=URL::site('cp/pages')?>"><?=__('pages')?></a>
    
</h2>


<?php $user_session = Session::instance()->get('user'); ?>

<?php if (empty($user_session)): ?>

    <h3>Session error!</h3>
    
    <p>You must be logged in!</p>
    
<?php else: ?>

    <?php  if (!empty($success)): ?>
    
    <p>Page has been saved</p>
    
    <?php endif; ?>
    
    <?php if(!empty($error)): ?>
    
    <p>There are one or more errors!</p>
    
    <?php endif; ?>
    
    <?php foreach ($pages as $page): ?>
    
        <form action="<?php echo URL::site('cp/pages/edit/' . $page['id']); ?>" method="post">
            
            <input type="hidden" name="csrf_token" value="<?php echo Security::token(); ?>" />
            
            Title <input type="text" name="title" value="<?php echo $page['title']; ?>" /><br />
            
            <textarea name="content" id=""><?php echo $page['content']; ?></textarea>
            
            <input type="submit" value="Edit!" />
            
        </form>
    
    <?php endforeach; ?>

<?php endif; ?>