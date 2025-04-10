<?php
include "../../../private/conn.php";
$input = $_POST['input'];
if (!empty($input)) {
    $query = "SELECT * FROM language WHERE   (language LIKE '%$input%') ";
    $result = mysqli_query($conn, $query);




} else {
    $result = mysqli_query($conn, "SELECT * FROM language");

}
?>


<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center" scope="col">S.L</th>
            <th class="text-center" scope="col">Language</th>
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
                    <?php echo $row["language"]; ?>
                </td>
                <td class='text-center'>
                    <center>
                        <span style="width: 50%; background-color: transparent;" class="editSpan">
                            <form action="edit.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['idLanguage']; ?>">
                                <button type="submit" name="editL" class="btn btn-edit"><i class='fa fa-edit'></i></button>
                            </form>

                        </span>
                    </center>
                </td>
                <td class='text-center'>
                    <center>
                        <span style="width: 50%; background-color: transparent;" class="deletSpan">
                            <form action="code/delet.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $row['idLanguage']; ?>">
                                <button style="width: 100%" type="submit" name="deleteL" class="btn btn-danger"><i
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