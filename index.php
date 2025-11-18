<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/bookStore-logo.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="images/bookStore-logo.png" alt="logo">
            <h1>Biblioteca Online</h1>
            <p>Sistem de gestionare a cartilor si utilizatorilor</p>
        </div>

        <div class="nav-menu">
            <a href="#carti" class="nav-btn">Gestionare Cărți</a>
            <a href="#utilizatori" class="nav-btn">Gestionare Utilizatori</a>
            <a href="#rapoarte" class="nav-btn">Rapoarte</a>
        </div>

        <!-- Books Section -->
        <div id="carti" class="section">
            <h2>Gestionare Cărți</h2>
            
            <div class="nav-menu">
                <a href="adauga_carte.php" class="nav-btn">Adauga Carte Noua</a>
                <a href="actualizeaza_disponibilitate.php" class="nav-btn">Actualizează Disponibilitate</a>
            </div>

            <?php
            // Display books reports
            include 'rapoarte_carti.php';
            ?>
        </div>

        <!-- Users Section -->
        <div id="utilizatori" class="section">
            <h2>Gestionare Utilizatori</h2>
            
            <div class="nav-menu">
                <a href="adauga_utilizator.php" class="nav-btn">Adauga Utilizator Nou</a>
            </div>

            <?php
            // Display users reports
            include 'rapoarte_utilizatori.php';
            ?>
        </div>

        <!-- Reports Section -->
        <div id="rapoarte" class="section">
            <h2>Rapoarte Speciale</h2>
            
            <div class="nav-menu">
                <a href="rapoarte_speciale.php" class="nav-btn">Vezi Rapoarte Detaliate</a>
            </div>
        </div>
    </div>
</body>
</html>