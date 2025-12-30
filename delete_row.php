<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="delete_row.css">
</head>

<body>
<?php // connect.php allows connection to the database

  require 'connect.php'; //using require will include the connect.php file each time it is called.

  function validate()
  {
      global $error;
      global $conn;
      $error = "Book successfully removed.";

      return true;
  }

  if (isset($_POST['id'])) 
  {
    $id     = assign_data($conn, 'id');

    //validation process
    $validated = validate();

    $query = "SELECT id FROM booklists WHERE id = "."'$id'";
    $result   = $conn->query($query);
    
    //id validation check
    if (empty($id))
    {
      $error = "ERROR: Don't leave Book id blank";
      $validated = false;
    }

    else if (!is_numeric($id))
    {
      $error = "ERROR: Book ID must be a numeric value";
      $validated = false;
    }

    else if (!mysqli_num_rows ($result) > 0)
    {
      $error = "ERROR: There's no matching Book id";
      $validated = false;
    }

    else if($validated)
    {
      $query    = "DELETE FROM booklists WHERE id = $id";
      $result   = $conn->query($query);

      if (!$result) 
      {
        echo "<br><br>DELETE failed: $query<br>" .
      
          $conn->error . "<br><br>";
      }
    }
    
  }


  echo<<<_END

    <form action="  " method="post">
    
      Book id <input type="text" name="id"> <br><br>
      <input type="submit" value="DELETE RECORD">
    
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
  
  
  print<<<_HTML
  </table>
    <br>
    <a href="index.php" target="_self"> <p>Home</p></a> 
  _HTML;
  
  
  function assign_data($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
  
?>
</body>	
</html>

