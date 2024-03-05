<?php
require 'connection.php';

if(isset($_POST["id"])) {
    $id = $_POST["id"];

    // Fetch the data from the slider table based on the ID
    $query = "SELECT * FROM slider WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if(isset($_POST["submit"])) {
            // Retrieve updated data from the form
            $name = $_POST["name"];
            $title = $_POST["titlo"];
            $descricao = $_POST["descricao"];

            // Check if a new image was uploaded
            if ($_FILES["image"]["error"] === 0) {
                $fileName = $_FILES["image"]["name"];
                $tmpName = $_FILES["image"]["tmp_name"];
                $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Move the uploaded image to the destination folder
                $newImageName = uniqid() . '.' . $imageExtension;
                move_uploaded_file($tmpName, 'img/' . $newImageName);

                // Update the image path in the database
                $update_query = "UPDATE slider SET image=? WHERE id=?";
                $update_stmt = mysqli_prepare($conn, $update_query);
                mysqli_stmt_bind_param($update_stmt, "si", $newImageName, $id);
                mysqli_stmt_execute($update_stmt);
            }

            // Update the other details in the database
            $update_query = "UPDATE slider SET name=?, titlo=?, descricao=? WHERE id=?";
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, "sssi", $name, $title, $descricao, $id);
            mysqli_stmt_execute($update_stmt);

            echo "<script>
            alert('SUCESS')
            document.location.href='data.php';
          </script>";
        }

        // Display the details in an editable form
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="teste.css">
            <title>details</title>
        </head>
        <h1>Edit Details</h1>
        <form action="" method="post" enctype="multipart/form-data" class="detailsFrom">
            <div class="infoConteiner">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>"><br>
            <label for="titlo">Title:</label>
            <input type="text" name="titlo" id="titlo" value="<?php echo $row['titlo']; ?>"><br>
            <label for="descricao">Description:</label>
            <input type="text" name="descricao" id="descricao" value="<?php echo $row['descricao']; ?>"><br>
            </div>
            <div class="imageConteiner">
                <label for="image">Image:</label>
                <img src="img/<?php echo $row['image']; ?>" /><br>
                <input type="file" name="image" id="image"><br>
                <button type="submit" name="submit">Confirm Changes</button>
            </div>
        </form>
        <?php
    } else {
        echo "No details found.";
    }
} else {
    echo "No details to display.";
}
?>
