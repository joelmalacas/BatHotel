<?php
    require '../hotel_project/Scripts/verificaAdmin.php';
    require '../hotel_project/BD/bd.h'; // BD .h module connect
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard -- Administrador</title>
    <link rel="shortcut icon" href="../hotel_project/Media/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../hotel_project/CSS/admin.css">
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
                <h1>Bem-vindo Admin</h1>
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
                    <ul class="menu-item"><i class="fa-solid fa-user"></i> Funcionários <span class="arrow">▼</span>
                        <li><button name="ListaFunc" type="submit">● Listar Funcionários</button></li>
                        <li><button name="CriarFunc" type="submit">● Criar</button></li>
                        <li><button name="ApagarFunc" type="submit">● Apagar</button></li>
                    </ul>
                    <ul class="menu-item"><i class="fa-solid fa-list-check"></i> Gestão Quartos <span class="arrow">▼</span>
                        <li><button name="CriarQuarto" type="submit">● Criar</button></li>
                        <li><button name="EditarQuarto" type="submit">● Editar</button></li>
                        <li><button name="ApagarQuarto" type="submit">● Apagar</button></li>
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

    // Verificações principais
    if (isset($_POST['Logout'])) {
        require "../hotel_project/Scripts/logout.php";
    } elseif (isset($_POST['Perfil'])) {
        MeuPerfil();        
    } elseif (isset($_POST['ListaQuarto'])) {
        ListaQuarto();
    } elseif (isset($_POST['ListaTipoQuarto'])) {
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
    } elseif (isset($_POST['Search'])) {
    ?>
        <form action="" method="post">
            <input type="search" name="Hospede" id="Hospede" placeholder="Introduz o nome do Hóspede">
            <input type="submit" name="Procurar" value="Procurar">
        </form>
    <?php
    } elseif (isset($_POST['ListaReserva'])) {
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
    } else if (isset($_POST['CriarFunc'])) {
    ?>
            <form id="CreateFUNC" action="" method="post">
                <h2>Criar Funcionário</h2>
                <input type="text" name="Nome" id="Nome" placeholder="Introduza nome" required>
                <input type="email" name="Email" placeholder="Introduza e-mail" required>
                <input type="tel" name="Telemovel" placeholder="Introduza número telemóvel" required>
                <input type="text" name="Morada" placeholder="Introduza Morada fiscal" required>
                <input type="date" name="Data_nascimento" placeholder="Data Criação" required>
                <select name="Cargos" required>
                    <option value="Funcionario">Funcionário</option>
                </select>
                <input type="submit" name="CriaFuncSUB" value="Criar Funcionário">
            </form>
    <?php
    } else if (isset($_POST['CriarQuarto'])) {
    ?>
        <form id="CreateFUNC" action="" method="post">
                <h2>Criar Quarto</h2>
                <input type="number" name="ID" id="ID" placeholder="Número do quarto" required>
                <input type="number" name="Piso" id="Piso" placeholder="Piso do quarto" required>
                <select name="TipoQuarto" id="Pesquisa" aria-placeholder="Tipo de Quarto" required>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Single">Single</option>
                    <option value="Suite">Suite</option>
                    <option value="Double">Double</option>
                </select>
                <select name="Status" id="StatusQuarto" required>
                    <option value="Disponivel">Disponível</option>
                    <option value="Ocupado">Ocupado</option>
                    <option value="Manutencao">Manutenção</option>
                </select>
                <input type="file" name="IMGQuarto" id="IMG" placeholder="Imagem quarto" required>
                <textarea name="Desc" id="DESC" placeholder="Descrição"></textarea>
                <input type="submit" name="CriaQuarto" value="Criar Quarto">
        </form>
    <?php
    } else if (isset($_POST['ApagarFunc'])) {  
    ?>
        <form action="" method="post">
            <input type="search" name="FuncEmail" placeholder="Insira o endereço e-mail" required>
            <input type="submit" name="ApagaFuncionario" value="Apagar funcionário">
        </form>
    <?php
    } else if (isset($_POST['EditarQuarto'])) {
    ?>
        <form id="reserva-form" method="post">
            <input type="number" name="IDquartoEdit" placeholder="Introduza ID quarto" required>
            <input type="submit" name="ProcuraQuarto" value="Procurar">
        </form>
    <?php
    } else if (isset($_POST['ApagarQuarto'])) {
    ?>
        <form id="reserva-form" method="post">
            <h2>Apagar quarto</h2>
            <br>
            <input type="number" name="IDquartoDel" placeholder="Introduza o ID quarto" required>
            <input type="submit" name="DelQuartoID" value="Apagar quarto">
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
    if (isset($_POST['PesquisarRes'])) {
        print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
        EditarReserva();
    }
    if (isset($_POST['CriaReserva'])) {
        FazerReserva();
    }
    if (isset($_POST['ListaFunc'])) {
        print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
        ListaFuncionario();
    }
    if (isset($_POST['CriaFuncSUB'])) {
        print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
        CriaFuncionario();
    }
    if (isset($_POST['CriaQuarto'])) {
        print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
        AddQuarto();
    }
    if (isset($_POST['ApagaFuncionario'])) {
        print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
        RemFuncionario();
    }
    if (isset($_POST['AtualizarRes'])) { // Evento clique do Atualizar Reserva
        UpdateReserva();
    }
    if (isset($_POST['ProcuraQuarto'])) { //Evento clique do Atualizar Quarto
        print "<script>document.querySelector('.main-content').innerHTML = '';</script>";
        EditQuarto();
    }
    if (isset($_POST['AtualizaEditQuarto'])) {
        AtualizaQuarto();               
    }
    if(isset($_POST['DelQuartoID'])) {
        RemQuarto();
    }
     ?>
        </div>
    </div>
</body>

</html>

<?php
        /**
            * Functions no onclick
        */

    function MeuPerfil() {
        print '<div class="form-container">
                    <img src="../hotel_project/Media/avatar.png" alt="avatar" id="Avatar">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" id="name" name="name" value="Administrador" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="Administrador@hotel.com" readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" id="password" name="password" value="admin" readonly>
                        </div>
                        <button type="submit" class="submit-btn">Voltar</button>
                    </form>
                    </div>';
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

        function ListaFuncionario() {
            //Listar funcionario
            $sql = "SELECT * FROM funcionario";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            print ' <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telemóvel</th>
                        <th>Morada</th>
                        <th>Data Criação</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>';

                while ($row = mysqli_fetch_assoc($result)) { 
                    print "<tr>
                    <td>". $row['nome'] . "</td>
                    <td>". $row['email'] . "</td>
                    <td>". $row['telemovel'] ."</td>
                    <td>". $row['Morada']  . "</td>
                    <td>". $row['Data_criacao']  . "</td>
                    <td>". $row['Cargo'] ."</td>";
                    print "</tr>";
                }
                
            
                if (mysqli_num_rows($result) == 0) {
                    print "<td>Funcionários não encontrado</td>";
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

        function CriaFuncionario() {
            //Criar Funcionario
            $nome = $_POST['Nome'];
            $email = $_POST['Email'];
            $telemovel = $_POST['Telemovel'];
            $morada = $_POST['Morada'];
            $data_nascimento = $_POST['Data_nascimento'];
            $data_cria = new DateTime();
            $data_string = $data_cria->format('Y-m-d H:i:s');
            $cargo = $_POST['Cargos'];
            $passe = "B7#qP2zX";

            //Insert tabela conta e tabela funcionario
            $ListaFunc = "SELECT * FROM funcionario WHERE email='$email'";
            $ListaConta = "SELECT *FROM conta WHERE email='$email'";

            $ResultFUNC = mysqli_query($GLOBALS['conn'], $ListaFunc);
            $ResultConta = mysqli_query($GLOBALS['conn'], $ListaConta);

            if (mysqli_num_rows($ResultFUNC) > 0 && mysqli_num_rows($ResultConta) > 0) {
                print '<script>alert("Erro: Já existe uma conta com esse endereço E-mail!!!")</script>';
            } else {
                $INS_FUNCIONARIO = "INSERT INTO funcionario (nome, email, telemovel, morada, data_criacao, cargo, data_nascimento) 
                    VALUES ('" . $nome . "', '" . $email . "', '" . $telemovel . "', '" . $morada . "', '" . $data_string . "', '" . $cargo . "', '". $data_nascimento . "');";

                $INS_CONTA = "INSERT INTO conta (nome, email, password, data_criacao, status) 
                        VALUES ('" . $nome . "', '" . $email . "', SHA2('" . $passe . "', 256), '" . $data_string . "', 'OFFLINE');";

                $result = mysqli_query($GLOBALS['conn'], $INS_FUNCIONARIO);
                $CreateCONTA = mysqli_query($GLOBALS['conn'], $INS_CONTA);

                if ($result && $CreateCONTA) {
                    EnviaCredencialSMTP($email, $passe);
                    print '<script>alert("Conta Criada com sucesso!!!")</script>';
                } else {
                    print '<script>alert("Erro ao criar conta funcionário!!!")</script>';
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

        function RemFuncionario() {
            //Remover funcionario
            $funcionario = $_POST['FuncEmail'];

            $ListaFunc = "SELECT * FROM funcionario WHERE email='$funcionario'";
            $ListaConta = "SELECT * FROM conta WHERE email='$funcionario'";

            $Del_conta = "DELETE FROM conta WHERE email='$funcionario'";
            $Del_func = "DELETE FROM funcionario WHERE email='$funcionario'";

            $ResultListaFunc = mysqli_query($GLOBALS['conn'], $ListaFunc);
            $ResultListaConta = mysqli_query($GLOBALS['conn'], $ListaConta);

            if (mysqli_num_rows($ResultListaFunc) > 0 && mysqli_num_rows($ResultListaConta) > 0) {
                $resultDelConta = mysqli_query($GLOBALS['conn'], $Del_conta);
                $resultDelFunc = mysqli_query($GLOBALS['conn'], $Del_func);

                if ($resultDelConta && $resultDelFunc) {
                    print '<script>alert("Funcionário apagado com sucesso!!!")</script>';
                } else {
                    print '<script>alert("Erro ao apagar funcionário!!!")</script>';
                }
            } else {
                print '<script>alert("Erro: o endereço e-mail selecionado não existe!!!")</script>';
            }

            mysqli_close($GLOBALS['conn']);
        }

        function AddQuarto() {
            //Add Quarto
            $ID = $_POST['ID'];
            $Piso = $_POST['Piso'];
            $Tipo_Quarto = $_POST['TipoQuarto'];
            $estado = $_POST['Status'];
            $file = $_POST['IMGQuarto'];
            $descricao = $_POST['Desc'];

            $lista = "SELECT * FROM quarto WHERE id='$ID'";
            $sql = "INSERT INTO quarto (id,piso,tipo_quarto,status,descricao,img_quarto) VALUES ('$ID','$Piso','$Tipo_Quarto', '$estado', '$descricao', '/Media/Quartos/$file')";

            $listagem = mysqli_query($GLOBALS['conn'], $lista);

            if (mysqli_num_rows($listagem) == 0) {
                $result = mysqli_query($GLOBALS['conn'], $sql);

                if ($result) {
                    print '<script>alert("Quarto adicionado com sucesso!!!")</script>';
                } else {
                    print '<script>alert("Erro adicionar quarto\n Tente novamente!!!")</script>';
                }
            } else {
                print '<script>alert("Já existe um número do quarto\n\nTente novamente!!!")</script>';
            }

            mysqli_close($GLOBALS['conn']);
        }

        function EditQuarto() {
            $idEditQuarto = $_POST['IDquartoEdit']; 
            $GLOBALS['idEditQuarto'] = $idEditQuarto;
        
            $sql = "SELECT * FROM quarto WHERE id='" . $GLOBALS['idEditQuarto'] . "'";
        
            $result = mysqli_query($GLOBALS['conn'], $sql);
        
            if ($result && $result->num_rows == 0) {
                print '<script>alert("Não existe nenhum quarto com esse número")</script>';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    print '<form id="CreateFUNC" method="post">
                        <input type="number" name="idQuartoEdit" value="' . $row['id'] . '" placeholder="Introduza o ID do quarto" readonly>
                        <input type="number" name="pisoQuartoEdit" value="' . $row['piso'] . '" placeholder="Introduza o piso do quarto" required>
                        <select name="TipoQuartoEdit" id="Pesquisa" aria-placeholder="Tipo de Quarto" required>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Single">Single</option>
                            <option value="Suite">Suite</option>
                            <option value="Double">Double</option>
                        </select>
                        <textarea name="DescEditQuarto" placeholder="Introduza descrição">' . $row['descricao'] . '</textarea required>
                        <select name="StatusEditQuarto" id="StatusQuarto" required>
                            <option value="Disponivel">Disponível</option>
                            <option value="Ocupado">Ocupado</option>
                            <option value="Manutencao">Manutenção</option>
                        </select>
                        <input type="submit" name="AtualizaEditQuarto" value="Editar Quarto">
                    </form>';
                }
            }
        }
        

        function AtualizaQuarto() {
            $idNovo = $_POST['idQuartoEdit'];
            $piso = $_POST['pisoQuartoEdit'];
            $tipoquarto = $_POST['TipoQuartoEdit'];
            $DescQuarto = $_POST['DescEditQuarto'];
            $StatusQuarto = $_POST['StatusEditQuarto'];
        
            $Update = "UPDATE quarto SET piso='$piso', tipo_quarto='$tipoquarto', descricao='$DescQuarto', status='$StatusQuarto' WHERE id='$idNovo'";
            $result = mysqli_query($GLOBALS['conn'], $Update);
        
            if ($result) {
                print '<script>alert("Quarto atualizado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao atualizar quarto\nTente novamente!!!")</script>';
            }
        }

        function RemQuarto() {
            //Rem Quarto
            $id = $_POST['IDquartoDel'];

            $verifica = "SELECT * FROM quarto WHERE id='$id'";
            $sql = "DELETE FROM quarto WHERE id='$id'";
            $ApagaReserva = "DELETE FROM reserva WHERE id_quarto='$id'";

            $result = mysqli_query($GLOBALS['conn'],$verifica);

            if ($result && $result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] == 'Ocupado') {
                        print '<script>alert("Não é possível apagar este quarto, porque está ocupado!!!")</script>';
                    } else {
                        $ResultReserva = mysqli_query($GLOBALS['conn'],$ApagaReserva);

                        if ($ResultReserva) {
                            $apaga = mysqli_query($GLOBALS['conn'],$sql);
                            if ($apaga) {
                                print '<script>alert("Quarto apagado com sucesso!!!")</script>';
                            } else {
                                print '<script>alert("Erro ao apagar quarto")</script>';
                            }
                        }
                    }
                }
            } else {
                print '<script>alert("Erro: O quarto inserido não existe")</script>';
            }

            mysqli_close($GLOBALS['conn']);
        }

        function EnviaCredencialSMTP($email, $passe) {
            //Ligar ao server MailJet SMTP e enviar as credenciais
            // Credenciais da API do Mailjet

            require '../hotel_project/API/key.h';
            require '../hotel_project/API/secret.h';
        
            // Dados do e-mail
            $from_email = 'tiago.diogo@ipcbcampus.pt'; // Email ligado a API
            $from_name = 'BatHotel';
            $subject = 'Criação de Conta';
            $text = '<h1>Credenciais funcionário</h1>';
            $html = '<p>Bem-vindo ao BatHotel, apresento aqui as suas credenciais: Email: ' . $email .' || Password: '.  $passe .'</p>';
        
            // Dados da requisição
            $postData = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => $from_email,
                            'Name' => $from_name
                        ],
                        'To' => [
                            [
                                'Email' => $email
                            ]
                        ],
                        'Subject' => $subject,
                        'TextPart' => $text,
                        'HTMLPart' => $html
                    ]
                ]
            ];
        
            // Inicializa cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $api_secret);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailjet.com/v3.1/send');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);
        
            // Executa a requisição e captura a resposta
            $result = curl_exec($ch);
            $info = curl_getinfo($ch);
        
            // Fecha a conexão cURL
            curl_close($ch);
        
            // Verifica se o e-mail foi enviado com sucesso
            if ($info['http_code'] == 200) {
                echo '<script>console.log("E-mail enviado com sucesso!");</script>';
            } else {
                echo '<script>alert("Erro ao enviar o e-mail: ' . $result . '")</script>';
            }
    }
?>