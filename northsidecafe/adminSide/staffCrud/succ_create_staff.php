
<?php
// Define database connection constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Cafe');

// Create connection
$link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $user_id = $_POST["user_id"];
    $email = $_POST["email"];
    $Contact_number = $_POST["Contact_number"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $role = $_POST["role"];

    // Start a transaction to ensure consistency across multiple table inserts
    $link->begin_transaction();

    try {
        // Insert Data into users Table
        $insert_users_query = "INSERT INTO users (user_id, email, Contact_number, password) VALUES (?, ?, ?, ?)";
        $stmt_memberships = $link->prepare($insert_users_query);
        $stmt_memberships->bind_param("issss", $user_id, $email, $Contact_number, $password);

        // Execute the query to insert data into membershipss table
        if (!$stmt_users->execute()) {
            throw new Exception("Error creating memberships: " . $stmt_users->error);
        }

        // Insert Data into Staffs Table
        $insert_staff_query = "INSERT INTO users (user_id, username, role) VALUES (?, ?, ?)";
        $stmt_staff = $link->prepare($insert_staff_query);
        $stmt_staff->bind_param("issi", $user_id, $username, $role);

        // Execute the query to insert data into Staffs table
        if (!$stmt_staff->execute()) {
            throw new Exception("Error creating staff: " . $stmt_staff->error);
        }

        // Commit the transaction if everything is successful
        $link->commit();

        $message = "memberships and Staff created successfully.";
        $iconClass = "fa-check-circle";
        $cardClass = "alert-success";
        $bgColor = "#D4F4DD"; // Custom background color for success
    } catch (Exception $e) {
        // Rollback the transaction in case of any errors
        $link->rollback();

        $message = "Error: " . $e->getMessage();
        $iconClass = "fa-times-circle";
        $cardClass = "alert-danger";
        $bgColor = "#FFA7A7"; // Custom background color for error
    } finally {
        // Close the prepared statements
        $stmt_users->close();
        $stmt_staff->close();

        // Close the connection
        $link->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        /* Your custom CSS styles for the success message card here */
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }
        i.checkmark {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        /* Additional CSS styles based on success/error message */
        .alert-success {
            /* Customize the styles for the success message card */
            background-color: <?php echo $bgColor; ?>;
        }
        .alert-success i {
            color: #5DBE6F; /* Customize the checkmark icon color for success */
        }
        .alert-danger {
            /* Customize the styles for the error message card */
            background-color: #FFA7A7; /* Custom background color for error */
        }
        .alert-danger i {
            color: #F25454; /* Customize the checkmark icon color for error */
        }
        .custom-x {
            color: #F25454; /* Customize the "X" symbol color for error */
            font-size: 100px;
            line-height: 200px;
        }
            .alert-box {
            max-width: 300px;
            margin: 0 auto;
        }

        .alert-icon {
            padding-bottom: 20px;
        }
    
    </style>
</head>
<body>
    <div class="card <?php echo $cardClass; ?>" style="display: none;">
        <div style="border-radius: 200px; height: 200px; width: 200px; background: #F8FAF5; margin: 0 auto;">
            <?php if ($iconClass === 'fa-check-circle'): ?>
                <i class="checkmark">✓</i>
            <?php else: ?>
                <i class="custom-x" style="font-size: 100px; line-height: 200px;">✘</i>
            <?php endif; ?>
        </div>
        <h1><?php echo ($cardClass === 'alert-success') ? 'Success' : 'Error'; ?></h1>
        <p><?php echo $message; ?></p>
    </div>

    <div style="text-align: center; margin-top: 20px;">Redirecting back in <span id="countdown">3</span></div>

    <script>
        // Function to show the message card as a pop-up and start the countdown
        function showPopup() {
            var messageCard = document.querySelector(".card");
            messageCard.style.display = "block";

            var i = 3;
            var countdownElement = document.getElementById("countdown");
            var countdownInterval = setInterval(function() {
                i--;
                countdownElement.textContent = i;
                if (i <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "../panel/staff-panel.php";
                }
            }, 1000); // 1000 milliseconds = 1 second
        }

        // Show the message card and start the countdown when the page is loaded
        window.onload = showPopup;

        // Function to hide the message card after a delay
        function hidePopup() {
            var messageCard = document.querySelector(".card");
            messageCard.style.display = "none";
            // Redirect to another page after hiding the pop-up (adjust the delay as needed)
            setTimeout(function () {
                window.location.href = "../frontend/settings.html"; // Replace with your desired URL
            }, 3000); // 3000 milliseconds = 3 seconds
        }

        // Hide the message card after 3 seconds (adjust the delay as needed)
        setTimeout(hidePopup, 3000);
    </script>
</body>
</html>