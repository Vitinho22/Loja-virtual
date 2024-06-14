
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Formulário com Validação em PHP</title>
</head>
<body>

<?php
// Definindo variáveis e definindo valores vazios
$nameErr = $emailErr = $genderErr = "";
$name = $email = $gender = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Nome é obrigatório";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Apenas letras e espaços em branco são permitidos";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "E-mail é obrigatório";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de e-mail inválido";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gênero é obrigatório";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (!empty($_POST["comment"])) {
        $comment = test_input($_POST["comment"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulário de Exemplo</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Nome: <input type="text" name="name" value="<?php echo $name;?>">
    <span style="color: red;"><?php echo $nameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
    <span style="color: red;"><?php echo $emailErr;?></span>
    <br><br>
    Comentário: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
    <br><br>
    Gênero:
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="feminino") echo "checked";?> value="feminino">Feminino
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="masculino") echo "checked";?> value="masculino">Masculino
    <span style="color: red;"><?php echo $genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $nameErr == "" && $emailErr == "" && $genderErr == "") {
    echo "<h2>Seus Dados:</h2>";
    echo "Nome: $name<br>";
    echo "E-mail: $email<br>";
    echo "Comentário: $comment<br>";
    echo "Gênero: $gender<br>";
}
?>

</body>
</html>













