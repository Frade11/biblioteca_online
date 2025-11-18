<?php
// Report 1: Books from "Fictiune" genre
echo "<h3>Cărți din genul 'Ficțiune'</h3>";
$result1 = $conn->query("SELECT * FROM carti_biblioteca WHERE gen_literar = 'Ficțiune'");
displayBooksTable($result1);

// Report 2: Books published after 2000
echo "<h3>Cărți publicate după anul 2000</h3>";
$result2 = $conn->query("SELECT * FROM carti_biblioteca WHERE an_publicare > 2000");
displayBooksTable($result2);

// Report 3: Books with more than 300 pages that are available
echo "<h3>Cărți cu peste 300 de pagini disponibile</h3>";
$result3 = $conn->query("SELECT * FROM carti_biblioteca WHERE nr_pagini > 300 AND stare_disponibilitate = TRUE");
displayBooksTable($result3);

// Function to display books table
function displayBooksTable($result) {
    if ($result && $result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table class="data-table">';
        echo '<thead><tr><th>Titlu</th><th>Autor</th><th>Gen</th><th>An</th><th>Pagini</th><th>Disponibilitate</th></tr></thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            $disponibil = $row['stare_disponibilitate'] ? 
                '<span class="available">Disponibil</span>' : 
                '<span class="unavailable">Indisponibil</span>';
            echo "<tr>
                <td>{$row['titlu_carte']}</td>
                <td>{$row['autor']}</td>
                <td>{$row['gen_literar']}</td>
                <td>{$row['an_publicare']}</td>
                <td>{$row['nr_pagini']}</td>
                <td>{$disponibil}</td>
            </tr>";
        }
        echo '</tbody></table></div>';
    } else {
        echo '<p>Nu s-au găsit cărți care să îndeplinească criteriile.</p>';
    }
}
?>