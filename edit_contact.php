<?php include_once './DBconnect.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <h2>Edit contact</h2>
        <div>           
            <?php
            if (isset($_POST['edit'])) {
                $id = htmlentities($_POST['id']);

                $sql = "SELECT * FROM contact WHERE id = $id";

                $result = $mysqli->query($sql);
                if ($result === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
                } else {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <form method="post">
                            First name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"><br/>
                            Last name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"><br/>
                            City: <input type="text" name="city" value="<?php echo $row['city']; ?>"><br/>
                            E-mail: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br/>
                            Phone number: <input type="text" name="phone_number" value="<?php echo $row['phone_number']; ?>"><br/>
                            Additional notes: <textarea rows="3" cols="40"name="additional_notes"><?php echo $row['additional_notes']; ?></textarea><br/>
                            <input type="hidden" class="btn2" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" class="btn2" name="save_changes" value="Save">
                        </form>
                        <?php
                    }
                }
            }
            if (isset($_POST['save_changes'])) {

                try {
                    if (empty($_POST['first_name'])) {
                        throw new Exception("<br><br>Please, fill in all the fields!");
                    } else {
                        $first_name_input = htmlentities($_POST['first_name']);
                    }
                    if (empty($_POST['last_name'])) {
                        throw new Exception("<br><br>Please, fill in all the fields!");
                    } else {
                        $last_name_input = htmlentities($_POST['last_name']);
                    }
                    if (empty($_POST['city'])) {
                        throw new Exception("<br><br>Please, fill in all the fields!");
                    } else {
                        $city_input = htmlentities($_POST['city']);
                    }
                    if (empty($_POST['email'])) {
                        throw new Exception("<br><br>Please, fill in all the fields!");
                    } else {
                        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
                        if (preg_match($pattern, $_POST['email']) === 1) {
                            $email_input = htmlentities($_POST['email']);
                        } else {
                            throw new Exception("<br><br>Invalid e-mail!");
                        }
                    }
                    if (empty($_POST['phone_number'])) {
                        throw new Exception("<br><br>Please, fill in all the fields!");
                    } else {
                        $pattern = '/[+0-9]{9,}/';
                        if (preg_match($pattern, $_POST['phone_number']) === 1) {
                             $phone_number_input = htmlentities($_POST['phone_number']);
                        } else {
                            throw new Exception("<br><br>Invalid phone number!");
                        }                      
                    }
                    if (empty($_POST['additional_notes'])) {
                        throw new Exception("<br><br>Please, fill in all the fields!");
                    } else {
                        $additional_notes_input = htmlentities($_POST['additional_notes']);
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                if (!empty($first_name_input) && !empty($last_name_input) && !empty($city_input) && !empty($email_input) && !empty($phone_number_input) && !empty($additional_notes_input)) {

                    $id = htmlentities($_POST['id']);
                    $first_name = "'$first_name_input'";
                    $last_name = "'$last_name_input'";
                    $city = "'$city_input'";
                    $email = "'$email_input'";
                    $phone_number = "'$phone_number_input'";
                    $additional_notes = "'$additional_notes_input'";

                    $sql_edit = "UPDATE contact SET first_name=$first_name,last_name=$last_name,city=$city,email=$email,phone_number=$phone_number,additional_notes=$additional_notes WHERE id = $id";

                    if ($mysqli->query($sql_edit) === false) {
                        trigger_error('Wrong SQL: ' . $sql_edit . ' Error: ' . $mysqli->error, E_USER_ERROR);
                    } else {
                        echo "<br/>Saved changes of contact with name $first_name!<br/>";
                    }
                }
            }
            ?>
            <br/>
            <button onclick="location.href = 'phonebook_index.php';" class="button">Home page</button>
    </body>
</html>
