<?php
    include "readCSV.php";
?>
<section>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">City</th>
                    <th scope="col">Email</th>
                    <th scope="col">Coursel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                     foreach ($sinhvien as $row) {
                        echo "<tr>";
                        foreach ($row as $column) {
                         echo "<td>$column</td>";
                        }
                     echo "</tr>";
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</section>