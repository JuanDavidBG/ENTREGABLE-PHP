<?php

require('conexion.php');

$db = "";
$conexion = "";

$db = new Conexion();
$conexion = $db->getConexion();

$sql = "SELECT * FROM ciudades";

$bandera = $conexion->prepare($sql);
$bandera->execute();
$ciudades = $bandera->fetchAll();


$sql = "SELECT * FROM generos";

$bandera = $conexion->prepare($sql);
$bandera->execute();
$generos = $bandera->fetchAll();

$sql = "SELECT * FROM lenguajes";

$bandera = $conexion->prepare($sql);
$bandera->execute();
$lenguajes = $bandera->fetchAll();

?>

<head>
    <style> 
        *{
            box-sizing: border-box;
            background-color: #00fff7;
        }

        .genero__item{
            display: flex;
            flex-direction: column;
        }

        .genero__contenedor{
            width: 100px;
            display: flex;
            margin-top: 10px;
            justify-content: space-between;
        }

        .form{
            display: flex;
        }

        .contenedor__label{
            margin-top: 10px;
        }

        .formulario-contenedor{
           
        }
    </style>
</head>
<div class="formulario-contenedor">
    <h1> Formulario</h1>
    <form action="envio.php" method="post">
        <div class="contenedor__label">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required pattern="^[a-zA-Z\s]{2,}$" autocomplete="off">
        </div>

        <div class="contenedor__label">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" required pattern="^[a-zA-Z\s]{2,}$" autocomplete="off">
        </div>

        <div class="contenedor__label">
            <label for="correo">Correo</label>
            <input type="text" id="correo" name="correo" required autocomplete="off">
        </div>

        <div class="contenedor__label">
            <label for="fecha">Fecha de nacimiento</label>
            <input type="date" id="fecha" name="fecha" required max="<?=date('Y')?>-<?=date('m')?>-<?=date('d')?>">
        </div>

        <div class="contenedor__label">
            <label for="ciudad_id">Ciudad: </label>
            <select name="ciudad_id" id="ciudad_id" name="ciudad" required>
                <?php 
                    foreach ($ciudades as $key => $value) {
                        echo $value;
                ?>      <option value="<?= $value['id'] ?>" value="<?= $value['id'] ?>">
                            <?= $value['nombre'] ?>
                        </option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="genero-contenedor">
            <p>Seleccione su genero:</p>
            <div class="genero">
            <?php 
                foreach ($generos as $key => $value) {
            ?>
                    <div class="genero__contenedor">
                        <label for="<?= $value['id'] ?>" class="genero__label">
                            <?= $value['nombre'] ?>
                        </label>
                        <input type="radio" id="<?= $value['id'] ?>" value="<?= $value['id'] ?>" name="genero" class="genero__input" required> 
                    </div>
                    
            <?php
                }
            ?>
            </div>
        </div>

        <div class="lenguajes-contenedor">
            <p>Seleccione sus lenguajes:</p>
            <div class="lenguajes">
            <?php 
                foreach ($lenguajes as $key => $value) {
            ?>
                    <div class="">
                        <label for="<?= $value['id'] ?>" class="genero__label">
                            <?= $value['nombre'] ?>
                        </label>
                        <input type="checkbox" id="<?= $value['id'] ?>" value="<?= $value['id'] ?>" name="lenguaje[]">
                    </div>
                    
            <?php
                }
            ?>
            </div>
        </div>

        <button type="submit">Enviar</button>
    </form>
</div>