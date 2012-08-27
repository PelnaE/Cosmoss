<?php
foreach($entries as $entry): ?>
<h2><?php echo $entry->title; ?></h2>
<p><?php echo Text::markdown($entry->content); ?></p>

<?php endforeach; ?>