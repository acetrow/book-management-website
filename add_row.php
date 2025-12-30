<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="add_row.css">
</head>

<body>
<?php // connect.php allows connection to the database

  require 'connect.php'; //using require will include the connect.php file each time it is called.
  
  function validate()
  {
      global $error;
      global $conn;
      $error = "Book successfully added.";

      return true;
  }

  if (isset($_POST['id'])   &&
      isset($_POST['title']) &&
      isset($_POST['author']) &&
      isset($_POST['genre']) &&
      isset($_POST['year'])
      ) 
  {
    $id     = assign_data($conn, 'id');
    $title  = assign_data($conn, 'title');
    $author = assign_data($conn, 'author');
    $genre = assign_data($conn, 'genre');
    $year = assign_data($conn, 'year');

    //validation process

    $validated = validate();

    //check if id exists already
    $query = "SELECT id FROM booklists WHERE id = "."'$id'";
    $result = $conn->query($query);

    //id validation check
    if (mysqli_num_rows ($result) > 0)
    {
      $error = "ERROR: Book id already exists";
      $validated = false;
    }

    else if (empty($id))
    {
      $error = "ERROR: Don't leave Book id blank";
      $validated = false;
    }

    else if (!is_numeric($id))
    {
      $error = "ERROR: Book ID must be a numeric value";
      $validated = false;
    }
    
    else if(strlen($id) > 3){
      $error = "ERROR: Book ID must not be longer than 3 digits";
      $validated = false;
    }
    
    //title validation check
    else if (empty($title))
    {
      $error = "ERROR: Don't leave Book Title blank";
      $validated = false;
    }

    else if(strlen($title) > 20){
      $error = "ERROR: Book Title must not be longer than 20 digits";
      $validated = false;
    }

    //author validation check
    else if (empty($author))
    {
      $error = "ERROR: Don't leave Book Author blank";
      $validated = false;
    }

    else if(strlen($author) > 30){
      $error = "ERROR: Book Author must not be longer than 30 digits";
      $validated = false;
    }

    //genre validation check
    else if (empty($genre))
    {
      $error = "ERROR: Don't leave Book Genre blank";
      $validated = false;
    }

    else if(strlen($genre) > 30){
      $error = "ERROR: Book title must not be longer than 30 digits";
      $validated = false;
    }

    //year validation check
    else if (empty($year))
    {
      $error = "ERROR: = Don't leave Year Published blank";
      $validated = false;
    }
    else if (!is_numeric($year))
    {
      $error = "ERROR: Year Published must be a numeric value";
      $validated = false;
    }

    else if ($year < 1400 || $year > 2023) 
    { 
      $error = "ERROR: Invalid Year Published. Please enter a valid year";
      $validated = false;
    }
    
    else if($validated)
    {
      $query    = "INSERT INTO booklists VALUES ('$id', '$title', '$author', '$genre', '$year')";
    
      $result   = $conn->query($query);
      if (!$result) 
      {
        echo "<br><br>INSERT failed: $query<br>" .
    
        $conn->error . "<br><br>";
      } 
    }

  }


  echo<<<_END
    <form action="  " method="post">
    
      Book id <input type="text" name="id"> <br><br>
      Book title <input type="text" name="title"> <br><br>
      Author name <input type="text" name="author"> <br><br>
      Genre <input type="text" name="genre"> <br><br>
      Year Published <input type="text" name="year"> <br><br>
        
      <input type="submit" value="ADD RECORD">
      <br>
    </form>
  _END;

  echo "<p>";
  if (isset($error))
  {
    echo '<p class="error">' . $error . '</p>';//displays error message
  }
  echo "</p>";


  print<<<_HTML
    
    <p> Here is your Books list </p>
    
    <table id = "book_table">
        <tr>
        <th>Book id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Year Published</th>
        </tr>
  _HTML;


  $query  = "SELECT * FROM booklists";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  if ($result->num_rows >0)
	{
		while($row = $result->fetch_assoc()) 
		{
					echo "<tr>";
					echo "<td>".$row["id"]."</td>";
					echo "<td>".$row["title"]."</td>";
         				echo "<td>".$row["author"]."</td>";
					echo "<td>".$row["genre"]."</td>";
		            echo "<td>".$row["year"]."</td>";
				    		
					echo "</tr>";
		}
	} 
	else 
	{
		echo "0 results";
	}
	 
  
  
  function assign_data($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
  
    print<<<_HTML
  </table>
    <br>
    <a href="index.php" target="_self"> <p>Home</p></a> 
  _HTML;
  
  
?>
</body>	
</html>

