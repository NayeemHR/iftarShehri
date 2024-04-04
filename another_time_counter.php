<!DOCTYPE html>
<html>
<head>
    <title>Countdown Timer</title>
    <script type="text/javascript">
        // Function to update the countdown
        function updateCountdown(targetDate) {
            // Get the current time
            var currentTime = new Date();

            // Calculate the remaining time
            var timeDifference = targetDate - currentTime;
            var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Build the countdown string
            var countdownString = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

            // Update the countdown display
            document.getElementById("countdown").innerHTML = countdownString;

            // If the countdown has reached zero, display a message
            if (timeDifference <= 0) {
                document.getElementById("countdown").innerHTML = "Time's up!";
            }
        }

        // Function to start the countdown
        function startCountdown(targetDate) {
            // Update the countdown immediately
            updateCountdown(targetDate);

            // Update the countdown every second
            setInterval(function() {
                updateCountdown(targetDate);
            }, 1000);
        }
    </script>
</head>
<body>
    <h1>Countdown Timer</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="input-time">Enter the target time (YYYY-MM-DD HH:MM:SS format):</label><br>
        <input type="text" id="input-time" name="input_time" required><br><br>
        <input type="submit" value="Start Countdown">
    </form>

    <div id="countdown"></div>

    <?php
    // PHP code to handle the form submission and start the countdown
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the input time from the form
        $inputTime = $_POST["input_time"];

        // Validate the input time format
        if (preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $inputTime)) {
            // Convert the input time to a JavaScript Date object
            echo "<script>startCountdown(new Date('$inputTime'));</script>";
        } else {
            echo "Invalid input time format. Please enter the time in YYYY-MM-DD HH:MM:SS format.";
        }
    }
    ?>
</body>
</html>