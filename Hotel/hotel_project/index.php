<?php
    require '../hotel_project/Scripts/verifica.php';
    require '../hotel_project/BD/bd.h'; // BD .h module connect
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard -- Funcionario</title>
    <link rel="shortcut icon" href="../hotel_project/Media/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../hotel_project/CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<script src="../hotel_project/JS/index.js"></script>

<body>
<div class="sidebar">
        <div class="logo">
            <img src="../hotel_project/Media/Logo.png" alt="Bat Hotel Gotham City" id="Logo">
        </div>
        <form action="" method="POST">
            <nav>
                <?php
                    $func = $_SESSION['FuncionarioMail'];
                    $sql = "SELECT * FROM conta WHERE email='$func'";
                    $result = mysqli_query($GLOBALS['conn'], $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h1>Bem-vindo ". $row['nome'] ."</h1>";
                    }
                ?>
            <ul>
                <ul class="menu-item"><i class="fa-solid fa-bed"></i> Quartos <span class="arrow">▼</span>
                    <li><button type="submit" name="ListaQuarto">● Listar Quartos</button></li>
                    <li><button type="submit" name="ListaTipoQuarto">● Listar Tipo Quarto</button></li>
                </ul>
                <ul class="menu-item"><i class="fa-solid fa-person"></i> Hóspedes <span class="arrow">▼</span>
                    <li><button type="submit" name="Search">● Procurar</button></li>
                </ul>
                <ul class="menu-item"><i class="fa-solid fa-ticket"></i> Reserva <span class="arrow">▼</span>
                    <li><button name="ListaReserva" type="submit">● Listar Reservas</button></li>
                    <li><button name="FazReserva" type="submit">● Fazer Reserva</button></li>
                    <li><button name="EditReserva" type="submit">● Editar Reserva</button></li>
                </ul>
            </ul>
            </nav>
        </form>
        </div>
    </div>

    <div class="content">
    <header>
        <div class="icons">
            <a href="mailto:Support@Bathotel.com"><i class="fa-solid fa-headset"></i></a>
            <i class="fas fa-moon" id="Theme"></i>
            <i class="fas fa-user-circle" id="Perfil"></i>
             <!-- Submenu para o perfil -->
            <form id="submenu-perfil" class="submenu" method="POST">
                <button type="submit" name="Perfil">Meu perfil</button>
                <button type="submit" name="Logout">Encerrar Sessão</button>
            </form>
        </div>
    </header>

    <!--"main-content" conteúdo principal -->
    <div class="main-content">
        <?php
            if(isset($_POST['Logout'])) {
                $func = $_SESSION['FuncionarioMail'];
                $sql = "UPDATE conta SET status = 'OFFLINE' WHERE email = '$func'";
                $result = mysqli_query($GLOBALS['conn'], $sql);
                if ($result) {
                    require '../hotel_project/Scripts/logout.php';
                }
            }
            if(isset($_POST['Perfil'])) {
                print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
                MeuPerfil();
            } else if(isset($_POST['SaveAlt'])) {
                SaveProfile();
            } else if(isset($_POST['ListaQuarto'])) {
                print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
                ListaQuarto();
            } else if(isset($_POST['ListaTipoQuarto'])) {
            ?>
                 <!-- Formulário de Pesquisa -->
            <form action="" method="post">
                <label for="Pesquisa">Pesquisar status:</label>
                <select name="Pesquisa" id="Pesquisa">
                    <option value="Deluxe">Deluxe</option>
                    <option value="Single">Single</option>
                    <option value="Suite">Suite</option>
                    <option value="Double">Double</option>
                </select>
                <input type="submit" name="pesquisar_btn" value="Pesquisar">
            </form>
            <?php
            } else if(isset($_POST['Search'])) {
            ?>
                <form action="" method="post">
                    <input type="search" name="Hospede" id="Hospede" placeholder="Introduz o nome do Hóspede">
                    <input type="submit" name="Procurar" value="Procurar">
                </form>
            <?php
            } else if (isset($_POST['ListaReserva'])) {
                ListaReserva();
            } elseif (isset($_POST['EditReserva'])) {
            ?>
                <form action="" method="post">
                    <input type="search" name="PesquisaReserva" id="Pesquisa" placeholder="Pesquisar reserva (ID)">
                    <input type="submit" name="PesquisarRes" value="Pesquisar">
                </form>
            <?php
            } else if (isset($_POST['FazReserva'])) {
            ?>
                <form id="reserva-form" action="" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="nome" placeholder="Introduz nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Introduz e-mail" required>
                </div>
                <div class="form-group">
                    <label for="tel">Telemóvel</label>
                    <input type="tel" name="telemovel" placeholder="Introduz telemóvel"  required>
                </div>
                <div class="form-group">
                    <label for="idQuarto">Número Quarto</label>
                <input type="number" name="id_quarto" placeholder="Introduz número quarto" required>
                </div>
                <div class="form-group">
                    <label for="piso">Piso</label>
                    <input type="number" name="piso" placeholder="Introduz piso do quarto" required>
                </div>
                <div class="form-group">
                    <label for="Mpagamento">Método Pagamento</label>
                    <select name="MetodoPagamento" required>
                        <option value="Multibanco">Mutlibanco</option>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="MBWay">Mbway</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estadia">Estadia</label>
                    <input type="number" name="Estadia" placeholder="Introduz o número de noites" required>
                </div>
                <div class="form-group">
                    <label for="Valor">Valor pagamento</label>
                    <input type="text" name="Valor" placeholder="Introduz o valor do pagamento" required>
                </div>
                <div class="form-group">
                    <label for="nif">NIF</label>
                    <input type="number" name="NIF" placeholder="Introduz o NIF" required>
                </div>
                <select name="Status" id="Status" required>
                    <option value="Check-in">Check-in</option>
                    <option value="Check-out">Check-out</option>
                </select>
                <div class="form-group">
                    <input type="submit" name="CriaReserva" value="Criar Reserva">
                </div>
                </form>
            <?php   
            } else {
                echo '<div class="logo-center">
                    <img src="../hotel_project/Media/Logo.png" alt="Bat Hotel Gotham City">
                </div>';
            }

            // Isset's do SUBMIT's
            if (isset($_POST['pesquisar_btn'])) {
                print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
                ListaTipoQuarto();
            }
            if (isset($_POST['Procurar'])) {
                print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
                SearchHospede();
            }
            if (isset($_POST['CriaReserva'])) {
                FazerReserva();
            }
            if (isset($_POST['PesquisarRes'])) {
                print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
                EditarReserva();
            }
        ?>
    </div>
