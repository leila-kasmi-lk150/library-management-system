<?php
include "../../../private/conn.php";
$input = $_POST['input'];
if (!empty($input)) {
    $query = "SELECT * FROM request,books,users,typebook WHERE typebook.idType=books.idType AND books.idBook=request.idBook AND users.idUser=request.idUser AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%' OR codeUser LIKE '%$input%' OR nameBook LIKE '%$input%' OR nbrTypeBook LIKE '%$input%' OR nbrBook LIKE '%$input%') ";
    $result = mysqli_query($conn, $query);

    $queryGP = "SELECT * FROM request_gp,graduation_project,users WHERE  graduation_project.idGP=request_gp.idGP AND users.idUser=request_gp.idUser AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%' OR codeUser LIKE '%$input%' OR title LIKE '%$input%' OR coteG LIKE '%$input%') ";
    $resultGP = mysqli_query($conn, $queryGP);
} else {
    $result = mysqli_query($conn, "SELECT * FROM request,books,users,typebook WHERE typebook.idType=books.idType AND books.idBook=request.idBook AND users.idUser=request.idUser");
    $resultGP = mysqli_query($conn, "SELECT * FROM request_gp,graduation_project,users WHERE  graduation_project.idGP=request_gp.idGP AND users.idUser=request_gp.idUser");
}
?>

    <table class="MainTab">
        <tr>
            <th>Code User</th>
            <th>User Name</th>
            <th>COTE </th>
            <th>Title </th>
            <th>Date Request </th>
            <th>Action</th>
            <th>Get</th>
            <th>DELET</th>
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
                            <?php echo $row2['firstName']; ?> <?php echo $row2['lastName']; ?>
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
                        <?php echo $row2['dateRequest']; ?>
                    </td>
                    <td>
                        <?php echo $row2['Action']; ?>
                    </td>
                    <td>
                        <!-- <span class="viewSpan"> -->
                        <form action="code/getBook.php" method="post">
                            <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                            <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                            <input type="hidden" name="Action" value="<?php echo $row2['Action']; ?>">
                            <input type="hidden" name="idR" value="<?php echo $row2['idR']; ?>">
                            <button type="submit" name="get" class="btn btn-view">Get It</button>
                        </form>
                        <!-- </span> -->
                    </td>
                    <td>
                        <!-- <span class="deletSpan"> -->
                        <form action="code/deletRequestCode.php" method="post">
                            <input type="hidden" name="idBook" value="<?php echo $row2['idBook']; ?>">
                            <input type="hidden" name="idRequest" value="<?php echo $row2['idR']; ?>">
                            <button type="submit" name="delete_btn" class="btn btn-danger">Delet</button>
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
                            <?php echo $row2['firstName']; ?> <?php echo $row2['lastName']; ?>
                        </td>

                    <td>
                        <?php echo $row2['coteG']; ?>
                    </td>
                    <td>
                        <?php echo $row2['title']; ?>
                    </td>
                    <td>
                        <?php echo $row2['dateRequest']; ?>
                    </td>
                    <td>
                        <?php echo $row2['Action']; ?>
                    </td>
                    <td>
                        <!-- <span class="viewSpan"> -->
                        <form action="code/getBook.php" method="post">
                            <input type="hidden" name="idUser" value="<?php echo $row2['idUser']; ?>">
                            <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                            <input type="hidden" name="Action" value="<?php echo $row2['Action']; ?>">
                            <input type="hidden" name="idRGP" value="<?php echo $row2['idRGP']; ?>">
                            <button type="submit" name="getGP" class="btn btn-view">Get It</button>
                        </form>
                        <!-- </span> -->
                    </td>
                    <td>
                        <!-- <span class="deletSpan"> -->
                        <form action="code/deletRequestCode.php" method="post">
                            <input type="hidden" name="idGP" value="<?php echo $row2['idGP']; ?>">
                            <input type="hidden" name="idRequest" value="<?php echo $row2['idRGP']; ?>">
                            <button type="submit" name="delete_btnGP" class="btn btn-danger">Delet</button>
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