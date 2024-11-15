<!DOCTYPE html>
<head lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cake con Vite y Vue</title>
        <?php echo $this->Inertia->loadAssets();?>
    </head>
<body>
    <?= $this->Inertia->component($page, 'app', ''); ?>
</body>
</html>
