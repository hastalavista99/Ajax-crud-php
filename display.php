<?php 
include 'connect.php';

if(isset($_POST['displaySend'])){
    $table='<table id="dataTable" class="table">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Mobile</th>
        <th scope="col">Place</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>';

    $sql = "SELECT * FROM crud";
    $result = mysqli_query($con, $sql);
    $number=1;

    while ($row=mysqli_fetch_assoc($result)) {

        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $place = $row['place'];
        $table .= '<tr>
        <td scope="row">'.$number.'</td>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$mobile.'</td>
        <td>'.$place.'</td>
        <td><button class="btn btn-dark" onclick="getDetails('.$id.')">Update</button>
<button class="btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
</td>
      </tr>';
      $number++;
    }
    $table .= "</table>";
    echo $table;
}

?>

<!-- Include jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables on your table -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
