<?php include_once './DBconnect.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <body>
        <h2>Results page</h2>

        <?php
        if (isset($_POST['search_submit'])) {
            $search_input = strtolower(htmlentities($_POST['search_text']));

            $search = "'%$search_input%'";

            $sql = "SELECT * FROM contact WHERE LOWER(first_name) LIKE $search OR LOWER(last_name) LIKE $search OR LOWER(city) LIKE $search OR LOWER(email) LIKE $search;";

            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result) == 0) {
                ?>
                <div class="search">
                    No results found.
                </div>
                <?php
            } else {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="results_div">
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
                            <input type="submit" class="btn2" name="edit" value="Edit contact">
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
        }
        ?>
        <br/>
        <button onclick="location.href = 'phonebook_index.php';" class="btn1">Home page</button>
    </body>
</html>