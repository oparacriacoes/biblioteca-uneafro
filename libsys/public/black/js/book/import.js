document.getElementById("csv-file").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (!file?.name?.endsWith(".csv")) {
        alert("Por favor selecione um arquivo CSV válido.");
        return;
    }

    // Le o conteudo do arquivo CSV
    let reader = new FileReader();
    reader.onload = function(event) {
        let csv = event.target.result;
        let lines = csv.split(/\r?\n/);
        let invalidRows = [];
        let rowIndexes = [];

        // Verifica as linhas que contem valores invalidos
        for (let i = 1; i < lines.length - 1; i++) {
            let values = lines[i].split(";");

            let validatedBookTitle = values[0] && values[0].length <= 50;
            let validatedAuthor = values[1] && validateName(values[1]);
            let validatedBookPublisher = values[2] && values[2].length <= 30;
            let validatedEdition = values[3] && validateNumber(values[3]);
            let validatedVolume = values[4] && validateNumber(values[4]);
            let validatedYear= values[5] && validateNumber(values[5]);
            let validatedCopies = values[6] && validateNumber(values[6]);
            let validatedReferenceBook = values[7] && validateNumber(values[7]);
            let validatedIsbn = values[8] && validateIsbn(values[8]);

            if (!validatedBookTitle || !validatedAuthor || !validatedBookPublisher || !validatedEdition
                || !validatedVolume || !validatedYear || !validatedCopies || !validatedReferenceBook || !validatedIsbn) {
                invalidRows.push(i + 1);
                rowIndexes.push(i - 1);
            }
        }

        // Exibe as linhas com valores invalidos
        let rowsDiv = document.getElementById("csv-rows");
        rowsDiv.innerHTML = "";
        if (invalidRows.length > 0) {
            let message = "<p style='color: white;'>As seguintes linhas possuem valores inválidos e não serão"
                + " incluídas: </p><ul>";
            for (const row of invalidRows) {
                message += "<li>Linha: " + row + "</li>";
            }
            message += "</ul>";
            rowsDiv.innerHTML = message;
        }
        let invalidRowsInput = document.getElementById("invalid-rows");
        invalidRowsInput.value = JSON.stringify(rowIndexes);
    };
    reader.readAsText(file);
});
