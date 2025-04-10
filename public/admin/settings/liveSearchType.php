<?php
include "../../../private/conn.php";
$input = $_POST['input'];
if (!empty($input)) {
    $query = "SELECT * FROM typeBook,categorie WHERE categorie.idCategorie=typeBook.idCategorie AND (categorie LIKE '%$input%' OR  typeBook LIKE '%$input%' OR nbrTypeBook LIKE '%$input%') ";
    $result = mysqli_query($conn, $query);




} else {
    $result = mysqli_query($conn, "SELECT * FROM typeBook,categorie WHERE categorie.idCategorie=typeBook.idCategorie");

}
?>


<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center" scope="col">Count</th>
            <th class="text-center" scope="col">Type</th>
            <th>Categorie</th>
            <th>nbr Type Book</th>
            <th class="text-center" scope="col">Edit</th>
            <th class="text-center" scope="col">Delete</th>
        </tr>
    </thead>

    <?php

    $count = 1;
    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {



            ?>

            <tr id="tr">
                <td class='text-center'>
                    <?php echo $count; ?>
                </td>
                <td class='text-left'>
                    <?php echo $row["typeBook"]; ?>
                </td>
                <td class='text-left'>
                    <?php echo $row["categorie"]; ?>
                </td>
                <td class='text-left'>
                    <?php echo $row["nbrTypeBook"]; ?>
                </td>
                <td class='text-center'>
                    <center>
                        <span style="width: 50%; background-color: transparent;" class="editSpan">
                            <form action="edit.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['idType']; ?>">
                                <button type="submit" name="editT" class="btn btn-edit"><i class='fa fa-edit'></i></button>
                            </form>

                        </span>
                    </center>
                </td>
                <td class='text-center'>
                    <center>
                        <span style="width: 50%; background-color: transparent;" class="deletSpan">
                            <form action="code/delet.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $row['idType']; ?>">
                                <button style="width: 100%" type="submit" name="deleteT" class="btn btn-danger"><i
                                        class='fa fa-trash'></i></button>
                            </form>
                        </span>
                    </center>
                </td>
            </tr>


            <?php
            $count = $count + 1;
        }
    } else {
        echo "No Record Found";
    }
    ?>
</table>