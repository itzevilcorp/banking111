<?php
include('navbar.php');
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $deposit = $_POST['deposit'];
    $userId = $_POST['user_id'];

    // Fetch the current balance from the database
    $getBalanceQuery = mysqli_prepare($conn, "SELECT balance FROM tbl_account WHERE user_id = ?");
    mysqli_stmt_bind_param($getBalanceQuery, "d", $userId);
    mysqli_stmt_execute($getBalanceQuery);
    mysqli_stmt_bind_result($getBalanceQuery, $currentBalance);
    mysqli_stmt_fetch($getBalanceQuery);
    mysqli_stmt_close($getBalanceQuery);

    // Calculate the new balance
    $newBalance = $currentBalance + $deposit;

    // Insert a new row into tbl_account
    $insertQuery = mysqli_prepare($conn, "INSERT INTO tbl_account (user_id, deposit, balance, withdraw) VALUES (?, ?, ?, 0)");

    
    if ($insertQuery === false) {
        die("Error preparing statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($insertQuery, "ddd", $userId, $deposit, $newBalance);

    if (mysqli_stmt_execute($insertQuery)) {
        $successMessage = "Deposit successfully recorded!";
    } else {
        $errorMessage = "Error recording deposit: " . mysqli_error($conn);
    }

    mysqli_stmt_close($insertQuery);
}

?>

<div class="container mt-5">
    <h2>Deposit</h2>
    <?php
    // Display success or error message if set
    if (isset($successMessage)) {
        echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
    } elseif (isset($errorMessage)) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
    ?>
    <form action="deposit.php" method="post">
        <!-- Deposit input -->
        <div class="form-group">
            <label class="form-label" for="deposit">Deposit Amount:</label>
            <input type="number" name="deposit" id="deposit" class="form-control" required />
        </div>

        <!-- User ID input -->
        <div class="form-group">
            <label class="form-label" for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" class="form-control" required />
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Deposit</button>
    </form>
    <!-- Back button -->
    <a href="dashboard.php" class="btn btn-secondary mt-3">Hell</a>
</div>
</div>

<?php include('footer.php'); ?>
