<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="star.png" type="image/x-icon">
    <link href="https://fonts.cdnfonts.com/css/redfive" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/charter-itc-tt" rel="stylesheet">
    <title>StarWars</title>
</head>

<body>
    <video id="background-video" autoplay muted loop>
        <source src="fundo.mp4" type="video/mp4">
    </video>
    <div class="cima">
        <img src="star.png">
    </div>
    <div class="cima">
        <form action="#" method="post">
            <input type="hidden" name="nome" value="Personagens">
            <input type="hidden" name="b" value="https://swapi.dev/api/people">
            <input type="submit" class="button" style='--color:yellow;cursor:pointer;' name="personagem" value="Personagens">
        </form>
        <form action="#" method="post">
            <input type="hidden" name="b" value="https://swapi.dev/api/films">
            <input type="submit" class="button" style='--color:yellow;cursor:pointer;' name="filmes" value="Filmes">
        </form>
        <form action="#" method="post">
            <input type="hidden" name="nome" value="Especies">
            <input type="hidden" name="b" value="https://swapi.dev/api/species">
            <input type="submit" class="button" style='--color:yellow;cursor:pointer;' name="especies" value="Especies">
        </form>
        <form action="#" method="post">
            <input type="hidden" name="nome" value="Veiculos">
            <input type="hidden" name="b" value="https://swapi.dev/api/vehicles">
            <input type="submit" class="button" style='--color:yellow;cursor:pointer;' name="veiculos" value="Veiculos">
        </form>
        <form action="#" method="post">
            <input type="hidden" name="nome" value="Naves">
            <input type="hidden" name="b" value="https://swapi.dev/api/starships">
            <input type="submit" class="button" style='--color:yellow;cursor:pointer;' name="naves" value="Naves">
        </form>
        <form action="#" method="post">
            <input type="hidden" name="nome" value="Planetas">
            <input type="hidden" name="b" value="https://swapi.dev/api/planets">
            <input type="submit" class="button" style='--color:yellow;cursor:pointer;' name="planetas" value="Planetas">
        </form>
    </div>
    <?php
    error_reporting(0);
    if ($_POST['maispersonagem'] || $_POST['menospersonagem'] || $_POST['personagem'] || $_POST['especies'] || $_POST['veiculos'] || $_POST['naves'] || $_POST['planetas']) {
        echo "<div class='meio'>";
        $nome = $_POST['nome'];
        $b = $_POST['b'];
        $url = $b;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = json_decode(curl_exec($ch));
        echo "<h1>$nome</h1><br>";
        $menos = $resultado->previous;
        $mais = $resultado->next;
        foreach ($resultado->results as $resultados) {
            echo "<form method='post' action='#'>";
            echo "<input type='hidden' name='url$nome' value='$resultados->url'>";
            echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='$nome' value='$resultados->name'>";
            echo "</form>";
        }
        if ($mais == []) {
            echo "<div class=seta>";
            echo "<form method='post' action='#'>";
            echo "<input type='hidden' name='nome' value='$nome'>";
            echo "<input type='hidden' name='b' value='$menos'>";
            echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='menospersonagem' value='<'>";
            echo "</form>";
            echo "</div>";
        } else if ($menos == []) {
            echo "<div class=seta>";
            echo "<form method='post' action='#'>";
            echo "<input type='hidden' name='nome' value='$nome'>";
            echo "<input type='hidden' name='b' value='$mais'>";
            echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;'' name='maispersonagem' value='>'>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<div class=seta>";
            echo "<form method='post' action='#'>";
            echo "<input type='hidden' name='nome' value='$nome'>";
            echo "<input type='hidden' name='b' value='$menos'>";
            echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;'' name='menospersonagem' value='<'>";
            echo "</form>";
            echo "<form method='post' action='#'>";
            echo "<input type='hidden' name='nome' value='$nome'>";
            echo "<input type='hidden' name='b' value='$mais'>";
            echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='maispersonagem' value='>'>";
            echo "</form>";
            echo "</div>";
        }
    echo "</div>";
    }
    if ($_POST['filmes']) {
        echo "<div class='meio'>";
        $b = $_POST['b'];
        $url = $b;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = json_decode(curl_exec($ch));
        echo "<h1>Filmes</h1><br>";
        foreach ($resultado->results as $resultados) {
            echo "<form method='post' action='#'>";
            echo "<input type='hidden' name='urlFilmes' value='$resultados->url'>";
            echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Filmes' value='$resultados->title'>";
            echo "</form>";
        }
        echo "</div>";
    }

    if ($_POST['Personagens']) {
        echo "<div class='meio'>";
        $urlperso = $_POST['urlPersonagens'];
        $ch = curl_init($urlperso);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $personagem = json_decode(curl_exec($ch));
        echo "<img src='StarFotos/StarFotos/$personagem->name.png'>";
        echo "<h1>" . $personagem->name . "</h1><br>";
        echo "Peso: " . $personagem->height . "<br>";
        echo "Massa: " . $personagem->mass . "<br>";
        echo "Cor do cabelo: " . $personagem->hair_color . "<br>";
        echo "Cor da pele: " . $personagem->skin_color . "<br>";
        echo "Cor do olho: " . $personagem->eye_color . "<br>";
        echo "Ano de aniversário: " . $personagem->birth_year . "<br>";
        echo "Genero: " . $personagem->gender . "<br>";
        echo "<h1>Planeta onde nasceu</h1>";
        $ch2 = curl_init($personagem->homeworld);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $planetanasc = json_decode(curl_exec($ch2));
        echo "<form method='post' action='#'>";
        echo "<input type='hidden' name='urlPlanetas' value='$planetanasc->url'>";
        echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Planetas' value='$planetanasc->name'>";
        echo "</form>";

        if ($personagem->films != []) {
            echo "<h1>Filmes</h1>";
            foreach ($personagem->films as $filmes) {
                $ch2 = curl_init($filmes);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $filme = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlFilmes' value='$filme->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Filmes' value='$filme->title'>";
                echo "</form>";
            }
        }

        if ($personagem->species != []) {
            echo "<h1>Especies</h1>";
            foreach ($personagem->species as $especies) {
                $ch2 = curl_init($especies);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $especie = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlEspecies' value='$especie->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Especies' value='$especie->name'>";
                echo "</form>";
            }
        }

        if ($personagem->vehicles != []) {
            echo "<h1>Veiculo</h1>";
            foreach ($personagem->vehicles as $veiculos) {
                $ch2 = curl_init($veiculos);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $veiculo = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlVeiculos' value='$veiculo->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Veiculos' value='$veiculo->name'>";
                echo "</form>";
            }
        }

        if ($personagem->starships != []) {
            echo "<h1>Naves</h1>";
            foreach ($personagem->starships as $naves) {
                $ch2 = curl_init($naves);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $nave = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlNaves' value='$nave->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Naves' value='$nave->name'>";
                echo "</form>";
            }
        }
        echo "</div>";
    }

    if ($_POST['Especies']) {
        echo "<div class='meio'>";
        $urlesp = $_POST['urlEspecies'];
        $ch = curl_init($urlesp);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $especies = json_decode(curl_exec($ch));
        ?>
        <img src="StarFotos/StarEspecies/<?php echo $especies->name ?>.png">
        <?php
        echo "<h1>" . $especies->name . "</h1><br>";
        echo "Classificação: " . $especies->classification . "<br>";
        echo "Designação: " . $especies->designation . "<br>";
        echo "Altura Média: " . $especies->average_height . "<br>";
        echo "Cores de Pele: " . $especies->skin_colors . "<br>";
        echo "Cores de Cabelo: " . $especies->hair_colors . "<br>";
        echo "Cores dos Olhos: " . $especies->eye_colors . "<br>";
        echo "Tempo de Vida Médio" . $especies->average_lifespan . "<br>";
        echo "Linguagem: " . $especies->language . "<br>";
        echo "<h1>Planeta de Origem</h1>";
        $ch2 = curl_init($especies->homeworld);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $planetanasc = json_decode(curl_exec($ch2));
        echo "<form method='post' action='#'>";
        echo "<input type='hidden' name='urlPlanetas' value='$planetanasc->url'>";
        echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Planetas' value='$planetanasc->name'>";
        echo "</form>";

        if ($especies->people != []) {
            echo "<h1>Pessoas</h1>";
            foreach ($especies->people as $pessoas) {
                $ch2 = curl_init($pessoas);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $pessoa = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlPersonagens' value='$pessoa->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Personagens' value='$pessoa->name'>";
                echo "</form>";
            }
        }

        if ($especies->films != []) {
            echo "<h1>Filmes</h1>";
            foreach ($especies->films as $filmes) {
                $ch2 = curl_init($filmes);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $filme = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlFilmes' value='$filme->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Filmes' value='$filme->title'>";
                echo "</form>";
            }
        }
        echo "</div>";
    }

    if ($_POST['Veiculos']) {
        echo "<div class='meio'>";
        $urlveic = $_POST['urlVeiculos'];
        $ch = curl_init($urlveic);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $veiculos = json_decode(curl_exec($ch));
        ?>
        <img src="StarFotos/StarNaves/<?php echo $veiculos->name ?>.png">
        <?php
        echo "<h1>" . $veiculos->name . "</h1><br>";
        echo "Modelo: " . $veiculos->model . "<br>";
        echo "Fabricante: " . $veiculos->manufacturer . "<br>";
        echo "Custo em Créditos: " . $veiculos->cost_in_credits . "<br>";
        echo "Comprimento: " . $veiculos->length . "<br>";
        echo "Velocidade Atmosférica Máxima: " . $veiculos->max_atmosphering_speed . "<br>";
        echo "Equipe: " . $veiculos->crew . "<br>";
        echo "Passageiros: " . $veiculos->passengers . "<br>";
        echo "Capacidade de Carga: " . $veiculos->cargo_capacity . "<br>";
        echo "Consumíveis: " . $veiculos->consumables . "<br>";
        echo "Classe de Veículo: " . $veiculos->vehicle_class . "<br>";

        if ($veiculos->pilots != []) {
            echo "<h1>Pilotos</h1>";
            foreach ($veiculos->pilots as $pilotos) {
                $ch2 = curl_init($pilotos);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $piloto = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlPersonagens' value='$piloto->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Personagens' value='$piloto->name'>";
                echo "</form>";
            }
        }

        if ($veiculos->films != []) {
            echo "<h1>Filmes</h1>";
            foreach ($veiculos->films as $filmes) {
                $ch2 = curl_init($filmes);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $filme = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlFilmes' value='$filme->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Filmes' value='$filme->title'>";
                echo "</form>";
            }
        }
        echo "</div>";
    }

    if ($_POST['Naves']) {
        echo "<div class='meio'>";
        $urlnav = $_POST['urlNaves'];
        $ch = curl_init($urlnav);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $naves = json_decode(curl_exec($ch));
        ?>
        <img src="StarFotos/StarVeiculos/<?php echo $naves->name ?>.png">
        <?php
        echo "<h1>" . $naves->name . "</h1><br>";
        echo "Modelo: " . $naves->model . "<br>";
        echo "Fabricante: " . $naves->manufacturer . "<br>";
        echo "Custo em créditos: ". $naves->cost_in_credits . "<br>";
        echo "Comprimento: " . $naves->length . "<br>";
        echo "Velocidade Atmosférica Máxima: " . $naves->max_atmosphering_speed . "<br>";
        echo "Equipe: " . $naves->crew . "<br>";
        echo "Passageiros: " . $naves->passengers . "<br>";
        echo "Capacidade de Carga: " . $naves->cargo_capacity . "<br>";
        echo "Consumíveis:" . $naves->consumables . "<br>";
        echo "Avaliação do Hiperdrive:" . $naves->hyperdrive_rating . "<br>";
        echo "MGLT: " . $naves->MGLT . "<br>";
        echo "Classe de Nave Estelar" . $naves->starship_class . "<br>";

        if ($naves->pilots != []) {
            echo "<h1>Pilotos</h1>";
            foreach ($naves->pilots as $pilotos) {
                $ch2 = curl_init($pilotos);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $piloto = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlPersonagens' value='$piloto->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Personagens' value='$piloto->name'>";
                echo "</form>";
            }
        }

        if ($naves->films != []) {
            echo "<h1>Filmes</h1>";
            foreach ($naves->films as $filmes) {
                $ch2 = curl_init($filmes);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $filme = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlFilmes' value='$filme->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Filmes' value='$filme->title'>";
                echo "</form>";
            }
        }
        echo "</div>";
    }

    if ($_POST['Filmes']) {
        echo "<div class='meio'>";
        $urlfil = $_POST['urlFilmes'];
        $ch = curl_init($urlfil);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $filmes = json_decode(curl_exec($ch));
        ?>
        <img src="StarFotos/StarFilmes/<?php echo $filmes->title ?>.png">
        <?php
        echo "<h1>" . $filmes->title . "</h1><br>";
        echo "ID do Episódio: " . $filmes->episode_id . "<br>";
        echo "Rastreamento de Abertura: " . $filmes->opening_crawl . "<br>";
        echo "Diretor: " . $filmes->director . "<br>";
        echo "Produtor: " . $filmes->producer . "<br>";
        echo "Data de Lançamento: " . $filmes->release_date . "<br>";
        if ($filmes->characters != '') {
            echo "<h1>Personagens</h1>";
            echo "<div class='meioimg'>";
            foreach ($filmes->characters as $personagens) {
                $ch2 = curl_init($personagens);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $personagem = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlPersonagens' value='$personagem->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Personagens' value='$personagem->name'>";
                echo "</form>";
            }
            echo "</div>";
        }
        if ($filmes->planets != '') {
            echo "<h1>Planetas</h1>";
            foreach ($filmes->planets as $planetas) {
                $ch2 = curl_init($planetas);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $planeta = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlPlanetas' value='$planeta->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Planetas' value='$planeta->name'>";
                echo "</form>";
            }
        }
        if ($filmes->starships != '') {
            echo "<h1>Naves</h1>";
            foreach ($filmes->starships as $naves) {
                $ch2 = curl_init($naves);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $nave = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlNaves' value='$nave->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Naves' value='$nave->name'>";
                echo "</form>";
            }
        }
        if ($filmes->vehicles != '') {
            echo "<h1>Veiculos</h1>";
            foreach ($filmes->vehicles as $veiculos) {
                $ch2 = curl_init($veiculos);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $veiculo = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlVeiculos' value='$veiculo->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Veiculos' value='$veiculo->name'>";
                echo "</form>";
            }
        }
        if ($filmes->species != '') {
            echo "<h1>Especies</h1>";
            foreach ($filmes->species as $especies) {
                $ch2 = curl_init($especies);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $especie = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlEspecies' value='$especie->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Especies' value='$especie->name'>";
                echo "</form>";
            }
        }
        echo "</div>";
    }

    if ($_POST['Planetas']) {
        echo "<div class='meio'>";
        $urlpla = $_POST['urlPlanetas'];
        $ch = curl_init($urlpla);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $planetas = json_decode(curl_exec($ch));
        ?>
        <img src="StarFotos/StarPlanetas/<?php echo $planetas->name ?>.png">
        <?php
        echo "<h1>" . $planetas->name . "</h1><br>";
        echo "Período de Rotação: " . $planetas->rotation_period . "<br>";
        echo "Período Orbital: " . $planetas->orbital_period . "<br>";
        echo "Diâmetro: " . $planetas->diameter . "<br>";
        echo "Clima: " . $planetas->climate . "<br>";
        echo "Gravidade: " . $planetas->gravity . "<br>";
        echo "Terreno: " . $planetas->terrain . "<br>";
        echo "Água da Superfície: " . $planetas->surface_water . "<br>";
        echo "População: " . $planetas->population . "<br>";
        if ($planetas->residents != []) {
            echo "<h1>Personagens</h1>";
            foreach ($planetas->residents as $personagens) {
                $ch2 = curl_init($personagens);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $personagem = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlPersonagens' value='$personagem->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Personagens' value='$personagem->name'>";
                echo "</form>";
            }
        }
        if ($planetas->films != []) {
            echo "<h1>Filmes</h1>";
            foreach ($planetas->films as $filmes) {
                $ch2 = curl_init($filmes);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                $filme = json_decode(curl_exec($ch2));
                echo "<form method='post' action='#'>";
                echo "<input type='hidden' name='urlFilmes' value='$filme->url'>";
                echo "<input type='submit' class='button' style='--color:yellow;cursor:pointer;' name='Filmes' value='$filme->title'>";
                echo "</form>";
            }
        }
        echo "</div>";
    }
    ?>
</body>

</html>