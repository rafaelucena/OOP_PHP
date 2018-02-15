<?php

include_once("config/Data.php");

$data = new Data();

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    
    $result = $data->run("UPDATE users SET name='$name',birthday='$birthday',email='$email' WHERE id=$id");
        
    header("Location: index.php");
} else {
    $id = $_GET['id'];
    
    $result = $data->run("SELECT * FROM users WHERE id = $id");
    
    foreach ($result as $res) {
        $name = $res['name'];
        $birthday = $res['birthday'];
        $email = $res['email'];
    }
    ?>
    <html>
    <head>
        <title>Edit Data</title>
    </head>

    <body>
    <a href="index.php">Home</a>
    <br/><br/>

    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="birthday" value="<?php echo $birthday; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
    </body>
    </html>
<?php
}
?>