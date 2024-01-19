<?php
include('navbar.php');
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    

    
    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_user (name, email, password, address, phone) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $password, $address, $phone);

    
    $success = mysqli_stmt_execute($stmt);

    
    if ($success) {
        
        $successMessage = "Registration successful. You can now login.";
    } else {
        
        $errorMessage = "Registration failed. Please try again.";
    }

    mysqli_stmt_close($stmt);
}
?>

<div class="welcome-container">
    <h2 class="welcome-message">Welcome to the Signup Page</h2>
</div>

<div class="signup-container">
    <div class="signup-form">
        <form action="signup.php" method="post">
            <!-- Name input -->
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required />
            </div>

            <!-- Email input -->
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required />
            </div>

            <!-- Password input -->
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>

            <!-- Address input -->
            <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required />
            </div>

            <!-- Phone input -->
            <div class="form-group">
                <label class="form-label" for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" class="form-control" required />
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
        </form>

        <!-- Login link -->
        <div class="text-center">
            <p>Already a member? <a href="login.php" class="login-link">Login</a></p>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
