<?php
foreach ($posts as $post):
?>
<h2>test ViewHome view</h2>
<h2><?= $post->getTitle() ?> </h2>
<?php endforeach; ?>

