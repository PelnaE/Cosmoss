<?php
$session = Session::instance();
$user_session = $session->get('user');
$user_cookie = Cookie::get('user');
if(!empty($user_session)): ?>
    <div class="admin-sidebar">
<h2><?= __('blog') ?>:</h2>
<div class="menu-block-first">
    <p class="menu-item"><a href="<?php echo URL::site('cp/entries/'); ?>" title="List of your entries"><?= __('entries') ?></a></p>
<p class="menu-item"><a href="<?php echo URL::site('cp/entries/write'); ?>" title="Make new blog entry"><?= __('write_entry') ?></a></p>
</div>
<div class="menu-block">
    <p class="menu-item"><a href="<?php echo URL::site('cp/pages'); ?>"><?= __('pages') ?></a></p>
<p class="menu-item"><a href="<?php echo URL::site('cp/pages/create'); ?>"><?= __('create_page') ?></a></p>
</div>
<div class="menu-block-end">
    <p class="menu-item"><a href="<?php echo URL::site('cp/sign_out'); ?>">Logout</a></p>
</div>

</div>
<div class="admin-content">
<h2><?= __('admincp') ?></h2>
<?php 
if(!empty($user_cookie)):
    echo __('cookie_set');
endif;
?>
<p><?= __('welcome_admincp') ?></p>
<p><?= __('precise_date_time') ?>  <?php echo date('d.m.Y H:i:s', time()); ?></p>
</div>
<?php elseif(!empty($user_cookie)):  ?>
<?php Session::instance()->set('user', $user_cookie); ?>
 <?php Request::current()->redirect('cp'); ?>
<?php else: ?>
<h2><?= __('admincp_title') ?></h2>
<h3>Login</h3>
<form action="<?php echo URL::site('cp/sign_in'); ?>" method="post">
    <input type="text" name="nick" /><br />
    <input type="password" name="password" /><br />
    <label><input type="checkbox" name="cookie"  />Remember me!</label>
    <input type="submit" value="OK!" /><br />
</form>
    <?php
endif;
?>