<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .book-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .book {
            width: 30%; 
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .book img {
            max-width: 100%; 
            height: auto; 
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Catalog</h1>
    <a href="profile">Profile</a>
    <div class="book-container">
        <?php foreach ($books as $book) : ?>
            <div class="book">
                <h2><?php echo $book->title; ?></h2>
                <img src="<?php echo $book->image; ?>" alt="Book Image">
                <p><a href="book/read/<?php echo $book->id; ?>">View Details</a></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>