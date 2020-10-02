<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Website Layout</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!---Estilos enlazados-->
<link rel="stylesheet" type="text/css" href="../css/estilos.css">

</head>
<body>

<div class="logo">Re-Read</div>

<div class="header">
  <h1>Re-Read</h1>
  <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
</div>

<div class="row">
   
  <div class="column left">
 	<div class="topnav">
  		<a href="../index.php">Re-Read</a>
  		<a href="libros.php">Libros</a>
  		<a href="ebooks.php">eBooks</a>
	</div>
    <h2>Toda la actualidad en eBook</h2>
      <!--Nuevo desarrollo: formulario para filtrar autor-->
<div>
    <form action="ebooks.php" method="POST">
    <label for="fautor">Autor</label>
    <input type="text" id="fautor" name="fautor" placeholder="Introduzca el autor...">
    <!--
    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">
    -->

    <label for="country">País</label>
    <select id="country" name="country">
      <option value="%">Todos los países</option>
      <?php
      // 1. Conexión con la base de datos	
      include '../services/connection.php';
      $query="SELECT DISTINCT Authors.Country FROM Authors ORDER BY Country";
      $result=mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result)) {
        echo '<option value="'.$row[Country].'">'.$row[Country].'</option>';
      }
      
      ?>
    </select>
    <input type="submit" value="Buscar">
  </form>
</div>
<?php
// 1. Conexión con la base de datos	
include '../services/connection.php';
if (isset($_POST['fautor'])){
    //Filtrará los ebooks que se mostrarán en la página
    $query="SELECT Books.Description, Books.img, Books.Title 
    FROM Books INNER JOIN BooksAuthors ON Id=BooksAuthors.BookId
    INNER JOIN Authors ON Authors.Id = BooksAuthors.AuthorId
    WHERE Authors.Name LIKE '%{$_POST['fautor']}%'
    AND Authors.Country LIKE '{$_POST['country']}'";
    $result = mysqli_query($conn, $query);
}else{
  //Mostrará todos los ebooks de la DB
  // 1. Conexión con la base de datos.
  //include '../services/connection.php';

  // 2. Selección y muestra de datos de la base de datos.
  $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title FROM Books WHERE eBook != '0'");
}
if(!empty($result)&& mysqli_num_rows($result) > 0) {
  //datos de salida de cada fila (fila = row)
  $i=0;
  while ($row = mysqli_fetch_array($result)) {
      $i++;
      echo "<div class='ebook'>";
      //Añadimos las imagenes a la pagina con la etiqueta img de HTML
      echo "<img src=../img/".$row['img']." alt='".$row['Title']."'>";
      //Añadimos el titulo a la pagina con la etiqueta h2 de HTML
      echo "<div class='desc'>".$row['Description']." </div>";
      echo "</div>";
      if ($i%3==0) {
        echo "<div style='clear:both;'></div>";
      }
  }
} else{
  echo "0 resultados";
}


?>
</div>
  <div class="column right">
    <h2>Top Ventas</h2>
    <?php
// 1. Conexión con la base de datos.
//include '../services/connection.php';

// 2. Selección y muestra de datos de la base de datos.
$result = mysqli_query($conn, "SELECT Books.Title FROM Books WHERE Top = '1'");

if(!empty($result)&& mysqli_num_rows($result) > 0) {
    //datos de salida de cada fila (fila = row)
    while ($row = mysqli_fetch_array($result)) {
    echo "<p>".$row['Title']."</p>";
    }
} else{
    echo "0 resultados";
    
}
?>

</div>
</div>
  
</body>
</html>
