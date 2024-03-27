<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Calculadora de Salário de Vendedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
</head>
<body>
 
<h2>Calculadora de Salário de Vendedor</h2>
 
<form method="post">
    <div class="form-group">
        <label for="nome_vendedor">Nome do Vendedor:</label>
        <input type="text" name="nome_vendedor" id="nome_vendedor" required>
    </div>
    <div class="form-group">
        <label for="meta_semanal">Meta Semanal (em R$):</label>
        <input type="number" name="meta_semanal" id="meta_semanal" required>
    </div>
    <div class="form-group">
        <label for="meta_mensal">Meta Mensal (em R$):</label>
        <input type="number" name="meta_mensal" id="meta_mensal" required>
    </div>
    <button type="submit">Calcular Salário</button>
</form>
 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todas as variáveis POST necessárias estão definidas
    if (isset($_POST['nome_vendedor'], $_POST['meta_semanal'], $_POST['meta_mensal'])) {
        // Função para calcular o salário do vendedor
        function calcularSalarioVendedor($vendas_semanais, $salario_minimo) {
            $meta_semanal = $_POST['meta_semanal']; // Meta semanal informada pelo usuário
            $meta_mensal = $_POST['meta_mensal']; // Meta mensal informada pelo usuário
        
            // Calcula o valor sobre a meta semanal
            $valor_sobre_meta_semanal = ($vendas_semanais >= $meta_semanal) ? ($meta_semanal * 0.01) : 0;
        
            // Calcula o excedente de meta semanal
            $excedente_semanal = ($vendas_semanais > $meta_semanal) ? ($vendas_semanais - $meta_semanal) : 0;
            $valor_excedente_semanal = ($excedente_semanal > 0) ? ($excedente_semanal * 0.05) : 0;
        
            // Calcula o excedente de meta mensal (apenas se todas as metas semanais foram cumpridas)
            $excedente_mensal = ($vendas_semanais == $meta_mensal) ? ($vendas_semanais - $meta_mensal) : 0;
            $valor_excedente_mensal = ($excedente_mensal > 0) ? ($excedente_mensal * 0.1) : 0;
        
            // Calcula o salário final
            $salario_final = $salario_minimo + $valor_sobre_meta_semanal + $valor_excedente_semanal + $valor_excedente_mensal;
        
            return $salario_final;
        }
        
        // Valores informados pelo usuário
        $nome_vendedor = $_POST['nome_vendedor'];
        $meta_semanal = $_POST['meta_semanal']; // Considerando que as vendas semanais correspondem à meta semanal para simplificação
        $salario_minimo = 1500; // Salário mínimo
        
        // Correção do erro: usar $_POST['meta_semanal'] em vez de $vendas_semanais
        $salario_final = calcularSalarioVendedor($meta_semanal, $salario_minimo);
        
        // Exibe o resultado
        echo "<h3>Resultado para $nome_vendedor:</h3>";
        echo "<p>Salário final do vendedor: R$ " . number_format($salario_final, 2, ',', '.') . "</p>";
    } else {
        // Tratamento de erro: informa ao usuário que todos os campos obrigatórios devem ser preenchidos
        echo "<p class='error'>Todos os campos são obrigatórios.</p>";
    }
}
?>
 
</body>
</html>
