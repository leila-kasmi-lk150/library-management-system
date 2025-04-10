<?php 
    include "../../../private/conn.php";
    $input = $_POST['input'];
    if(!empty($input))
    {
        $query = "SELECT * FROM users WHERE userType!='admin' AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%') ";
        $result = mysqli_query($conn, $query);
    }else{
        $query = "SELECT * FROM users WHERE userType!='admin'";
        $result = mysqli_query($conn, $query);
    }
    ?>
    <table class="table table-bordered table-striped table-hover" >
        <form action="" method="post">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">count</th>
                            <th class="text-center" scope="col">Name</th>
                            <th class="text-center" scope="col">EMAIL</th>
                            <th class="text-center" scope="col">SPECIALTY</th>
                            <th class="text-center" scope="col">ADRESS</th>
                            <th>Action</th>
                        </tr>
                    </thead>

    <?php
    if (mysqli_num_rows($result) > 0 ) {
        $count = 1;
?>
         
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        
                        <tr>
                            <td class='text-center'><?php  echo $count; ?></td>
                            <td class='text-left'><?php echo $row["firstName"]; echo " "; echo $row["lastName"]; ?></td>
                            <td class='text-left'><?php echo $row['email']; ?></td>
                            <td class='text-left'><?php echo $row["specialty"]; echo " "; echo $row["level"]; ?></td>
                            <td class='text-center'><?php echo $row['adress']; ?></td>
                            <?php
                                    if ($row['block'] == '1') {
                                        ?>
                                    <td class='text-center'>
                                        <span class="viewSpan">
                                            <form action="code/blockCode.php" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                                <button type="submit" name="deblock" class="btn btn-view"><i class="fas fa-user"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                    <?php
                                    } else {
                                        ?>
                                    <td class='text-center'>
                                        <span class="deletSpan">
                                            <form action="code/blockCode.php" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                                <button type="submit" name="block" class="btn btn-danger"><i
                                                        class="fas fa-user-slash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                    <?php
                                    }
                                    ?>
                        </tr>
                        <?php
                            $count++; 
                        }
                        ?>
                        </form>
        </table>
                        <?php
                              

} else{
        echo "<tr>No Record Found</tr>";
    }