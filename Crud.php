<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
    <link rel="stylesheet" href="Crud.css">
</head>
<body>
    <div class="nav">
        <h1 class="color">Aromática_Crud</h1>
        <form class="formnav" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input class="botonnav" type="submit" name="nuevo" value="Nuevo Producto">
        </form>
    </div>

    <?php
    $servername = "localhost";
    $username = "root"; // Nombre de usuario por defecto para MySQL
    $password = ""; // Contraseña por defecto para MySQL
    $dbname = "proyecto_catálogo"; // Tu nombre de la base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprobar conexión
    if ($conn->connect_error) {
        die("Conección fallida: " . $conn->connect_error);
    }
    echo "Conectado correctamente";

    //Nuevo producto
    if(isset($_POST['nuevo'])){
        // Obtener categorías
        $categorias = $conn->query("SELECT ID_Categoria, Nombre FROM categría");
        $diseñadores = $conn->query("SELECT ID_Diseñador, Nombre_Marca FROM diseñador");
        ?>
        <h1 class="titulo">Nuevo Producto</h1>
        <form class="Nproducto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Nombre: <input type="text" name="Nombre" placeholder="Nombre" required><br>
            Descripcion: <input type="text" name="Descripción" placeholder="Descripcion" required><br>
            Precio: <input type="text" name="Precio" placeholder="Precio" required><br>
            Categoría: 
            <select name="ID_Categoria" required>
                <?php while($categoria = $categorias->fetch_assoc()) { ?>
                    <option value="<?php echo $categoria['ID_Categoria']; ?>"><?php echo $categoria['Nombre']; ?></option>
                <?php } ?>
            </select><br>
            Diseñador:
            <select name="ID_Diseñador" required>
                <?php while($diseñador = $diseñadores->fetch_assoc()) { ?>
                    <option value="<?php echo $diseñador['ID_Diseñador']; ?>"><?php echo $diseñador['Nombre_Marca']; ?></option>
                <?php } ?>
            </select><br>
            <div class="botones">
                <input class="boton" type="submit" name="Cancelar" value="Cancelar">
                <input class="boton" type="submit" name="insertar" value="Insertar">
            </div>
        </form>
        <?php
    } else if (isset($_POST['insertar'])) {
        $nombre = $_POST['Nombre'];
        $descripcion = $_POST['Descripción'];
        $precio = $_POST['Precio'];
        $id_categoria = $_POST['ID_Categoria'];
        $id_diseñador = $_POST['ID_Diseñador'];

        $sql = "INSERT INTO producto (Nombre, Descripción, Precio, ID_Categoria, ID_Diseñador) VALUES ('$nombre', '$descripcion', '$precio', '$id_categoria', '$id_diseñador')";

        if ($conn->query($sql) === TRUE) {
            ?> <div><p class="centrar">Producto insertado correctamente</p></div> <?php
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else if (isset($_POST['editar'])) {
        // Obtener categorías y diseñadores para el formulario de edición
        $categorias = $conn->query("SELECT ID_Categoria, Nombre FROM categría");
        $diseñadores = $conn->query("SELECT ID_Diseñador, Nombre_Marca FROM diseñador");
        ?>
        <h1 class="titulo">Editar Producto</h1>
        <form class="Nproducto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="ID_Producto" value="<?php echo $_POST['ID_Producto']; ?>">
            Nombre: <input type="text" name="Nombre" value="<?php echo $_POST['Nombre']; ?>" required><br>
            Descripcion: <input type="text" name="Descripción" value="<?php echo $_POST['Descripción']; ?>" required><br>
            Precio: <input type="text" name="Precio" value="<?php echo $_POST['Precio']; ?>" required><br>
            Categoría: 
            <select name="ID_Categoria" required>
                <?php while($categoria = $categorias->fetch_assoc()) { ?>
                    <option value="<?php echo $categoria['ID_Categoria']; ?>" <?php if($categoria['ID_Categoria'] == $_POST['ID_Categoria']) echo 'selected'; ?>><?php echo $categoria['Nombre']; ?></option>
                <?php } ?>
            </select><br>
            Diseñador:
            <select name="ID_Diseñador" required>
                <?php while($diseñador = $diseñadores->fetch_assoc()) { ?>
                    <option value="<?php echo $diseñador['ID_Diseñador']; ?>" <?php if($diseñador['ID_Diseñador'] == $_POST['ID_Diseñador']) echo 'selected'; ?>><?php echo $diseñador['Nombre_Marca']; ?></option>
                <?php } ?>
            </select><br>
            <div class="botones">
                <input class="boton" type="submit" name="Cancelar" value="Cancelar">
                <input class="boton" type="submit" name="actualizar" value="Actualizar">
            </div>
        </form>
        <?php
    } else if (isset($_POST['actualizar'])) {
        $id_producto = $_POST['ID_Producto'];
        $nombre = $_POST['Nombre'];
        $descripcion = $_POST['Descripción'];
        $precio = $_POST['Precio'];
        $id_categoria = $_POST['ID_Categoria'];
        $id_diseñador = $_POST['ID_Diseñador'];

        $sql = "UPDATE producto SET Nombre='$nombre', Descripción='$descripcion', Precio='$precio', ID_Categoria='$id_categoria', ID_Diseñador='$id_diseñador' WHERE ID_Producto='$id_producto'";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Producto actualizado correctamente</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else if (isset($_POST['borrar'])) {
        $sql = "DELETE FROM producto WHERE ID_Producto = '" . $_POST['ID_Producto'] . "'";
        $result = $conn->query($sql);
        if($result){
            echo "<p>Producto eliminado correctamente</p>";
        }
    }

    //Mostramos listado de productos.
    $sql = "SELECT * FROM producto";
    $result = $conn->query($sql);
    $lista_productos = $result->fetch_all(MYSQLI_ASSOC);
    ?><div class="divTabla"><table class="tabla" ><tr>
        <th>ID_Producto</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>ID_Categoria</th>
        <th>ID_Diseñador</th>
        </tr></div>
        <?php

    foreach ($lista_productos as $producto ){
        echo"<tr>";
        echo "<td>".$producto['ID_Producto']."</td>";
        echo "<td>".$producto['Nombre']."</td>";
        echo "<td>".$producto['Descripción']."</td>";
        echo "<td>".$producto['Precio']."</td>";
        echo "<td>".$producto['ID_Categoria']."</td>";
        echo "<td>".$producto['ID_Diseñador']."</td>";
        echo "</tr>";

        //En cada fila ponemos un boton para editar los datos de los productos.
        echo "<td><form action='". $_SERVER['PHP_SELF'] ."' method='post'>";
        echo "<input type='hidden' name='ID_Producto' value='".$producto['ID_Producto']."'>";
        echo "<input type='hidden' name='Nombre' value='".$producto['Nombre']."'>";
        echo "<input type='hidden' name='Descripción' value='".$producto['Descripción']."'>";
        echo "<input type='hidden' name='Precio' value='".$producto['Precio']."'>";
        echo "<input type='hidden' name='ID_Categoria' value='".$producto['ID_Categoria']."'>";
        echo "<input type='hidden' name='ID_Diseñador' value='".$producto['ID_Diseñador']."'>";
        echo "<input type='submit' name='editar' value='Editar'/></form></td>";

        //En cada fila ponemos un boton para borrar los datos de los productos.
        echo "<td><form action='". $_SERVER['PHP_SELF'] ."' method='post'>";
        echo "<input type='hidden' name='ID_Producto' value='".$producto['ID_Producto']."'>";
        echo "<input type='submit' name='borrar' value='Borrar'/></form></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>