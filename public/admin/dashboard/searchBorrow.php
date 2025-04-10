<?php
include "../../../private/conn.php";
$input = $_POST['input'];
if (!empty($input)) {
    $query = "SELECT * FROM borrow,books,users,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0' AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%' OR codeUser LIKE '%$input%' OR nameBook LIKE '%$input%' OR nbrTypeBook LIKE '%$input%' OR nbrBook LIKE '%$input%') ";
    $result = mysqli_query($conn, $query);

    $queryGP = "SELECT * FROM borrow_gp,graduation_project,users WHERE graduation_project.idGP=borrow_gp.idGP AND users.idUser=borrow_gp.idUser AND isReturn='0' AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%' OR codeUser LIKE '%$input%' OR title LIKE '%$input%' OR coteG LIKE '%$input%') ";
    $resultGP = mysqli_query($conn, $queryGP);
} else {
    $result = mysqli_query($conn, "SELECT * FROM borrow,books,users,typeBook WHERE books.idType=typeBook.idType AND books.idBook=borrow.idBook AND users.idUser=borrow.idUser AND isReturn='0'");
    $resultGP = mysqli_query($conn, "SELECT * FROM borrow_gp,graduation_project,users WHERE graduation_project.idGP=borrow_gp.idGP AND users.idUser=borrow_gp.idUser AND isReturn='0'");
}
?>

<table style="width:100%;" class="MainTab">
    <tr>
        <th>Code User</th>
        <th>User</th>
        <th>COTE </th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    <?PHP
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
                    <form action="code/returnBook.php" method="post">
                        <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                        <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                        <input type="hidden" name="Action" value="<?php echo $row2['Action']; ?>">
                        <input type="hidden" name="idB" value="<?php echo $row2['idB']; ?>">
                        <input type="submit" name="get" class="btn btn-view" value="Return">
                    </form>
                    <!-- </span> -->
                </td>
            </tr>
            <?php
        }
        while ($row3 = mysqli_fetch_assoc($resultGP)) {
            ?>
            <tr>
                <td>
                    <?php echo $row3['codeUser']; ?>
                </td>
                <td>
                    <?php echo $row3['firstName'];
                    echo " ";
                    echo $row3['lastName']; ?>
                </td>
                <td>
                    <?php echo $row3['coteG']; ?>
                </td>
                <td>
                    <?php echo $row3['title']; ?>
                </td>
                <td>
                    <!-- <span class="viewSpan"> -->
                    <form action="code/returnBook.php" method="post">
                        <input type="hidden" name="idUser" value="<?php echo $row3['idUser']; ?>">
                        <input type="hidden" name="idGP" value="<?php echo $row3['idGP']; ?>">
                        <input type="hidden" name="Action" value="<?php echo $row3['Action']; ?>">
                        <input type="hidden" name="idBGP" value="<?php echo $row3['idBGP']; ?>">
                        <input type="submit" name="reurnGP" class="btn btn-view" value="Return">
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