<?php
include 'db_connect.php';

$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titlu = trim($_POST['titlu_carte']);
    $disponibil = isset($_POST['stare_disponibilitate']) ? 1 : 0;

    if (!empty($titlu)) {
        $stmt = $conn->prepare("UPDATE carti_biblioteca SET stare_disponibilitate = ? WHERE titlu_carte = ?");
        $stmt->bind_param("is", $disponibil, $titlu);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $message = "Starea de disponibilitate a fost actualizata cu succes!";
                $message_type = "success";
            } else {
                $message = "Nu s-a gasit nicio carte cu acest titlu!";
                $message_type = "error";
            }
        } else {
            $message = "Eroare la actualizare: " . $conn->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "Selectati o carte!";
        $message_type = "error";
    }
}

$books_result = $conn->query("SELECT titlu_carte FROM carti_biblioteca ORDER BY titlu_carte");
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizeaza Disponibilitate - Biblioteca Online</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/bookStore-logo.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Actualizeaza Disponibilitate Carte</h1>
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
                        <label for="titlu_carte">Selecteaza Cartea</label>
                        <select id="titlu_carte" name="titlu_carte" required>
                            <option value="">Alege o carte...</option>
                            <?php while ($book = $books_result->fetch_assoc()): ?>
                                <option value="<?php echo htmlspecialchars($book['titlu_carte']); ?>">
                                    <?php echo htmlspecialchars($book['titlu_carte']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="stare_disponibilitate" checked>
                            Disponibila pentru imprumut
                        </label>
                    </div>

                    <button type="submit" class="btn">Actualizeaza Disponibilitatea</button>
                    <a href="index.php" style="margin-left: 10px;">Inapoi la pagina principala</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>