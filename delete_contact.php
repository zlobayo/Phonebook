<?php session_start(); ?>
<?php include_once './DBconnect.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>

    </style>
    <body>
        <h2>Delete contact</h2>
        <div>           
            <?php
            if (isset($_POST['delete'])) {
                $id = htmlentities($_POST['id']);

                $sql = "DELETE FROM contact WHERE id = $id";

                $result = $mysqli->query($sql);
                if ($mysqli->query($sql) === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    echo "Contact deleted";
                }
            }
            ?>
            <p>
                <button onclick="location.href = 'phonebook_index.php';" class="button">Home page</button>
            </p>
    </body>
</html>
