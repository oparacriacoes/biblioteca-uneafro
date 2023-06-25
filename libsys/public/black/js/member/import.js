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

        // Verifica as linhas que contem valores invalidos
        for (let i = 1; i < lines.length - 1; i++) {
            let values = lines[i].split(";");

            let validatedFullName = values[0] && validateFullName(values[0]);
            let validatedIdMembeType = values[1] == 1 || values[1] == 2;
            let validatedEmail = isEmpty(values[2]) ? true : validateEmail(values[2]);
            let validatedPhone = isEmpty(values[3]) ? true : validatePhone(values[3]);
            let validatedCPF = isEmpty(values[4]) ? true : validateCPF(values[4]);

            if (!validatedFullName || !validatedIdMembeType || !validatedEmail || !validatedPhone
                    || !validatedCPF) {
                invalidRows.push(i + 1);
            }
        }

        // Exibe as linhas com valores invalidos
        let rowsDiv = document.getElementById("csv-rows");
        rowsDiv.innerHTML = "";
        if (invalidRows.length > 0) {
            let message = "<p style='color: white;'>As seguintes linhas possuem valores inválidos e não serão"
                + " incluídas: </p><ul>";
            for (const row of invalidRows) {
                message += "<li>LInha: " + row + "</li>";
            }
            message += "</ul>";
            rowsDiv.innerHTML = message;
        }
        let invalidRowsInput = document.getElementById("invalid-rows");
        invalidRowsInput.value = JSON.stringify(invalidRows);
    };
    reader.readAsText(file);
});
