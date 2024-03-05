<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider</title>
    <style>
        .slider {
            width: 100%;
            min-height: 70vh;
            overflow: hidden;
            margin: auto;
        }
        .slider-content {
            display: flex;
            transition: transform 0.5s ease;
            min-height: 70vh;
            background-position: center center;
        }
        .slide {
            flex: 0 0 auto;
            width: 100%;
            background-size: cover;
            background-position: center;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
    <div class="slider">
        <div class="slider-content">
            <?php
            require 'connection.php';

            $rows = mysqli_query($conn, "SELECT * FROM slider ORDER BY id LIMIT 4");
            foreach($rows as $row):?>
                <div class="slide" style="background-image: url('img/<?php echo $row['image'];?>');background-repeat: no-repeat;
            background-size:contain;  background-position: center center; ">
                    <h2><?php echo $row["titlo"]; ?></h2>
                    <p><?php echo $row["descricao"];?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const sliderContent = document.querySelector('.slider-content');

        function showSlides() {
            slideIndex++;
            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }
            sliderContent.style.transform = `translateX(-${slideIndex * 100}%)`;
            setTimeout(showSlides, 3000); // Change slide every 3 seconds
        }

        showSlides();
    </script>
</body>
</html>
