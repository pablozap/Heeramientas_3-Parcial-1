<?php
    include './persona.php';
    $delimitador = ';';
    switch($_POST["opc"]){
        case 1:
            echo "INICIO SESION...<br>";
            $ban = false;
            $archivo = fopen("usuarios.txt", "r");
            while(!feof($archivo)){
                $linea = fgets($archivo);
                if($linea != null){
                    $info = explode(";", $linea);
                    $persona = new Persona($info[0], $info[1], $info[2]);
                    if( $_POST["user"] == $persona->getUser() && $_POST["pass"] == $persona->getPassword()){

                        $ban = true;
                    }
                }
            }
            fclose($archivo);
            if($ban == true){
                echo "Inicio correctamente :)<br>";
            }else{
                echo "NO inicio correctamente :(<br>";
            }
            echo "<br><a href='index.html'>Ir al inicio de sesión...</a>";
            break;
        case 2:
            echo "REGISTRO...";
            $persona = new Persona(trim($_POST["id"]), trim($_POST["user"]), trim($_POST["pass"]));
            $vacio = (!empty($persona->getId()) && !empty($persona->getUser()) && !empty($persona->getPassword()));
            echo $vacio;
            print_r($persona);
            if ($vacio){
                $archivo = fopen("usuarios.txt", "a");
                $usuarioRegistro = $persona->getId() . $delimitador . $persona->getUser(). $delimitador . $persona->getPassword();
                fwrite($archivo, $usuarioRegistro.PHP_EOL);
                fclose($archivo);
            }
            echo "<br><a href='registro.html'>Ir al registro...</a>";
            break;
    }
?>