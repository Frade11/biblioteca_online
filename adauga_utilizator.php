<?php
include 'db_connect.php';

$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = trim($_POST['nume']);
    $prenume = trim($_POST['prenume']);
    $email = trim($_POST['email']);
    $telefon = trim($_POST['nr_telefon']);

    if (!empty($nume) && !empty($prenume) && !empty($email)) {
        $stmt = $conn->prepare("INSERT INTO utilizatori_biblioteca (nume, prenume, email, nr_telefon) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nume, $prenume, $email, $telefon);
        
        if ($stmt->execute()) {
            $message = "Utilizatorul a fost adăugat cu succes!";
            $message_type = "success";
        } else {
            $message = "Eroare la adăugarea utilizatorului: " . $conn->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "Numele, prenumele și email-ul sunt obligatorii!";
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga Utilizator - Biblioteca Online</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/bookStore-logo.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👥 Adauga Utilizator Nou</h1>
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
                        <label for="nume">Nume *</label>
                        <input type="text" id="nume" name="nume" required>
                    </div>

                    <div class="form-group">
                        <label for="prenume">Prenume *</label>
                        <input type="text" id="prenume" name="prenume" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="nr_telefon">Numar Telefon</label>
                        <input type="tel" id="nr_telefon" name="nr_telefon">
                    </div>

                    <button type="submit" class="btn">Adauga Utilizator</button>
                    <a href="index.php" class="nav-btn" style="margin-left: 10px;">Inapoi la pagina principala</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>