<?php
include "conecta.php";
session_start();
$idConversa = session_id();
// testa se o adentende esta livre
$res = mysqli_query($con, "SELECT * FROM chat WHERE origem='A' and msg = ''");
if (mysqli_num_rows($res) > 0) {
    echo "<html>
    <head>
        <title>Chat</title>
    </head>
    <body>  
        <h1>No momento não existem novas mensagens</h1>
    </body>
    </html>";
    exit();
} else {
    $dados = mysqli_fetch_array($res);
    $nomeAtendente = $dados[0];

    // testa se atendente esta ocupado
    $res = mysqli_query($con, "SELECT * FROM chat WHERE origem='C' and nome<> '$idConversa'");
    if (mysqli_num_rows($res) > 0) {
        echo "<html>
        <head>
            <title>Chat</title>
        </head>
        <body>  
            <h1>Atendente ocupado</h1>
        </body>
        </html>";
        exit();
    }
}
// Exibe formulrario de login
if (!isset($_POST['nome']) || empty($_POST['nome'])) {
    ?>
    <html>

    <head>
        <title>Chat</title>
    </head>

    <body>
        <h2 align="center">Atendimento via chat</h2>
        <form name="login" method="post" action="indexCliente.php">
            <div align="center">
                <p>Seu nome: <input type="text" name="nome" id="nome" size="60" maxlength="60" /></p>
                <p><input name="iniciar" type="submit" id="inicar" value="Iniciar atendimento" /></p>
            </div>
        </form>
    </body>

    </html>
    <?php
} else {
    // inica chat
    $nome = ucfirst($_POST['nome']);
    setcookie("nomeCliente", $nome);
    $res = mysqli_query($con, "INSERT INTO chat  VALUES ( '$idConversa','C','')");
    $res = mysqli_query($con, "INSERT INTO chat  VALUES ( '$nome','C','[Entrou no chat]')");
    ?>
    <html>

    <head>
        <title>Chat</title>
        <script src="bibliotecaAjax.js"></script>
        <script src="chat.js"></script>
    </head>

    <body>
        <h1>Atendimento Via chat</h1>

    </body>

    </html>
    <?php
}
?>