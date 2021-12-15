<?php 

	include('config/db_connect.php');

	// check GET request id param
	if(isset($_GET['id'])){

		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM pizzas WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$pizza = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

        print_r($pizza);

	}

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <div class="container">
        <h4 class="text-center">Details</h4>

      
    

    </div>

    <?php include('templates/footer.php'); ?>



</html>

