<?php
include 'db_connect.php';

$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titlu = trim($_POST['titlu_carte']);
    $autor = trim($_POST['autor']);
    $gen = trim($_POST['gen_literar']);
    $an = trim($_POST['an_publicare']);
    $pagini = trim($_POST['nr_pagini']);
    $descriere = trim($_POST['descriere']);
    $disponibil = isset($_POST['stare_disponibilitate']) ? 1 : 0;

    if (!empty($titlu)) {
        $stmt = $conn->prepare("INSERT INTO carti_biblioteca (titlu_carte, autor, gen_literar, an_publicare, nr_pagini, descriere, stare_disponibilitate) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiisi", $titlu, $autor, $gen, $an, $pagini, $descriere, $disponibil);
        
        if ($stmt->execute()) {
            $message = "Cartea a fost adaugată cu succes!";
            $message_type = "success";
        } else {
            $message = "Eroare la adaugarea cartii: " . $conn->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "Titlul cartii este obligatoriu!";
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga Carte - Biblioteca Online</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/bookStore-logo.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Adauga Carte Noua</h1>
        </div>

        <div class="section">
            <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="form-container">
                <form method="POST">
                    <div class="form-group">
                        <label for="titlu_carte">Titlu Carte *</label>
                        <input type="text" id="titlu_carte" name="titlu_carte" required>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" id="autor" name="autor">
                    </div>

                    <div class="form-group">
                        <label for="gen_literar">Gen Literar</label>
                        <input type="text" id="gen_literar" name="gen_literar">
                    </div>

                    <div class="form-group">
                        <label for="an_publicare">An Publicare</label>
                        <input type="number" id="an_publicare" name="an_publicare" min="1000" max="2024">
                    </div>

                    <div class="form-group">
                        <label for="nr_pagini">Numar Pagini</label>
                        <input type="number" id="nr_pagini" name="nr_pagini" min="1">
                    </div>

                    <div class="form-group">
                        <label for="descriere">Descriere</label>
                        <textarea id="descriere" name="descriere" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="stare_disponibilitate" checked>
                            Disponibila pentru imprumut
                        </label>
                    </div>

                    <button type="submit" class="btn">Adauga Cartea</button>
                    <a href="index.php" class="nav-btn" style="margin-left: 10px;">Inapoi la pagina principala</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>