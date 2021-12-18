
<?php
    include("config/db_connect.php");

    //write query for all forms
    $sql = 'SELECT firstname, lastname, email, id FROM dataforms ORDER BY created_at';
    
    $result = mysqli_query($conn, $sql);

    $dataforms = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    // mysqli_close($conn);


    


    if (isset ($_POST['delete'])){

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM dataforms WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header ('location: alldata.php');
        } {
            echo 'query error:'.mysqli_error($conn);
        }
    }

 
?>



<!DOCTYPE html>
<html lang="en">

    <?php  include('templates/header.php'); ?>

    <h4 class="text-center m-3"> Data Summary </h4>
    <div class="container">




        
        <div class="row">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Options</th>

                    </tr>
                </thead>
                <?php foreach ($dataforms as $data): ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php //echo htmlspecialchars($data['id']); ?></th>
                            <td><?php echo htmlspecialchars($data['firstname']); ?> </td>
                            <td><?php echo htmlspecialchars($data['lastname']); ?> </td>
                            <td><?php echo htmlspecialchars($data['email']); ?> </td>
                            <td class="d-inline-flex">
                                <a href="datapage.php?id=<?php echo $data['id'] ?>"> <div class="btn btn-info mr-2">view</div> </a>
                                <a href="edit.php?id=<?php echo $data['id'] ?>"> <div class="btn btn-secondary mr-2">edit</div> </a>
                                


                                <form action="alldata.php" method="POST">
                                    <input type="hidden" name="id_to_delete" value="<?php echo $data['id'] ?>">
                                    <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                                </form>
                                
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>



            <?php $total = count($dataforms);
                    echo 'there are ' .$total.' inputs in total';
            ?>


                
          


        </div>
    </div>



    <?php include('templates/footer.php'); ?>


    
</html>
