<?php
// Start the session
session_start();
include('./header.php');

$db = new mysqli('localhost', 'root', '', 'bookorama');
if ($db->connect_error) {
    die("Koneksi ke database gagal: " . $db->connect_error);
}
?>

<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT isbn, author, title, price FROM books ORDER BY isbn";
            $result = $db->query($query);

            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
            }

            // Fetch and display the results
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->isbn . '</td>';
                echo '<td>' . $row->author . '</td>';
                echo '<td>' . $row->title . '</td>';
                echo '<td>' . $row->price . '</td>';
                // Add the book to the cart using a link with a query parameter
                echo '<td><a class="btn btn-primary" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a></td>';
                echo '</tr>';
            }

            echo '</table>';
            echo '<br />';
            echo 'Total Rows = ' . $result->num_rows;
            $result->free();
            $db->close();
            ?>
        </table>
    </div>
</div>

<?php
// Include footer.php
include('./footer.php');
?>
