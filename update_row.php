<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="update_row.css">
</head>

<body>
<?php // connect.php allows connection to the database

  require 'connect.php'; //using require will include the connect.php file each time it is called.

  function validate()
  {
      global $error;
      global $conn;
      $error = "Book successfully updated.";

      return true;
  }

  if (isset($_POST['id']) && 
      isset($_POST['title']) && 
      isset($_POST['author']) &&
      isset($_POST['genre']) &&
      isset($_POST['year']) 
      ) 
    
  {
    $id = assign_data($conn, 'id');
    $title = assign_data($conn, 'title');
    $author = assign_data($conn, 'author');
    $genre = assign_data($conn, 'genre');
    $year = assign_data($conn, 'year');

    $validated = validate();
    $check_query = "SELECT id FROM booklists WHERE id = '$id'";
    $check = $conn->query($check_query);

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
    
    else if(strlen($id) > 3)
    {
      $error = "ERROR: Book ID must not be longer than 3 digits";
      $validated = false;
    }

    else if ($check->num_rows < 1) 
    {
      $error = "ERROR: Book id does not found in database";
      $validated = false;
    }
    //all blank validation check
    else if(empty($title) && empty($author) && empty($genre) && empty($year))
    {
      $error = "No changes detected";
      $validated = false;
    }

    //title validation check

    else if(strlen($title) > 20)
    {
      $error = "ERROR: Book Title must not be longer than 20 digits";
      $validated = false;
    }

    else if (!empty($title) && $validated)
    {
    
      $query    = "UPDATE booklists SET title = '$title' WHERE id = '$id'";
    
      $result   = $conn->query($query);
      
        
      if (!$result) 
      {
        echo "<br><br>UPDATE failed: $query<br>" . $conn->error . "<br><br>";
      }
    
    }

    //author validation check

    else if(strlen($author) > 30)
    {
      $error = "ERROR: Book Author must not be longer than 30 digits";
      $validated = false;
    }

    else if (is_numeric($author))
    {
      $error = "ERROR: Book Author must not be a numeric value";
      $validated = false;
    }

    else if (!empty($author) && $validated)
    {
    
      $query    = "UPDATE booklists SET author = '$author' WHERE id = '$id'";
    
      $result   = $conn->query($query);
      
        
      if (!$result) 
      {
        echo "<br><br>UPDATE failed: $query<br>" . $conn->error . "<br><br>";
      }
    
    }

    //genre validation check

    else if(strlen($genre) > 30)
    {
      $error = "ERROR: Book title must not be longer than 30 digits";
      $validated = false;
    }

    else if (!empty($genre) && $validated)
    {
    
      $query    = "UPDATE booklists SET genre = '$genre' WHERE id = '$id'";
    
      $result   = $conn->query($query);
      
        
      if (!$result) 
      {
        echo "<br><br>UPDATE failed: $query<br>" . $conn->error . "<br><br>";
      }
    
    }

    //year validation check

    else if (!is_numeric($year) && !empty($year))
    {
      $error = "ERROR: Year Published must be a numeric value";
      $validated = false;
    }

    else if (($year < 1400 || $year > 2023) && !empty($year)) 
    { 
      $error = "ERROR: Invalid Year Published. Please enter a valid year";
      $validated = false;
    }

    else if (!empty($year) && $validated)
    {
    
      $query    = "UPDATE booklists SET year = '$year' WHERE id = '$id'";
    
      $result   = $conn->query($query);
      
        
      if (!$result) 
      {
        echo "<br><br>UPDATE failed: $query<br>" . $conn->error . "<br><br>";
      }
    
    }

     
  }
  
  echo '<p>';
  echo '<p class="notes"><strong><span style="font-size: 18px;">Important Note:</span></strong> When making updates, kindly provide information only for the fields that require modifications. It is acceptable to leave any unchanged fields blank.</p>';
  echo '</p>';
  
  

  echo<<<_END
    <form action="" method="post">
      <p<strong>Book id</strong> <input type="text" name="id"> (required)<br><br>
      Book title <input type="text" name="title"> (optional)<br><br>
      Author name <input type="text" name="author"> (optional)<br><br>
      Genre <input type="text" name="genre"> (optional)<br><br>
      Year Published <input type="text" name="year"> (optional)<br><br>
      
      <input type="submit" value="UPDATE RECORD">
    
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
