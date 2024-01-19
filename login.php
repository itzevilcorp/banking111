<?php
include('navbar.php');
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = mysqli_prepare($conn, "SELECT * FROM tbl_user WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    mysqli_stmt_execute($stmt);

    
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        
        session_start();
        $_SESSION['user_id'] = $row['id']; 

        
        header("Location: dashboard.php");
        exit(); 
    } else {
        
        $errorMessage = "Invalid email or password. Please try again.";
    }

    mysqli_stmt_close($stmt);
}
?>

<div class="welcome-container">
    <h2 class="welcome-message">Welcome to the Login Page</h2>
</div>

<div class="login-container">
    <div class="login-form">
        <form action="login.php" method="post">
            <!-- Email input -->
            <div class="form-group">
                <label class="form-label" for="form2Example1"></label>
                <input type="email" name="email" id="form2Example1" class="form-control" required />
            </div>

            <!-- Password input -->
            <div class="form-group">
                <label class="form-label" for="form2Example2"></label>
                <input type="password" name="password" id="form2Example2" class="form-control" required />
            </div>

            <!-- Remember me and Forgot password -->
            <div class="row mb-4">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                </div>

                <div class="col">
                    <a href="#!" class="forgot-password">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>

        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="#!" class="register-link">Register</a></p>
            <p>or sign up with:</p>
            <!-- Social buttons -->
            <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-google"></i>
            </button>

            <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-github"></i>
            </button>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
