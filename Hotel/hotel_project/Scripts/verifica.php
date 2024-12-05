<?php

/*

    Verificar se a Session está true, se sim vai para a página da Session indicada
    caso contrário vai para o login.html

*/

    session_start();

    if ($_SESSION['Funcionario'] == false) {
        print '<script>window.location.href="../hotel_project/login.html"</script>';
    }

?>