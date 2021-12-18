<?php 

	include('config/db_connect.php');

	// check GET request id param
	if(isset($_GET['id'])){

		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM dataforms WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$data = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);


	}

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <div class="container">
        <h4 class="text-center my-3">Details</h4>

        <?php if ($data): ?>

			<div class="row">
				<div class="col col-3 mb-3">
					<div>
						<img src="<?php echo $data['profilepics'] ?>" alt="Profile Picture" style="width:150px;height:auto;">
					</div>
					<h5> Dob: <?php echo htmlspecialchars($data['DoB']) ?> </h5>
				</div>
				<div class="col col-9">
					<h4> Name: <?php echo htmlspecialchars($data['firstname']) ?> <?php echo htmlspecialchars($data['lastname']) ?></h4>
					<h5> Email: <?php echo htmlspecialchars($data['email']) ?> </h5>
					<h5> Phone No: <?php echo htmlspecialchars($data['phoneno']) ?> </h5>
					<h5> Dob: <?php echo htmlspecialchars($data['DoB']) ?> </h5>
					<h5> Address: <?php echo htmlspecialchars($data['addres']) ?> </h5>
				</div>

			</div>

			
			
        <?php else: ?>

        <?php endif; ?>

      
    

    </div>

    <?php include('templates/footer.php'); ?>



</html>

