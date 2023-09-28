var searchInput = document.getElementById('search');
    var rows = document.querySelectorAll('tbody tr'); // Seleziona tutte le righe della tabella

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase(); // Ottieni il testo di ricerca in minuscolo

        rows.forEach(function (row) {
            var nameCell = row.querySelector('td:nth-child(1)'); // Seleziona la cella Nome
            var tipoCell = row.querySelector('td:nth-child(2)'); // Seleziona la cella Tipo

            var nameMatch = nameCell.textContent.toLowerCase().includes(searchTerm); // Verifica se il Nome contiene il testo di ricerca
            var tipoMatch = tipoCell.textContent.toLowerCase().includes(searchTerm); // Verifica se il Tipo contiene il testo di ricerca

            if (nameMatch || tipoMatch) {
                row.style.display = ''; // Mostra la riga se c'è una corrispondenza
            } else {
                row.style.display = 'none'; // Nascondi la riga se non c'è una corrispondenza
            }
        });
    });