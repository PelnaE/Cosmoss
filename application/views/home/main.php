<?php
if (!empty($entries)): //Checks if in database are any entry
    foreach ($entries as $entry): //Make array, if $entries is not empty
        ?>
        <div class="article">
            <h2><a href="<?php echo URL::site('entry/'.$entry['id'].'/'.$entry['slug']); ?>"><?php echo $entry['title']; ?></a></h2>
            <p><?= __('entry_created') ?> <?php echo date('d.m.Y H:i:s', $entry['date']); ?> <?= __('entry_author') ?> <?php echo $entry['author']; ?></p>
            <p><?php echo Darkmown::parse($entry['content']); //This is Markdown. See MARKDOWN in github.  ?></p>
        </div>
        <?php
    endforeach;
    echo $pagination;
else: //...and, if there are no entries, they show message about it
    ?>
    <h3>There are no entries!</h3>
    <p>You are there, but entries aren't there!</p>
<?php
endif;
?>
