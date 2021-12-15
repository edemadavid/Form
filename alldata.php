
<?php
    include("config/db_connect.php");

    //write query for all forms
    $sql = 'SELECT firstname, lastname, email, id FROM dataforms ORDER BY created_at';
    
    $result = mysqli_query($conn, $sql);

    $dataforms = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);

    

 
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
                            <th scope="row"><?php echo htmlspecialchars($data['id']); ?></th>
                            <td><?php echo htmlspecialchars($data['firstname']); ?> </td>
                            <td><?php echo htmlspecialchars($data['lastname']); ?> </td>
                            <td><?php echo htmlspecialchars($data['email']); ?> </td>
                            <td>
                                <a href="datapage.php?id=<?php echo $data['id'] ?>"> <div class="btn btn-secondary">view</div> </a>
                                <a href="#"><div class="btn btn-danger">Delete</div> </a>

                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>



            <?php $total = count($data);
                    echo 'there are ' .$total.' inputs in total';
            ?>


                
          


        </div>
    </div>



    <?php include('templates/footer.php'); ?>


    
</html>
