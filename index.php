<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="teste.css">
    <title>Table</title>
</head>
<body>
    <table>
        <tr>
            <td>Image</td>
            <td>Title</td>
            <td>Name</td>
            <td>Action</td>
        </tr>
        <?php
            require 'connection.php';

            $rows = mysqli_query($conn, "SELECT * FROM slider ORDER BY id");

            foreach($rows as $row) {
                echo "<tr>";
                echo "<td><img src='img/" . $row['image'] . "' class='tamanho'/></td>";
                echo "<td>" . $row['titlo'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><form action='details.php' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><button type='submit' name='details'>Details</button></form></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
