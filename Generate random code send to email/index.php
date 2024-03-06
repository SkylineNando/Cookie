<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Código Aleatório</title>
</head>
<body>

<?php
function gerarCodigoAleatorio($tamanho = 8) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $codigo = '';
    for ($i = 0; $i < $tamanho; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo;
}

if (!isset($_COOKIE['codigo_aleatorio']) || (isset($_COOKIE['ultimo_acesso']) && time() - $_COOKIE['ultimo_acesso'] > 5)) {
    $codigo_gerado = gerarCodigoAleatorio();
    setcookie('codigo_aleatorio', $codigo_gerado, time() + 5, '/');
    setcookie('ultimo_acesso', time(), time() + 5, '/');
    
    // Enviar o código gerado por email
    $to_email = "seuemail@example.com";
    $subject = "Código Aleatório Gerado";
    $message = "O código aleatório gerado é: $codigo_gerado";
    $headers = "From: webmaster@example.com";
    
    mail($to_email, $subject, $message, $headers);
} else {
    $codigo_gerado = $_COOKIE['codigo_aleatorio'];
}

if(isset($_POST['submit'])) {
    $numero_inserido = $_POST['numero'];
    
    if($numero_inserido == $codigo_gerado) {
        $mensagem = "Sucesso! O número inserido está correto.";
    } else {
        $mensagem = "Erro! O número inserido está incorreto.";
    }
}
?>

<p>O código aleatório gerado é: <?php echo $codigo_gerado; ?></p>

<?php if(isset($mensagem)) echo "<p>$mensagem</p>"; ?>

<form method="post">
    <label for="numero">Digite um número:</label>
    <input type="text" id="numero" name="numero" required>
    <button type="submit" name="submit">Verificar</button>
</form>

</body>
</html>
