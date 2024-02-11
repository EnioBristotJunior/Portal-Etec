<?php include_once("nav.php");

if (isset($_GET["data"])) {
    $data = $_GET["data"];
} else {
    $data = 0;
}
if (isset($_GET["per"])) {
    $per = $_GET["per"];
} else {
    $per = 0;
}

if (isset($_GET["search"])) {
    $search = $_GET["search"];
} else {
    $search = "nada";
}


?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/cursos.css" />
</head>

<body>
    <div class="filtro-all">
        <div class="filtro">
            <p>Filtrar</p>
            <ion-icon name="options-outline" id="open-options"></ion-icon>
        </div>
        <div class="opcoes-filtro">
            <div class="opcoes">
                <div class="opcoesCada">
                    <div class="opcoes-header">
                        <h3>Curso:</h3>
                    </div>
                    <div class="opcoes-body">
                        <ul>
                            <li>
                                <input type="radio" name="cursos" value="1" id="ds-option" autocomplete="off" required
                                    <?php if ($data == 1)
                                        echo "checked"; ?> />
                                <label for="ds-option">Des. de Sistemas</label>
                                <div class="check">
                                </div>
                            </li>

                            <li><input type="radio" name="cursos" value="2" id="adm-option" autocomplete="off" <?php if ($data == 2)
                                echo "checked"; ?> /> <label for="adm-option">Administração</label>
                                <div class="check">
                                    <div class="inside"></div>
                                </div>
                            </li>


                            <li>
                                <input type="radio" name="cursos" value="3" id="mkt-option" autocomplete="off" <?php if ($data == 3)
                                    echo "checked"; ?> />
                                <label for="mkt-option">Marketing
                                </label>

                                <div class="check">
                                    <div class="inside"></div>
                                </div>
                            </li>

                            <li><input type="radio" name="cursos" value="todos" id="cursos-todos-option"
                                    autocomplete="off" <?php if ($data == "todos")
                                        echo "checked"; ?> />
                                <label for="cursos-todos-option">Todos</label>
                                <div class="check">
                                    <div class="inside"></div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="opcoesCada">
                    <div class="opcoes-header">
                        <h3>Período:</h3>
                    </div>
                    <div class="opcoes-body">

                        <ul>
                            <li><input type="radio" name="periodo" value="matutino" id="matutino-option"
                                    autocomplete="off" required <?php if ($per == "matutino")
                                        echo "checked"; ?> />
                                <label for="matutino-option">Manhã</label>
                                <div class="check"></div>
                            </li>


                            <li><input type="radio" name="periodo" value="vespertino" id="vespertino-option"
                                    autocomplete="off" <?php if ($per == "vespertino")
                                        echo "checked"; ?> />
                                <label for="vespertino-option">Tarde</label>
                                <div class="check">
                                    <div class="inside"></div>
                                </div>
                            </li>



                            <li><input type="radio" name="periodo" value="todos" id="periodo-todos-option"
                                    autocomplete="off" <?php if ($per == "todos")
                                        echo "checked"; ?> />
                                <label for="periodo-todos-option">Todos</label>
                                <div class="check">
                                    <div class="inside"></div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <input type="submit" value="Aplicar" class="btn-filtro" id="btn-filtro">
        </div>

    </div>


    <?php
    $tcc = [];

    if (!empty($_GET["search"])) {

        echo "<div class='tome-resultado'>";
        echo "<h2 class='search-resposta'>Resultados da Pesquisa:</h2>";
        echo "<h2 id='tome-tome'>" . $search . " <h2/>";
        echo "</div>";
        $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/'));
        foreach ($iter as $file) {
            if ($file->getFilename() == '.') {

                $itens = new DirectoryIterator($file->getPath());
                foreach ($itens as $item) {
                    if ($item->getExtension() == "json") {
                        $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                        $foto = "";
                        $video = "";
                        $qrcode = "";
                        //procura foto ou vídeo na pasta do grupo
                        $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                        $itensgrupo = new DirectoryIterator($pasta_grupo);
                        foreach ($itensgrupo as $itemgrupo) {
                            if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                            } elseif ($itemgrupo->getExtension() == "mp4") {
                                $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                            } elseif ($itemgrupo->getExtension() == "svg") {
                                $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                            }
                        }
                        array_push(
                            $tcc,
                            array(
                                "titulo" => $grupo->titulo,
                                "descricao" => $grupo->descricao,
                                "curso" => $grupo->curso,
                                "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                "pasta" => $file->getPath(),
                                "foto" => $foto
                            )
                        );
                    }
                }
            }
        }



        //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
    
        try {
            $encontrado = false;
            echo "<div class='cards'>";

            foreach ($tcc as $item) {
                if (preg_match("/{$search}/i", $item["titulo"]) || preg_match("/{$search}/i", $item["descricao"])) {
                    echo "<div class='tcc-card'>";
                    echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "'  >";
                    echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                    echo "</div>";
                    $encontrado = true;
                }
            }
            echo "</div>";
            if (!$encontrado) {
                echo "<div><h1 class='search-respostaTwo'>Não foram encontrados resultados.</h1></div>";
            }

        } catch (Exception $receba) {
            echo $receba;
        }




    }
    if ($data == 1) {

        if ($per == "matutino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/DS/dsa'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()'/>";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        } elseif ($per == "vespertino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/DS/dsb/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' />";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        } else {



            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/DS/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' />";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        }



    } elseif ($data == 2) {

        if ($per == "matutino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/ADM/adma/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        } elseif ($per == "vespertino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/ADM/admb/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        } else {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/ADM/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        }


    } elseif ($data == 3) {


        if ($per == "matutino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/MKT/mkta/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "turma" => $grupo->turma,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        } elseif ($per == "vespertino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/MKT/mktb/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "turma" => $grupo->turma,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";

        } else {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/MKT/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "turma" => $grupo->turma,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        }


    } elseif ($data == "todos") {
        if ($per == "matutino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/'));

            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto,
                                    "periodo" => $grupo->periodo
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
    
            echo "<div class='cards'>";
            foreach ($tcc as $item) {
                if (isset($item["periodo"])) {
                    if ($item["periodo"] == "matutino") {
                        echo "<div class='tcc-card'>";
                        echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                        echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                        echo "</div>";
                    }


                }

            }
            echo "</div>";



        } elseif ($per == "vespertino") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto,
                                    "periodo" => $grupo->periodo
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {
                if (isset($item["periodo"])) {
                    if ($item["periodo"] == "vespertino") {
                        echo "<div class='tcc-card'>";
                        echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                        echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                        echo "</div>";
                    }
                }
            }

            echo "</div>";
        } elseif ($per == "todos") {
            $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./2023/'));
            foreach ($iter as $file) {
                if ($file->getFilename() == '.') {

                    $itens = new DirectoryIterator($file->getPath());
                    foreach ($itens as $item) {
                        if ($item->getExtension() == "json") {
                            $grupo = json_decode(file_get_contents($file->getPath() . "/" . $item->getFilename()));

                            $foto = "";
                            $video = "";
                            $qrcode = "";
                            //procura foto ou vídeo na pasta do grupo
                            $pasta_grupo = $file->getPath(); //."/".str_replace(".json","",$item->getBasename())."/";
                            $itensgrupo = new DirectoryIterator($pasta_grupo);
                            foreach ($itensgrupo as $itemgrupo) {
                                if (in_array($itemgrupo->getExtension(), ["jpg", "jpeg", "gif", "png"])) {
                                    $foto = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "mp4") {
                                    $video = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                } elseif ($itemgrupo->getExtension() == "svg") {
                                    $qrcode = $pasta_grupo . "/" . $itemgrupo->getFilename();
                                }
                            }
                            array_push(
                                $tcc,
                                array(
                                    "titulo" => $grupo->titulo,
                                    "descricao" => $grupo->descricao,
                                    "curso" => $grupo->curso,
                                    "arquivo" => $file->getPath() . "/" . $item->getFilename(),
                                    "pasta" => $file->getPath(),
                                    "foto" => $foto
                                )
                            );
                        }
                    }
                }
            }


            //array_multisort(array_column($tcc, "curso"), SORT_ASC, $tcc);
            echo "<div class='cards'>";
            foreach ($tcc as $item) {

                echo "<div class='tcc-card'>";
                echo "<img src=" . $item["foto"] . " class='imagem' onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' onclick='mostra()' >";
                echo "<h1 id='card-title'>" . $item["titulo"] . "</h1><p id='card-description'>" . $item["descricao"] . "</p><button onclick= location.href='tcc.php?tcc=" . str_replace("\\", "/", $item["arquivo"]) . "&pasta=" . str_replace("\\", "/", $item["pasta"]) . "' class='btn-card'>Ver</button> ";
                echo "</div>";
            }
            echo "</div>";
        }



    }

    ?>

    <script>
        var btnFiltro = document.getElementById("open-options");
        var opcoes = document.querySelector(".opcoes-filtro");
        btnFiltro.addEventListener("click", function () {
            if (opcoes.style.display === "block") {
                opcoes.style.display = "none";
            } else {
                opcoes.style.display = "block";
            }

        });

        var btnAplica = document.getElementById("btn-filtro")
        btnAplica.addEventListener("click", function () {
            try {



                //Radios
                var escolha = document.querySelector('input[name="cursos"]:checked');
                var escolhaP = document.querySelector('input[name="periodo"]:checked');


                window.location = 'cursos.php?data=' + escolha.value + '&per=' + escolhaP.value;


            } catch (Exception) {
                alert("Escolha as opções de curso e período corretamente!")
            }
        });


    </script>
</body>

</html>

<?php include_once("footer.php"); ?>