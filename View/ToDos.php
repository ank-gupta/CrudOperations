
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> TODO </title>
        <style type="text/css">
            table.done {
                width: 100%;
            }
            
            table.done thead {
                background-color:yellow;
                text-align: left;
            }
            
            table.done thead th {
                border: solid 1px #fff;
                padding: 3px;
            }
            
            table.done tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }
            
            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div align="center"><a href="index.php?op=new">Add new Entry </a></div><br>      
        <table class="done" border="1" cellpadding="1" cellspacing="1">
            <thead>
                <tr>
                    <th><a href="?orderby=name">Name</a></th>
                    <th><a href="?orderby=status">Status</a></th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($ToDos as $ToDo): ?>
                <tr>
                    <td><a href="index.php?op=show&id=<?php print $ToDo->id; ?>">
                        <?php print htmlentities($ToDo->name); ?></a></td>
                    <td><?php print htmlentities($ToDo->status); ?></td>
                    
                    <td><a href="index.php?op=delete&id=<?php print $ToDo->id; ?>">Delete</a></td>
                    <td><a href="index.php?op=update&id=<?php print $ToDo->id; ?>">Update</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>


