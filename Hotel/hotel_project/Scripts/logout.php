<?php

/*

    Colocar nas sessions em false para ir para o login.html e 
    colocar na base de dados OFFLINE

*/

    if ($_SESSION['Admin']  == true || $_SESSION['Funcionario'] == true) {
        print '<script>window.location.href="../hotel_project/login.html"</script>';
    }

    session_destroy();

?>