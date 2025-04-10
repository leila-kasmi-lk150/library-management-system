<?php
include "../../../private/conn.php";
$input = $_POST['input'];
if (!empty($input)) {
    $query = "SELECT * FROM borrow,books,users,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0' AND dateReturn < now() AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%' OR codeUser LIKE '%$input%' OR nameBook LIKE '%$input%' OR nbrTypeBook LIKE '%$input%' OR nbrBook LIKE '%$input%') ";
    $result = mysqli_query($conn, $query);

    $queryGP = "SELECT * FROM borrow_gp,graduation_project,users WHERE graduation_project.idGP=borrow_gp.idGP AND users.idUser=borrow_gp.idUser AND isReturn='0' AND dateReturn < now() AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%' OR codeUser LIKE '%$input%' OR title LIKE '%$input%' OR coteG LIKE '%$input%') ";
    $resultGP = mysqli_query($conn, $queryGP);
} else {
    $result = mysqli_query($conn, "SELECT * FROM borrow,books,users,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0' AND dateReturn < now()");
    $resultGP = mysqli_query($conn, "SELECT * FROM borrow_gp,graduation_project,users WHERE graduation_project.idGP=borrow_gp.idGP AND users.idUser=borrow_gp.idUser AND isReturn='0' AND dateReturn < now()");
}
?>

<table class="MainTab">
    <tr>
        <th>Code User</th>
        <th>User</th>
        <th>COTE </th>
        <th>Title</th>
        <th>Notification</th>
    </tr>
    <?php
    if ((mysqli_num_rows($result) + mysqli_num_rows($resultGP)) > 0) {
        while ($row2 = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <?php echo $row2['codeUser']; ?>
                </td>
                <td>
                    <?php echo $row2['firstName'];
                    echo " ";
                    echo $row2['lastName']; ?>
                </td>
                <td>
                    <?php echo $row2['nbrTypeBook'];
                    echo "-";
                    echo $row2['nbrBook']; ?>
                </td>
                <td>
                    <?php echo $row2['nameBook']; ?>
                </td>
                <td>
                    <!-- <span class="viewSpan"> -->
                    <form action="code/sendNotification.php" method="post">
                        <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                        <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                        <input type="hidden" name="idB" value="<?php echo $row2['idB']; ?>">
                        <button type="submit" name="get" class="btn btn-view">Send</button>
                    </form>
                    <!-- </span> -->
                </td>
            </tr>
            <?php
        }
        while ($row2 = mysqli_fetch_assoc($resultGP)) {
            ?>
            <tr>
                <td>
                    <?php echo $row2['codeUser']; ?>
                </td>
                <td>
                    <?php echo $row2['firstName'];
                    echo " ";
                    echo $row2['lastName']; ?>
                </td>
                <td>
                    <?php echo $row2['coteG']; ?>
                </td>
                <td>
                    <?php echo $row2['title']; ?>
                </td>
                <td>
                    <!-- <span class="viewSpan"> -->
                    <form action="code/sendNotification.php" method="post">
                        <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                        <input type="hidden" name="idGP" value="<?php echo $row2['idGP']; ?>">
                        <button type="submit" name="getGP" class="btn btn-view">Send</button>
                    </form>
                    <!-- </span> -->
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td>
                No Record Found
            </td>
        </tr>
        <?php
    } ?>

</table>