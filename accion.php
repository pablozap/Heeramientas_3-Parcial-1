<?php
    include './persona.php';
    $delimitador = ';';
    switch($_POST["opc"]){
        case 1:
            echo "INICIO SESION...<br>";
            $ban_usuario = false;
            $ban_contrasena = false;
            $archivo = fopen("usuarios.txt", "r");
            while(!feof($archivo)){
                $linea = fgets($archivo);
                if($linea != null){
                    $info = explode(";", $linea);
                    $persona = new Persona($info[0], $info[1], $info[2]);
                    if( $_POST["user"] == $persona->getUser()  ){
                        $ban_usuario = true;
                        if ($_POST["pass"] == $persona->getPassword()){
                            $ban_contrasena = true;
                            break;
                        }
                    } 
                }
            }
            fclose($archivo);
            if($ban_usuario == false){
                echo "El usuario no existe :(<br>";
            }elseif($ban_contrasena== false){
                echo "La contraseña es incorrecta  :(<br>";
            } else {
                echo "Inicio sesión correctamente  :)<br>";
            }
            echo "<br><a href='index.html'>Ir al inicio de sesión...</a>";
            break;
        case 2:
            echo "REGISTRO...<br>";
            $persona = new Persona(trim($_POST["id"]), trim($_POST["user"]), trim($_POST["pass"]));
            $vacio = (!empty($persona->getId()) && !empty($persona->getUser()) && !empty($persona->getPassword()));
            if($vacio) {
                $existe_usuario = false;
                $usuarios = fopen ("usuarios.txt","r");
                while (!feof($usuarios)) {
                    $linea = fgets($usuarios);
                    if ($linea != null){
                    $datos_usuario = explode(";", $linea);
                    $dato_nuevo = new Persona($datos_usuario[0],$datos_usuario[1], $datos_usuario[2]);
                        if ($dato_nuevo->getUser() == $persona->getUser()) {
                        $existe_usuario = true;
                        break;
                        }
                    }
                }
                fclose($usuarios);
                if ($existe_usuario == true){
                    echo "El usuario ya existe ";
                }else {
                    $archivo = fopen("usuarios.txt", "a");
                    $usuarioRegistro = $persona->getId() . $delimitador . $persona->getUser(). $delimitador . $persona->getPassword();
                    fwrite($archivo, $usuarioRegistro.PHP_EOL);
                    fclose($archivo);
                    echo "El usuario fue registrado existosamente";
                }
            }else {
                echo "Solo se permiten letras y números, sin espacios";
            }
            echo '<br><a href="registro.html">Ir al registro</a>';
        break;
    }
?>