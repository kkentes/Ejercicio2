<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Datos del empleado</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!--[if lt IE 9]>
<script
src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
    <body class='container'>
    <?php
    function __autoload($class_name) {
        include_once("class/" . $class_name . ".class.php");
    }
    if(isset($_POST['enviar'])){
        if(isset($_POST['enviar'])){
            echo "<h3>Libro</h3>";
            $autor = (isset($_POST['autor'])) ? $_POST['autor'] : "";
            $Tlibro = (isset($_POST['Tlibro'])) ? $_POST['Tlibro'] : "";
            $Nedicion = (isset($_POST['Nedicion'])) ? intval($_POST['Nedicion']) : 0;
            $Lpublicacion = (isset($_POST['Lpublicacion'])) ? $_POST['Lpublicacion'] : "";
            $editorial = (isset($_POST['editorial'])) ? $_POST['editorial'] : "";
            $Aedicion = (isset($_POST['Aedicion'])) ? date($_POST['Aedicion']) : "";
            $Npaginas = (isset($_POST['Npaginas'])) ? intval($_POST['Npaginas']) : 0;
            $Notas = (isset($_POST['Notas'])) ? $_POST['Notas'] : "";
            $ISBN = (isset($_POST['ISBN'])) ? intval($_POST['ISBN']) : 0;
            //Creando instancias de la clase empleado
            $libro1 = new libro();
            $libro1->obtenerlibro($autor, $Tlibro, $Nedicion, $Lpublicacion, $editorial, $Aedicion, $Npaginas, $Notas, $ISBN);
        }
    }
    else{
        ?>
        <section class="container">
            <nav class="navbar navbar-dark bg-primary text-white">
                <h1>Formulario</h1>
            </nav>
        <article>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" size="25" maxlength="30" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="Tlibro">Titulo del libro:</label>
                <input type="text" name="Tlibro" id="Tlibro" size="25" maxlength="30" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="Nedicion">Numero de edicion:</label>
                <input type="text" name="Nedicion" id="Nedicion" size="8" maxlength="2" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="Lpublicacion">Lugar de la publicacion</label>
                <input type="text" name="Lpublicacion" id="Lpublicacion" size="4" maxlength="30" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="editorial">Editorial:</label>
                <input type="text" name="editorial" id="editorial" size="4" maxlength="6" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="Aedicion">Año de la edicion:</label>
                <input type="text" name="Aedicion" id="Aedicion" size="4" maxlength="6" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="Npaginas">Numero de paginas</label>
                <input type="text" name="Npaginas" id="Npaginas" size="4" maxlength="6" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="Notas">Notas:</label>
                <input type="text" name="Notas" id="Notas" size="4" maxlength="13" class="inputField form-control" /><br />
            </div>
            
            <div class="form-group">
                <label for="ISBN">ISBN:</label>
                <input type="text" name="ISBN" id="ISBN" size="4" maxlength="6" class="inputField form-control" /><br />
            </div>
        <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Enviar" class="inputButton" />&nbsp;
        <input type="reset" name="limpiar" class="btn btn-primary mb-2" value="Restablecer" class="inputButton" />
        </fieldset>
    </form>
    <?php
}
?>
</article>
</section>


<!-----------------------------------------------------------     Falta las expresiones regulares ----------------------------------------------------------------->
<?php
            $error = array();// este arreglo muestra errores encontrados
            $info = array();// este arreglo almaena toda la informacion que viene del formulario
            // Expresion para nuestro Carnet UDB:
            $canetvalido = "/[A-Z]{2}[0-9]{6}/";
            // Expresion para nuestro nombre y apellido:
            $texto_valido = "/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/";
            // Expresion solo numeros
            $edad_valida = "/[0-9]{2}/";
            // Expresion para el correo electronico:
            $correovalido = "/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/";
            // empty nos ayuda a que no hayan datos vacios:
            if( !empty($_POST) )
            {
                // Verificamos los datos que llegaron del formulario:
                if( isset($_POST['txtNombre']) && isset($_POST['txtApellidos']) )
                {
                    // Nombres:
                    if( empty($_POST['autor']) )
                        $error[] = "Debes ecribir tu nombre";
                    else
                    {
                        // AQUI USAMOS LA EXPRESION REGULAR: para ver si el nombre solo tiene letras:
                        if( preg_match($texto_valido, $_POST['autor']) )
                            $info[] = "autor: [".$_POST['autor']."]";
                        else
                            $error[] = "El nombre sólo puede contener letras.";
                    }

                    // Apellidos:
                    if( empty($_POST['txtApellidos']) )
                        $error[] = "Debes ecribir tus apellidos";
                    else
                    {
                        // AQUI USAMOS LA EXPRESION REGULAR: para ver si el apellido solo tiene letras:
                        if( preg_match($texto_valido, $_POST['txtApellidos']) )
                            $info[] = "Apellidos: [".$_POST['txtApellidos']."]";
                        else
                            $error[] = "Los apellidos sólo pueden contener letras.";
                    }
                    // Edad:
                    if( (isset($_POST['txtEdad']) ) && (!empty($_POST['txtEdad'])) )
                    {
                        // AQUI USAMOS LA EXPRESION REGULAR: para que solo se ingresen dos numeros del 0 al 9
                        if( preg_match($edad_valida, $_POST['txtEdad']) )
                            $info[] ="Edad: [".$_POST['txtEdad']."]";
                        else
                            $error[] = "La edad solo puede ser escrita con numeros.";
                    }
                    // Correo electronico:
                    if( empty($_POST['txtCorreo']) )
                        $error[] = "Debes ecribir un correo valido";
                    else
                    {
                        // AQUI USAMOS LA EXPRESION REGULAR: para ver si el correo tiene el formato establecido en la expresion regular:
                        if( preg_match($correovalido, $_POST['txtCorreo']) )
                            $info[] = "Correo electronico: [".$_POST['txtCorreo']."]";
                        else
                            $error[] = "Debes escribir una dirección de correo valida.";
                    }
                    // Carnet:
                    if( empty($_POST['txtCarnet']) )
                     $error[] = "Debes ecribir un carnet valido";
                    else
                    {
                        // AQUI USAMOS LA EXPRESION REGULAR: para ver si el carnet comienza por dos letras mayusculas y seis numeros
                        if( preg_match($canetvalido, $_POST['txtCarnet']) )
                            $info[] = "Carnet UDB: [".$_POST['txtCarnet']."]";
                        else
                            $error[] = "Debes escribir un carnet valido.";
                    }
                }
                else
                {
                    // Mensaje de error si hay campos vacios
                    echo "<legend>Campos vacion o no aceptados</legend>";
                }
                // Si la expresiones regulares NO se cumplen, nos mostrara cuales han sido
                if( count($error) > 0 )
                {
                    echo "<legend>Datos incorrectos:</legend>";
                    // Con este for los mostramos
                    for( $contador=0; $contador < count($error); $contador++ )
                    echo $error[$contador]."<br/>";
                }
                else
                {
                    // Si todos los campos estan correctos se mostrara este mensaje
                    echo "<legend>Todos tus datos son aceptados.</legend>";
                }
            }
            else
            {
                echo "<legend>Aqui hay datos no validos, revisalos.</legend>";
            }
            echo "<br>"; 
            //echo "<p><a href='../index.php' type='button' class='btn btn-secondary'>Volver al inicio</a></p>";
        ?>
</body>
</html>