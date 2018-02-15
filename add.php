<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php

include_once('config/Data.php');

$data = new Data();

if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    
    $result = $data->run("
    INSERT INTO
        users (
            name,
            birthday,
            email
        ) VALUES (
          '$name',
          '$birthday',
          '$email'
        )"
    );
        
    echo "<text color='green'>New user added!";
    echo "<br/><a href='index.php'>View user test</a>";
    
} else { ?>
    <html>
    <head>
        <title>Add Data</title>
    </head>

    <body>
        <a href="index.php">Home</a>
        <br/>
        <br/>
        <div id="msg"></div>
        <form action="add.php" method="post" name="user_form" >
            <table width="25%" border="0">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td><input type="text" name="birthday"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Submit" value="Add"></td>
                </tr>
            </table>
        </form>
    </body>
    </html>
    <?php
}
?>
</body>
</html>
