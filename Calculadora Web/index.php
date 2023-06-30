<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#calculateBtn").click(function() {
                var expression = $("#expressionInput").val();
                $.ajax({
                    type: "POST",
                    url: "Calculadora.php",
                    data: { Exp: expression },
                    success: function(result) {
                        $("#result").html(result);
                        $("#resultSection").show();
                    },
                    error: function() {
                        alert("An error occurred while processing the request.");
                    }
                });
            });
        });
    </script>
    <style>
        #resultSection {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Calculadora</h1>
    <p>Esta calculadora funciona com expressões aritméticas. Apenas das 4 operações básicas.</p>
    <p>Insira sua expressão encadeando operandos e operadores.</p>
    <label for="expressionInput">Insira sua expressão:</label>
    <input type="text" id="expressionInput" name="expressionInput">
    <button id="calculateBtn">Calcular</button>
    
    <div id="resultSection">
        <h2>Resultado:</h2>
        <div id="result"></div>
    </div>
</body>
</html>
