<?php
session_start();

// Periksa apakah "id" ada dalam parameter URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Inisialisasi atau periksa apakah 'cart' ada dalam sesi
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Periksa apakah item dengan "id" tertentu sudah ada dalam keranjang
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

// Sisipkan header
include('./header.php');
?>

<br>

<div class="card mt-4">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>

            <?php
            require_once('./lib/db_login.php');
            $sum_qty = 0;
            $sum_price = 0;

            // Periksa apakah 'cart' ada dalam sesi dan merupakan array
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    // Query untuk mendapatkan informasi buku berdasarkan ISBN
                    $query = "SELECT * FROM books WHERE isbn = '" . $id . "'";
                    $result = $db->query($query);

                    if (!$result) {
                        die("Could not query the database:</br>" . $db->error . "<br> Query: " . $query);
                    }

                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . $row->isbn . '</td>';
                        echo '<td>' . $row->author . '</td>';
                        echo '<td>' . $row->title . '</td>';
                        echo '<td>$' . $row->price . '</td>';
                        echo '<td>' . $qty . '</td>';
                        echo '<td>$' . $row->price * $qty . '</td>';
                        echo '</tr>';
                        $sum_qty += $qty;
                        $sum_price += ($row->price * $qty);
                    }
                }

                echo '<tr><td></td><td></td><td></td><td></td><td></td><td>$' . $sum_price . '</td>';
                $result->free();
                $db->close();
            } else {
                echo '<tr><td colspan="6" align="center">There is no item in the shopping cart</td></tr>';
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty ?><br><br>
        <a class="btn btn-primary" href="view_book.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a>
    </div>
</div>

<?php
// Sisipkan footer
include('./footer.php');
?>
