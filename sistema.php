<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário de Vendedor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
<form method="post" class="form-container">
    <h2>Calculadora de Salário de Vendedor</h2>
    <label for="nome_vendedor">Nome do Vendedor:</label>
    <input type="text" name="nome_vendedor" id="nome_vendedor" required><br>
    <label for="meta_semanal">Meta Semanal (em R$):</label>
    <input type="number" name="meta_semanal" id="meta_semanal" required><br>
    <label for="meta_mensal">Meta Mensal (em R$):</label>
    <input type="number" name="meta_mensal" id="meta_mensal" required><br>
    <button type="submit">Calcular Salário</button>
</form>
 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function calcularSalarioVendedor($vendas_semanais, $meta_semanal, $meta_mensal) {
        $salario_minimo = 1500;
        $valor_sobre_meta_semanal = ($vendas_semanais >= $meta_semanal) ? ($meta_semanal * 0.01) : 0;
        $excedente_semanal = ($vendas_semanais > $meta_semanal) ? ($vendas_semanais - $meta_semanal) : 0;
        $valor_excedente_semanal = ($excedente_semanal > 0) ? ($excedente_semanal * 0.05) : 0;
        $excedente_mensal = ($vendas_semanais == $meta_mensal) ? ($vendas_semanais - $meta_mensal) : 0;
        $valor_excedente_mensal = ($excedente_mensal > 0) ? ($excedente_mensal * 0.1) : 0;
        $salario_final = $salario_minimo + $valor_sobre_meta_semanal + $valor_excedente_semanal + $valor_excedente_mensal;
        return $salario_final;
    }
 
    $nome_vendedor = $_POST['nome_vendedor'];
    $vendas_semanais = $_POST['meta_semanal'];
    $meta_semanal = $_POST['meta_semanal'];
    $meta_mensal = $_POST['meta_mensal'];
    $variavel_nao_definida = $variavel_inexistente + 10;
   
    $salario_final = calcularSalarioVendedor($vendas_semanais, $meta_semanal, $meta_mensal);
   
    echo "<h3>Resultado para $nome_vendedor:</h3>";
    echo "<p>Salário final do vendedor: R$ " . number_format($salario_final, 2, ',', '.') . "</p>";
}
?>
 
</body>
</html>