<?php
foreach($entries as $entry): ?>
<h2><?php echo $entry->title; ?></h2>
<p><?php echo Darkmown::parse($entry->content); ?></p>

<?php endforeach; ?>
