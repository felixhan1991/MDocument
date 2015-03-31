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
    <section id="container">
    <?php echo $template['partials']['header']; ?>
    <?php echo $template['partials']['left-sidebar']; ?>
    
        <section id="main-content">
        <section class="wrapper">
        <?php  echo $template['body']; 
                //print_r($template['body']);?>
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </section>
        </section>
    </section>
    
    <?php echo $template['partials']['script-footer']; ?>
</body>
</html>