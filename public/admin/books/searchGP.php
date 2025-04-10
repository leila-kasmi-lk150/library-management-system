<?php
include "../../../private/conn.php";
$input = $_POST['input'];
$idCategorie = $_POST['idCategorie'];
if (!empty($input)) {
    $query = "SELECT * FROM graduation_project WHERE idCategorie='$idCategorie' AND (title LIKE '%$input%' OR year LIKE '%$input%' OR level LIKE '%$input%')  ";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM graduation_project WHERE idCategorie='$idCategorie' ";
    $result = mysqli_query($conn, $query);
}

?>
<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cote</th>
                            <th>Titel</th>
                            <th>Auther</th>
                            <th>Year</th>
                            <th>Lavel</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $count = 1;
                        while ($row2 = mysqli_fetch_assoc($result)) {
                            $idGP = $row2['idGP'];

                            // select authors that have the same coteG 
                            $author = mysqli_query($conn, "SELECT * FROM authors_gp WHERE idGP='$idGP'");



                            ?>

                            <tr>
                                <td class='text-center'>
                                    <?php echo $row2['coteG']; ?>
                                </td>
                                <td class='text-left'>
                                    <?php echo $row2['title']; ?>
                                </td>
                                <td class='text-left'>
                                    <?php
                                    while ($rowA = mysqli_fetch_assoc($author)) {
                                        echo $rowA['name'];
                                        echo "<br>";
                                    }
                                    ?>
                                </td>
                                <td class='text-left'>
                                    <?php echo $row2['year']; ?>
                                </td>
                                <td class='text-center'>
                                    <?php echo $row2['level']; ?>
                                </td>
                                <td class='text-center'>
                                    <span class="viewSpan">
                                        <form action="viewGPCard.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="view_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="view_btn" class="btn btn-view"><i
                                                    class='fa fa-eye'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <span class="editSpan">
                                        <form action="editGP.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="edit_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-edit"><i
                                                    class='fa fa-edit'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <span class="deletSpan">
                                        <form action="code/deletGPcode.php" method="post">
                                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                                            <input type="hidden" name="delete_id" value="<?php echo $row2['idGP']; ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger"><i
                                                    class='fa fa-trash'></i></button>
                                        </form>
                                    </span>
                                </td>
                                <?php
                        }
                    } else {
                        echo "No Record Found";
                    }

                    ?>
                    </tr>


                </table>
            