<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="style.css" rel="stylesheet" />
    </head>

    <body>
        <h1>Voici la liste de tous les posts!</h1>

        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <?= $post['title'] ?> -
                    <?= $post['chapo'] ?> -
                    <?= $post['content'] ?>
                </li>

            <?php endforeach; ?>
        </ul>

    </body>
</html>