<?php

include_once("config/Data.php");

$data = new Data();

$query = "SELECT * FROM users ORDER BY id DESC";
$result = $data->run($query);
?>

<html>
    <head>
        <title>OOP Local test</title>
    </head>
    
    <body>
        <a href="add.php">Add user test</a>
        <br/>
        <br/>
        <table width='50%' border=0>
            <tr bgcolor='#d3d3d3'>
                <td>Name</td>
                <td>Birthday</td>
                <td>Email</td>
                <td>Actions</td>
            </tr>
            <?php
                foreach ($result as $key => $res) {
                    echo '<tr>';
                    echo '<td>'.$res['name'].'</td>';
                    echo '<td>'.$res['birthday'].'</td>';
                    echo '<td>'.$res['email'].'</td>';
                    echo '<td>'.
                            "<a href='edit.php?id=$res[id]'>Edit</a> | <a href='delete.php?id=$res[id]' onClick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>".
                        '</td>';
                }
            ?>
        </table>
    </body>
</html>
