<?php
/*
    Entra na base de dados e verifica na base de dados
    se as credenciais são existentes.

    Após a verificação for válida, verifica se é administrador ou Funcionário
    Se Administrator redireciona para a página de Dashboard de ADMIN caso contrário 
    irá para a dashboard de Funcionário.
    
*/
    session_start();

    //Connect DB
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $database = 'Hotel';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $database) or die("Erro ao tentar conectar-se à base de dados");


    $nome = $_POST['Utilizador'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM conta WHERE email = '$nome' AND password = SHA2('$pass', 256);";

    $result = mysqli_query($conn, $sql);

    if ($nome == 'Administrador@hotel.com' && $pass == 'admin') {
        $_SESSION['Admin'] = true;
        print '<script>window.location.href="../Admin.php"</script>';
    } else {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['Funcionario'] = true; // Estado da sessão para true ou seja online
            $_SESSION['FuncionarioMail'] = $nome;
            //Query para mudar status para online
            $sql = "UPDATE conta SET status = 'ONLINE' WHERE email = '$nome'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                print '<script>window.location.href="../index.php"</script>';
            }
        } else {
            print '<script>alert("Credenciais inválidas\nTente novamente!!!")</script>';
            print '<script>window.location.href = "../login.html";</script>';
        }
    }

    mysqli_close($conn);

?>