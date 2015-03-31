<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title><?php echo $template['title'];?></title>
    <?php echo $template['partials']['script-header']; ?>
</head>
<body>
    <div class="panel-body">
        <?php  echo $template['body']; ?>        
    </div>
    <?php echo $template['partials']['script-footer']; ?>
</body>
</html>
