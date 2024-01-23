<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Suscripción</h2>

    <form action="" method="post">
        <label for="card_number">Número de Tarjeta de Crédito:</label>
        <input type="text" id="card_number" name="card_number" required>

        <label for="expiration_date">Fecha de Expiración (MM/AA):</label>
        <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/AA" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>

        <button type="submit">Suscribirse</button>
    </form>
</body>
</html>
