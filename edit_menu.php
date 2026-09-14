<?php 
include 'db_connection.php';
include 'admin_session_check.php';

// Determine which menu is being edited
$menuType = isset($_GET['menu']) ? $_GET['menu'] : 'snacks';

// Set the table name dynamically based on menu type
$tableName = '';
if ($menuType === 'breakfast') {
    $tableName = 'breakfast';
} elseif ($menuType === 'snacks') {
    $tableName = 'snacks';
} elseif ($menuType === 'lunch') {
    $tableName = 'lunch';
}elseif ($menuType === 'drinks') {
    $tableName = 'drinks';
}
else {
    die("Invalid menu type selected!");
}

// Fetch all items from the selected menu
$menuItems = mysqli_query($connection, "SELECT * FROM $tableName");

// Handle form submission for adding, updating, or deleting items
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_item'])) {
        // Add a new item
        $itemId = mysqli_real_escape_string($connection, $_POST['item_id']);
        $itemName = mysqli_real_escape_string($connection, $_POST['item_name']);
        $itemPrice = (int)$_POST['item_price']; // Ensure price is an integer
        $query = "INSERT INTO $tableName (item_id, item_name, item_price) VALUES ('$itemId', '$itemName', $itemPrice)";
        if (!mysqli_query($connection, $query)) {
            echo "Error adding item: " . mysqli_error($connection);
        }
        header("Location: edit_menu.php?menu=$menuType");
        exit();
    } elseif (isset($_POST['update_item'])) {
        // Update an existing item
        $itemId = mysqli_real_escape_string($connection, $_POST['item_id']); // Handle as string
        $itemName = mysqli_real_escape_string($connection, $_POST['item_name']);
        $itemPrice = (int)$_POST['item_price']; // Ensure price is an integer

        $query = "UPDATE $tableName SET item_name = '$itemName', item_price = $itemPrice WHERE item_id = '$itemId'";
        if (!mysqli_query($connection, $query)) {
            echo "Error updating item: " . mysqli_error($connection);
        }
        header("Location: edit_menu.php?menu=$menuType");
        exit();
    } elseif (isset($_POST['delete_item'])) {
        // Delete an item
        $itemId = mysqli_real_escape_string($connection, $_POST['item_id']); // Handle as string

        $query = "DELETE FROM $tableName WHERE item_id = '$itemId'";
        if (!mysqli_query($connection, $query)) {
            echo "Error deleting item: " . mysqli_error($connection);
        }
        header("Location: edit_menu.php?menu=$menuType");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo ucfirst($menuType); ?> Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert -->
<style>
    /* General body styles */
    body {
    background-color: #f9f9f9; /* Light grey for a subtle background */
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url('images/edit.jpeg');
    color: #333; /* Dark grey for text */
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

/* Container */
.container {
    background-image: linear-gradient(rgba(129, 128, 128, 0.5), rgba(255, 255, 255, 0.5));
    border-radius:60px;
    box-shadow: 0 4px 6px rgba(216, 170, 170, 0.1);
    padding: 20px;
}

/* Heading styles */
h1 {
    font-family: "Sofia", sans-serif;
    font-size: 40px;
    font-weight: bold;
    color: #fff; /* Pure black for headings */
    padding-bottom: 5px;
    margin-left: 400px;
}

/* Buttons */
.btn {
    border: none;
    padding: 10px 15px;
    font-size: 14px;
    border-radius: 4px;
    text-transform: uppercase;
    font-weight: bold;
}

.btn-success {
    background-color: #000;
    color: #fff;
    transition: background-color 0.3s;
}

.btn-success:hover {
    background-color: #444;
}

.btn-dark {
    background-color:rgb(202, 199, 199);
    color: #000;
    transition: background-color 0.3s;
}

.btn-dark:hover {
    background-color: #555;
    color:#ddd;
    transform:scale(1.2);
    margin-right: 10px;
    margin-left: 10px;
}

.btn-danger {
    background-color: #000;
    color: #fff;
    transition: background-color 0.3s;
}

.btn-danger:hover {
    background-color: #900;
    transform:scale(1.2);
    margin-right: 10px;
    margin-left: 10px;
}

/* Input Fields */
input[type="text"], input[type="number"] {
    border: 4px solid #000;
    padding: 8px;
    width: 100%;
    border-radius: 10px;
    background-color: #fff;
    color: #000;
    transition: border-color 0.3s;
}

input[type="text"]:focus, input[type="number"]:focus {
    border-color: #000;
    outline: none;
}

/* Table */
.table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
    color: #000;
}

.table th {
    background-color: #333;
    color: #fff;
    text-transform: uppercase;
}

.table tr:nth-child(even) {
    background-color: #f4f4f4;
}

.table tr:hover {
    background-color: #ddd;
}

/* Back Button */
.btn-secondary {
    background-color: #333;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 12px;
    display: inline-block;
    margin-bottom: 15px;
    border-radius: 4px;
    font-size: 18px;
    margin-left: 500px;
}

.btn-secondary:hover {
    background-color: #fff;
    color: #000;
}

h4{
    color:rgb(255, 255, 255);
    font-weight: bolder;
    border: 4px solid #fff;
    background-color: #000;
    width: 20%;
   text-align: center;
   border-radius: 25px;
}
</style>
</head>
<body>
<div class="container mt-5">
    <h1>Edit <?php echo ucfirst($menuType); ?> Menu</h1>

    <!-- Add New Item Form -->
    <form action="edit_menu.php?menu=<?php echo $menuType; ?>" method="POST" class="mb-4">
        <h4>ADD A NEW MEAL ITEM</h4>
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="item_id" class="form-control" class="aitem" placeholder="New Item Id" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="item_name" class="form-control" class="aitem" placeholder="New Item Name" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="item_price" class="form-control" class="aitem" placeholder="Price (TK)" required>
            </div>
            <div class="col-md-2">
                <button type="submit" name="add_item" class="btn btn-success">Add Item</button>
            </div>
        </div>
    </form>

    <!-- Display Menu Items -->
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Price (TK)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($menuItems)) { ?>
            <tr>
                <!-- Begin the form for this row -->
                <form id="deleteForm_<?php echo $row['item_id']; ?>" action="edit_menu.php?menu=<?php echo $menuType; ?>" method="POST">
                    <td>
                        <input type="text" name="item_id" class="form-control" value="<?php echo htmlspecialchars($row['item_id']); ?>" readonly>
                    </td>
                    <td>
                        <input type="text" name="item_name" class="form-control" value="<?php echo htmlspecialchars($row['item_name']); ?>">
                    </td>
                    <td>
                        <input type="number" name="item_price" class="form-control" value="<?php echo htmlspecialchars($row['item_price']); ?>">
                    </td>
                    <td>
                        <!-- Include necessary hidden inputs -->
                        <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                        <input type="hidden" name="delete_item" value="1"> <!-- Hidden field for delete -->

                        <!-- Buttons for Update and Delete -->
                        <button type="submit" name="update_item" class="btn btn-dark">Update</button>
                        <button type="button" name="delete_item" class="btn btn-danger" onclick="confirmDelete('<?php echo $row['item_id']; ?>')">Delete</button>
                    </td>
                </form>
                <!-- End the form for this row -->
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="meal_menu_editing.php" class="btn btn-secondary mb-3">Back to Menu</a>

</div>

<script>
    // SweetAlert confirmation for delete
    function confirmDelete(item_id) {
    Swal.fire({
        title: "Are you sure,",
        text: "To delete this meal item?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, I am Sure!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the corresponding form if confirmed
            document.getElementById('deleteForm_' + item_id).submit(); // Corrected form ID
        }
    });
}

</script>
</body>
</html>
