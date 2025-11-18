<?php
// Report 1: Users registered in last 30 days
echo "<h3>Utilizatori înregistrați în ultimele 30 de zile</h3>";
$result1 = $conn->query("SELECT * FROM utilizatori_biblioteca WHERE data_inregistrare >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
displayUsersTable($result1);

// Report 2: Users with .edu email domain
echo "<h3>Utilizatori cu email .edu</h3>";
$result2 = $conn->query("SELECT * FROM utilizatori_biblioteca WHERE email LIKE '%@edu%'");
displayUsersTable($result2);

// Function to display users table
function displayUsersTable($result) {
    if ($result && $result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table class="data-table">';
        echo '<thead><tr><th>Nume</th><th>Prenume</th><th>Email</th><th>Telefon</th><th>Data Înregistrare</th></tr></thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
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
    } else {
        echo '<p>Nu s-au găsit utilizatori care să îndeplinească criteriile.</p>';
    }
}
?>