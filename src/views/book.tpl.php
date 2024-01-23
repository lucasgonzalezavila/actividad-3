<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        .book-container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }

        .book-details img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            max-height: 300px; /* Establecer un tamaño máximo para la altura */
        }

        .book-details h2, .book-details p {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <div class="book-container">
        <div class="book-details">
            <img src="<?php echo $book->image; ?>" alt="Book Cover">
            <h2><?php echo $book->title; ?></h2>
            <p><strong>Author:</strong> <?php echo $book->author; ?></p>
            <p><strong>Genre:</strong> <?php echo $book->genre; ?></p>
            <p><strong>Texto:</strong> <?php echo $book->texto
            ; ?></p>
        </div>
    </div>
</body>
</html>