</body>

</html>

<?php
        function MeuPerfil() {
            $func = $_SESSION['FuncionarioMail'];
            $sql = "SELECT * FROM conta WHERE email='$func'";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                print '<div class="form-container">
                <img src="../hotel_project/Media/avatar.png" alt="avatar" id="Avatar">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" value="'. $row['nome'].'">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="'. $row['email'] . '">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="Alterar password">
                    </div>
                    <button type="submit" name="SaveAlt" class="submit-btn">Guardar Alterações</button>
                </form>
                </div>';
            }

            mysqli_close($GLOBALS['conn']);
        }

        function SaveProfile() {
            $func = $_SESSION['FuncionarioMail'];
            $nome = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($password != '') {
                $encryp = hash('sha256', $password);
                $UpdateCpasse = "UPDATE conta SET nome = '$nome', email = '$email', password = '$encryp' WHERE email = '$func'";

                $result = mysqli_query($GLOBALS['conn'], $UpdateCpasse);

                if ($result) {
                    print '<script>alert("Alterações guardadas com sucesso!!!")</script>';
                } else {
                    print '<script>alert("Erro ao fazer alterações na base de dados!!!")</script>';
                }
            } else {
                $UpdateSpasse = "UPDATE conta SET nome = '$nome', email = '$email' WHERE email = '$func'";

                $result2 = mysqli_query($GLOBALS['conn'], $UpdateSpasse);

                if($result2) {
                    print '<script>alert("Alterações guardadas com sucesso!!!")</script>';
                } else {
                    print '<script>alert("Erro ao fazer alterações na base de dados!!!")</script>';
                }
            }

            mysqli_close($GLOBALS['conn']);
        }

        function ListaQuarto() {
            //Listar em tabela a listagem de quartos
            print ' <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Piso</th>
                        <th>Tipo do Quarto</th>
                        <th>Descrição</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
    
                $sql = "SELECT * FROM quarto";
    
                $result = mysqli_query($GLOBALS['conn'], $sql);
    
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($ROW = mysqli_fetch_assoc($result)) { 
                        print "<tr>
                        <td>". $ROW['id'] ."</td>
                        <td>". $ROW['piso'] ."</td>
                        <td>". $ROW['tipo_quarto'] ."</td>
                        <td>". $ROW['descricao'] ."</td>";
                        if ($ROW['status'] == "Disponivel") {
                            print "<td><span class='status status-disponivel'>Disponível</span></td>";
                        } else if ($ROW['status'] == "Ocupado") {
                            print '<td><span class="status status-ocupado">Ocupado</span></td>';
                        } else if ($ROW['status'] == "Manutencao"){
                            print "<td><span class='status status-manutencao'> Manutenção</span></td>";
                        }
                    print "</tr>";
                    }
                } else {
                    print "<tr><td>Nenhum resultado encontrado</td></tr";
                }
                print '</tbody>
            </table>
        </div>';
        mysqli_close($GLOBALS['conn']);
        }

        function ListaTipoQuarto() {   
            $opcaoSelecionada = $_POST['Pesquisa'];
            
                $sql = "SELECT * from quarto WHERE tipo_quarto = '" . $opcaoSelecionada . "';";
                $result = mysqli_query($GLOBALS['conn'], $sql);
        
                    print '<div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Piso</th>
                                    <th>Tipo do Quarto</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>';
                    
                    while ($row = mysqli_fetch_assoc($result)) { 
                        print "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['piso'] . "</td>
                            <td>" . $row['tipo_quarto'] . "</td>
                            <td>" . $row['descricao'] . "</td>";
        
                        // Exibir status com estilos específicos
                        if ($row['status'] == "Disponivel") {
                            print "<td><span class='status status-disponivel'>Disponível</span></td>";
                        } else if ($row['status'] == "Ocupado") {
                            print "<td><span class='status status-ocupado'>Ocupado</span></td>";
                        } else if ($row['status'] == "Manutencao") {
                            print "<td><span class='status status-manutencao'>Manutenção</span></td>";
                        }
                        print "</tr>";
                    }
                    if (mysqli_num_rows($result) == 0) {
                        print "<td>Nenhum tipo de quarto encontrado</td>";
                    }
                    print '</tbody>
                        </table>
                    </div>';
                    mysqli_close($GLOBALS['conn']);
        }

        function SearchHospede() {
            //procurar hospede na base de dados e listar
    
            $Hospede = $_POST['Hospede'];
            $sql = "SELECT * FROM reserva WHERE nome = '" . $Hospede . "';";
    
            $result = mysqli_query($GLOBALS['conn'], $sql);
    
                print '<div class="table-container-Reserva">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telémovel</th>
                                    <th>ID Quarto</th>
                                    <th>Piso</th>
                                    <th>Tipo Pagamento</th>
                                    <th>Valor</th>
                                    <th>Estadia</th>
                                    <th>NIF</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>';
                while ($row = mysqli_fetch_assoc($result)) { 
                    print "<tr>
                    <td>". $row['nome'] . "</td>
                    <td>". $row['email'] . "</td>
                    <td>". $row['telemovel'] ."</td>
                    <td>". $row['id_quarto']  . "</td>
                    <td>". $row['piso']  ."</td>
                    <td>". $row['tipo_pagamento'] ."</td>
                    <td>". $row['valor'] ." €</td>
                    <td>". $row['estadia'] . " noite/s</td>
                    <td>". $row['NIF'] ."</td>
                    <td>". $row['status'] ."</td>";
                    
                    print "</tr>";
                }
                
                if (mysqli_num_rows($result) == 0) {
                    print "<td>O nome não foi encontrado</td>";
                }
    
                print '</tbody>
                </table>
                </div>';
                mysqli_close($GLOBALS['conn']);
            }
            
            function ListaReserva() {
                //procurar hospede na base de dados e listar
            $sql = "SELECT * FROM reserva;";
    
            $result = mysqli_query($GLOBALS['conn'], $sql);
    
                print '<div class="table-container-Reserva">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telémovel</th>
                                    <th>ID Quarto</th>
                                    <th>Tipo Pagamento</th>
                                    <th>Valor</th>
                                    <th>Estadia</th>
                                    <th>NIF</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>';
                while ($row = mysqli_fetch_assoc($result)) { 
                    print "<tr>
                    <td>". $row['id'] ."</td>
                    <td>". $row['nome'] . "</td>
                    <td>". $row['email'] . "</td>
                    <td>". $row['telemovel'] ."</td>
                    <td>". $row['id_quarto']  . "</td>
                    <td>". $row['tipo_pagamento'] ."</td>
                    <td>". $row['valor'] ." €</td>
                    <td>". $row['estadia'] . " noite/s</td>
                    <td>". $row['NIF'] ."</td>
                    <td>". $row['status'] ."</td>";
                    
                    print "</tr>";
                }
                
            
                if (mysqli_num_rows($result) == 0) {
                    print "<td>O nome não foi encontrado</td>";
                }
    
                print '</tbody>
                </table>
                </div>';
                mysqli_close($GLOBALS['conn']);
            }

            function FazerReserva() {
                //Fazer form para fazer / criar reserva
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $telemovel = $_POST['telemovel'];
                $id_quarto = $_POST['id_quarto'];
                $piso = $_POST['piso'];
                $MetodoPagamento = $_POST['MetodoPagamento'];
                $Valor = $_POST['Valor'];
                $Estadia = $_POST['Estadia'];
                $NIF = $_POST['NIF'];
                $status = $_POST['Status'];
    
                $Lista_quarto = "SELECT * FROM quarto WHERE id='$id_quarto'";
                $Lista = mysqli_query($GLOBALS['conn'], $Lista_quarto);
    
                $INS_RESERVA = "INSERT INTO reserva (nome, email, telemovel, id_quarto, piso, tipo_pagamento, valor, estadia, status, nif) VALUES (";
                $INS_RESERVA .= "'$nome', '$email', '$telemovel', $id_quarto, $piso, '$MetodoPagamento', $Valor, '$Estadia', '$status', '$NIF');";
                $UPDATE_QUARTO = "UPDATE quarto SET status = 'Ocupado' WHERE id = $id_quarto";
    
    
                while ($row = mysqli_fetch_assoc($Lista)) {
                    if ($row['status'] == 'Ocupado' || $row['status'] == 'Manutencao') {
                        print '<script>alert("Erro ao criar reserva, devido ao quarto selecionado não estar disponível!!!\nTente novamente")</script>';
                    } else {
                        $result = mysqli_query($GLOBALS['conn'], $INS_RESERVA);
                        $Update = mysqli_query($GLOBALS['conn'], $UPDATE_QUARTO);
        
                        if ($result && $Update) {
                            print '<script>alert("Reserva registada com sucesso!!!")</script>';
                        } else {
                            print '<script>alert("Erro ao criar reserva!!!\nTente novamente")</script>';
                        }
                    }
                }
    
                mysqli_close($GLOBALS['conn']);
            }

            function EditarReserva() {
                //Fazer form para editar Reserva
                $reserva = $_POST['PesquisaReserva'];
                $_SESSION['reserva'] = $reserva;
                $sql = "SELECT * FROM reserva WHERE id= '$reserva'";
    
                $result = mysqli_query($GLOBALS['conn'], $sql);
    
                if ($result && $result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        print ' <form id="reserva-form" method="post">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="nome" placeholder="Introduz nome" value="' . $row['nome'] . '" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" placeholder="Introduz e-mail" value="'. $row['email'] .'" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tel">Telemóvel</label>
                        <input type="tel" name="telemovel" placeholder="Introduz telemóvel" value="'. $row['telemovel'] .'" readonly>
                    </div>
                    <div class="form-group">
                        <label for="idQuarto">Número Quarto</label>
                    <input type="number" name="id_quarto" placeholder="Introduz número quarto" value="'. $row['id_quarto'] .'" readonly>
                    </div>
                    <div class="form-group">
                        <label for="piso">Piso</label>
                        <input type="number" name="piso" placeholder="Introduz piso do quarto" value="'. $row['piso'] .'" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Mpagamento">Método Pagamento</label>
                        <select name="MetodoPagamento" readonly>
                            <option value="'. $row['tipo_pagamento'] .'">'. $row['tipo_pagamento'] .'</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estadia">Estadia</label>
                        <input type="number" name="Estadia" placeholder="Introduz o número de noites" value="'. $row['estadia'] .'" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Valor">Valor pagamento</label>
                        <input type="text" name="Valor" placeholder="Introduz o valor do pagamento" value="'. $row['valor'] . '" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nif">NIF</label>
                        <input type="number" name="NIF" placeholder="Introduz o NIF" value="' . $row['NIF'] . '" readonly>
                    </div>';
                        if ($row['status'] == "Check-out") {
                            print ' <select name="Status" id="Status" readonly>
                                <option value="Check-out">Check-out</option>
                            </select>';
                        } else {
                            print ' <select name="Status" id="Status">
                                <option value="Check-in">Check-in</option>
                                <option value="Check-out">Check-out</option>
                            </select>';
                        }
                    print '<div class="form-group">
                        <input type="submit" name="AtualizarRes" value="Atualizar Reserva">
                    </div>
                </form>';
                    }
                }
            }
    
            function UpdateReserva() {
                $id_quarto = $_POST['id_quarto'];
                $CHECK = $_POST['Status'];
                $id = $_SESSION['reserva'];
                $sql = "UPDATE reserva SET status= '$CHECK' WHERE id= '$id'" ;
    
                if ($CHECK == 'Check-out') {
                    $quarto = "UPDATE quarto SET status='Disponivel' WHERE id='$id_quarto'";
    
                    $result = mysqli_query($GLOBALS['conn'], $sql);
                    $resultQuarto = mysqli_query($GLOBALS['conn'], $quarto);
    
                    if ($result && $resultQuarto) {
                        print '<script>alert("Reserva atualizada com sucesso!!!")</script>';
                    } else {
                        print '<script>alert("Erro ao atualizar reserva")</script>';
                    }
                }
    
                $result = mysqli_query($GLOBALS['conn'], $sql);
    
                if ($result) {
                    print '<script>alert("Reserva atualizada com sucesso!!!")</script>';
                } else {
                    print '<script>alert("Erro ao atualizar reserva")</script>';
                }
            }
?>