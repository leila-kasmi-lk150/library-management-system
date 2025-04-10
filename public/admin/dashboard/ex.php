<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType']=='admin') {

include('../includes/header.php');
include('../../../private/conn.php');
?>

<style>
    <?php include('../assets/css/dashboard.css'); ?>
</style>


<div class="left-section">
<?php
$query = mysqli_query($conn, "SELECT * FROM borrow,books,users WHERE books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0' AND dateReturn < now()");

?>
<div class="viewBook">
        <div class="typeName">Late Books Returned</div>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div id="result"></div>
<table class="table table-bordered table-striped table-hover" id="myTable">
                <thead>
                        <tr>
                            <th class="text-center" scope="col">Code User</th>
                            <th class="text-center" scope="col">COTE BOOk</th>
                            <th class="text-center" scope="col">Notification</th>
                        </tr>
                </thead>

                <?php
                    if(mysqli_num_rows($query) > 0)        
                    {
                        $count=1;
                        while($row2 = mysqli_fetch_assoc($query))
                        {
                            
                    ?>
                     <tr>
                            <td class='text-center'><?php echo $row2['codeUser']; ?></td>
                            <td class='text-left'><?php echo $row2['idBook']; ?></td>
                            <td class='text-center'>
                                <span class="viewSpan">
                                    <form action="code/sendNotification.php" method="post">
                                        <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                                        <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                                        <input type="hidden" name="idB" value="<?php echo $row2['idB']; ?>">
                                        <button type="submit" name="get" class="btn btn-view">Send</button>
                                    </form>
                                </span>
                            </td>
                            <?php
                            }
                        }
                        else {
                                echo "No Record Found";
                            }
                    
                    ?>
                            </tr>

                    
            </table>
        </div>
  </div>
</div>


<?php
include('../includes/scripts.php');

}else{
    header("Location: ../../home/index.php");
    exit();
}
?> 