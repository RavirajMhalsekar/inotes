<?php 

// INSERT INTO `notes` (`Sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'buy book', 'go buy books', current_timestamp());
  $insert = false;
  //connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "notes";
  
  //  create a connection
  $conn = mysqli_connect($servername,$username,$password,$database);

  // die of connection was not successful
  if(!$conn){
    die("sorry we failed to connect: ". mysqli_connect_error());
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST["title"];
    $description = $_POST["description"];

    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn,$sql);
    if($result){
      // echo "The record has been inserted successfully! <br>";
      $insert = true;
    }else{
      echo "The record was not been inserted! " . mysqli_error($conn);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iNotes</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">iNotes</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>
    <?php 
      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong> Success!</strong> Your note has been inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    ?>
    <div class="container my-4">
      <h2>Add a note</h2>
      <form action="/inotes/index.php" method="post">
        <div class="mb-3">
          <label for="title" class="form-label">Note title</label>
          <input
            type="text"
            class="form-control"
            id="title"
            name="title"
          />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Note Description</label>
          <div class="form-floating">
            <textarea
              class="form-control"
              placeholder="Leave a note here"
              id="description"
              style="height: 100px"
              name="description"
            ></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
    </div>

    <div class="container">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($conn,$sql);

          // fetch
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
            <th scope='row'>". $row['Sno'] . "</th>
            <td>". $row['title'] . "</td>
            <td>". $row['description'] . "</td>
            <td>@Action</td>
          </tr>";
            // echo $row['Sno'] . ". title " . $row['title'] . " desc is ". $row['description'];
            // echo "<br>";
          } 
        ?>
          
        </tbody>
      </table>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      } );
    </script>
  </body>
</html>

<!-- datatable - plugin to make organized tables

https://datatables.net/


-->
