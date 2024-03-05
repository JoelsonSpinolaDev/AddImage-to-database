<?php require 'connection.php' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Slider</title>
    </head>
    <body>
    <table border=1 cellspacing=0 cellpadding=10>
            <tr>
                <td>id</td>
                <td>nome</td>
                <td>img</td>
                <td>titlo</td>
                <td>descrição</td>
            </tr>
            <?php
            $i=1;
            $rows=mysqli_query($conn,"SELECT * FROM slider ORDER BY id");
            ?>
            <?php foreach($rows as $row):?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><img src="img/<?php echo $row['image'];?>"/></td>
                <td><?php echo $row["titlo"]; ?></td>
                <td><?php echo $row["descricao"];?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>



<?php
$title1==mysqli_query($conn,"SELECT h4_title_info FROM quadrado_info ORDER BY id=1");
$title2==mysqli_query($conn,"SELECT h4_title_info FROM quadrado_info ORDER BY id=2");
$title3=mysqli_query($conn,"SELECT h4_title_info FROM quadrado_info ORDER BY id=3");
            ?>
