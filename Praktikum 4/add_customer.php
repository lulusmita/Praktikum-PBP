<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require_once('./lib/db_login.php');
$customerid = $name = $address = $city = "";
$error_name = $error_address = $error_city = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerid = test_input($_POST['customerid']);
    $name = test_input($_POST['name']);
    $address = test_input($_POST['address']);
    $city = test_input($_POST['city']);

    if (empty($customerid)) {
        $error_customerid = "Customer ID is required";
        $valid = false;
    }
    if (empty($name)) {
        $error_name = "Name is required";
        $valid = false;
    }
    if (empty($address) || $address == 'none') {
        $error_address = "Address is required";
        $valid = false;
    }
    if (empty($city) || $city == 'none') {
        $error_city = "City is required";
        $valid = false;
    }

    if ($valid) {
        $stmt = $db->prepare("INSERT INTO customers (customerid, name, address, city) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $customerid, $name, $address, $city);

        if ($stmt->execute()) {
            $stmt->close();
            $db->close();
            header('Location: view_customer.php');
            exit();
        } else {
            die("Could not add new data: <br />" . $db->error);
        }
    }
}

$db->close();
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Add Customer Data</div>
    <div class="card-body">
        <form method="POST" autocomplete="on">
            <div class="form-group">
                <label for="customerid">Customer ID:</label>
                <input type="number" class="form-control" id="customerid" name="customerid" value="<?= $customerid; ?>">
                <div class="error"><?php if (isset($error_customerid)) echo $error_customerid ?></div>
            </div>
            <div class="form-group">
                <label for="title">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $address; ?>">
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected' ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected' ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
