<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php print $toDo->name; ?></title>
    </head>
    <body>
        <h1><?php print $toDo->name; ?></h1>
        <div>
            <span class="label">Status:</span>
            <?php print $toDo->status; ?>
        </div>
        
    </body>
</html>



