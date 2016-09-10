<?php include_once './DBconnect.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Phonebook</title>
    </head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <body>
        <h2>Phonebook home page</h2>
        <div class="search">           
            <form method="post" action="result_page.php">
                <h4>Search contact </h4>
                <input type="text" id="search_text_id" name="search_text"><br>
                <input type="submit" class="btn1" name="search_submit" value="Search">
            </form>
        </div>
        <br/>       
        <button onclick="location.href = 'add_contact.php';" class="btn1">Add new contact</button>
        <h4>All contacts:</h4>
        <?php
        $sql = "SELECT * FROM contact WHERE 1";
        $rs = $mysqli->query($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR);
        } else {
            while ($row = $rs->fetch_assoc()) {
                ?>
                <div class="contact_div">
                    <table>
                        <tr>
                            <td class="td_id">First name</td>
                            <td><?php echo $row['first_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="td_id">Last name</td>
                            <td><?php echo $row['last_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="td_id">City</td>
                            <td><?php echo $row['city']; ?></td>
                        </tr>
                        <tr>
                            <td class="td_id">E-mail</td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <td class="td_id">Phone number</td>
                            <td><?php echo $row['phone_number']; ?></td>
                        </tr>
                        <tr>
                            <td class="td_id">Additional notes</td>
                            <td><?php echo $row['additional_notes']; ?></td>
                        </tr> 
                    </table>
                    <form method="post" action="edit_contact.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit"class="btn2" name="edit" value="Edit contact">
                    </form>
                    <form method="post" action="delete_contact.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" class="btn2" name="delete" value="Delete contact">
                    </form>
                </div>
                <br/>
                <?php
            }
        }
        ?>
        <br/><br/>
         
    </body>
</html>
