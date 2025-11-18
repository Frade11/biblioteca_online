<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapoarte Speciale - Biblioteca Online</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/bookStore-logo.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="images/bookStore-logo.png" alt="logo">
            <h1>Rapoarte Speciale</h1>
        </div>

        <div class="section">
            <h2>Operatiuni de Gestionare</h2>
            
            <div class="nav-menu">
                <form method="POST" style="display: inline;">
                    <button type="submit" name="sterge_carti_fara_autor" class="nav-btn">Sterge Carti fara Autor</button>
                </form>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="sterge_utilizatori_fara_telefon" class="nav-btn">Sterge Utilizatori fara Telefon</button>
                </form>
            </div>

            <?php
            // Delete books without author
            if (isset($_POST['sterge_carti_fara_autor'])) {
                $result = $conn->query("DELETE FROM carti_biblioteca WHERE autor IS NULL OR autor = ''");
                if ($result) {
                    echo '<div class="alert alert-success">Cărțile fără autor au fost șterse cu succes!</div>';
                }
            }

            // Delete users without phone
            if (isset($_POST['sterge_utilizatori_fara_telefon'])) {
                $result = $conn->query("DELETE FROM utilizatori_biblioteca WHERE nr_telefon IS NULL OR nr_telefon = ''");
                if ($result) {
                    echo '<div class="alert alert-success">Utilizatorii fără număr de telefon au fost șterși cu succes!</div>';
                }
            }
            ?>

            <h3>Toate Cartile</h3>
            <?php
            $all_books = $conn->query("SELECT * FROM carti_biblioteca ORDER BY titlu_carte");
            if ($all_books && $all_books->num_rows > 0) {
                echo '<div class="table-container">';
                echo '<table class="data-table">';
                echo '<thead><tr><th>Titlu</th><th>Autor</th><th>Gen</th><th>An</th><th>Pagini</th><th>Disponibilitate</th></tr></thead>';
                echo '<tbody>';
                while ($row = $all_books->fetch_assoc()) {
                    $disponibil = $row['stare_disponibilitate'] ? 
                        '<span class="available">Disponibil</span>' : 
                        '<span class="unavailable">Indisponibil</span>';
                    echo "<tr>
                        <td>{$row['titlu_carte']}</td>
                        <td>" . ($row['autor'] ? $row['autor'] : '<em>nespecificat</em>') . "</td>
                        <td>{$row['gen_literar']}</td>
                        <td>{$row['an_publicare']}</td>
                        <td>{$row['nr_pagini']}</td>
                        <td>{$disponibil}</td>
                    </tr>";
                }
                echo '</tbody></table></div>';
            }
            ?>

            <h3>Toti Utilizatorii</h3>
            <?php
            $all_users = $conn->query("SELECT * FROM utilizatori_biblioteca ORDER BY nume, prenume");
            if ($all_users && $all_users->num_rows > 0) {
                echo '<div class="table-container">';
                echo '<table class="data-table">';
                echo '<thead><tr><th>Nume</th><th>Prenume</th><th>Email</th><th>Telefon</th><th>Data Înregistrare</th></tr></thead>';
                echo '<tbody>';
                while ($row = $all_users->fetch_assoc()) {
                    $telefon = $row['nr_telefon'] ? $row['nr_telefon'] : '<em>nespecificat</em>';
                    echo "<tr>
                        <td>{$row['nume']}</td>
                        <td>{$row['prenume']}</td>
                        <td>{$row['email']}</td>
                        <td>{$telefon}</td>
                        <td>{$row['data_inregistrare']}</td>
                    </tr>";
                }
                echo '</tbody></table></div>';
            }
            ?>
        </div>

        <a href="index.php" class="nav-btn">Inapoi la pagina principala</a>
    </div>
</body>
</html>