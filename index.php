<?php 
session_name('is_app');
session_start();
$_SESSION['location'] = $_SESSION['location'] ?? false;
if($_SESSION['location'] == false){
    header('location:location.php');
    return;
}
function convertTo12HourFormat($time) {
    return date("h:i", strtotime($time));
}
function get_time_from_csv($d){
    // File path to the CSV file
    $csvFilePath = 'iftar_and_sheri_times.csv';

    $selectedDate = $d;

    // Check if the file exists
    if (file_exists($csvFilePath)) {
        // Open the file
        $csvFile = fopen($csvFilePath, 'r');

        // Initialize an empty array to store the data
        $data = [];

        // Read each line of the CSV file
        while (($line = fgetcsv($csvFile)) !== false) {
            // Check if the date matches the selected date
            if ($line[0] == $selectedDate) {
                // Add the line as an array to the data array
                $data[] = $line;
            }
        }
        // Close the file
        fclose($csvFile);

        return $data[0];
    } else {
        // File doesn't exist
        return 'The CSV file does not exist.';
    }
}

function get_location_from_csv($l){
    // File path to the CSV file
    $csvFilePath = 'location_csv.csv';

    $location = $l;

    // Check if the file exists
    if (file_exists($csvFilePath)) {
        // Open the file
        $csvFile = fopen($csvFilePath, 'r');

        // Initialize an empty array to store the data
        $location_data = [];

        // Read each line of the CSV file
        while (($line = fgetcsv($csvFile)) !== false) {
            // Check if the date matches the selected date
            if ($line[0] == $location) {
                // Add the line as an array to the data array
                $location_data[] = $line;
            }
        }
        // Close the file
        fclose($csvFile);

        return $location_data[0];
    } else {
        // File doesn't exist
        return 'The CSV file does not exist.';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IftarSheri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <img class="header-design2 opacity-25"src="assets/img/Asset 1.png" alt="">
    
    <header>
        
            <nav class="navbar fixed-top">
                <div class="container">
                    <ul class="info">
                        <?php 
                        //set a time zone in asia 
                        date_default_timezone_set('Asia/Dhaka');
                        // echo date_default_timezone_get();
                        $today_date = explode(' ', date('d F Y'));
                        $date = $today_date[0];
                        $month = $today_date[1];
                        $year = $today_date[2];

                        $bdate = ['01'=>'১','02'=>'২','03'=>'৩','04'=>'৪','05'=>'৫','06'=>'৬','07'=>'৭','08'=>'৮','09'=>'৯','10'=>'১০','11'=>'১১','12'=>'১২','13'=>'১৩','14'=>'১৪','15'=>'১৫','16'=>'১৬','17'=>'১৭','18'=>'১৮','19'=>'১৯','20'=>'২০','21'=>'২১','22'=>'২২','23'=>'২৩','24'=>'২৪','25'=>'২৫','26'=>'২৬','27'=>'২৭','28'=>'২৮','29'=>'২৯','30'=>'৩০','31'=>'৩১',];
                        $bmonth = ['January'=>'জানুয়ারী','February'=>'ফেব্রুয়ারী','March'=>'মার্চ','April'=>'এপ্রিল','May'=>'মে','June'=>'জুন','July'=>'জুলাই','August'=>'আগস্ট','September'=>'সেপ্টেম্বর','October'=>'অক্টোবর','November'=>'নভেম্বর','December'=>'ডিসেম্বর'];
                        $bfulldate = $bdate[$date].' '.$bmonth[$month].' ২০২৪';


                        
                        $rday = date('d');
                        $mday = $rday+20;
                        ?>
                        <li>আজ: <?php echo $bfulldate; ?> (<?php echo $bdate[$mday]; ?> রমজান ১৪৪৫ হিজরি)</li>
                        <li>অবস্থান: <?php echo $_SESSION['location'] ?></li>
                        <li></li>
                    </ul>
                    <!-- <a class="navbar-brand" href="#">আজ: <?php echo $bfulldate; ?> (<?php echo $bdate[$mday]; ?> রমজান ১৪৪৫ হিজরি)</a> -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">মেনু</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="location.php">অবস্থান পরিবর্তন</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="calender.php">সম্পূর্ণ ক্যালেন্ডার</a>
                        </li>
                       
                    </div>
                    </div>
                </div>
                </nav>

    </header>
    <img class="header-design opacity-25" src="assets/img/Asset 2.png" alt="">
    
    <div class="main">
        <div class="upcomming">
            <h2>আজকের</h2>
            <?php
            $location_data = get_location_from_csv($_SESSION['location']);
            // var_dump($location_data[1]);
            // var_dump($location_data[2]);
            $data = get_time_from_csv(date('Y-m-d'));
            //convert time to 12 hour format
            $iftar_time = convertTo12HourFormat($data[1]);
            $sheheri_time = convertTo12HourFormat($data[2]);
            // explode time to array
            $e_iftar_time = explode(':', $iftar_time);
            $e_sheheri_time = explode(':', $sheheri_time);
            // add location data to time
            // var_dump($e_iftar_time);
            $iftar_min = (int)$e_iftar_time[1] + $location_data[1];
            $sheheri_min = (int)$e_sheheri_time[1] + $location_data[2];
            $iftar = $e_iftar_time[0].':'.$iftar_min;
            $sheheri = $e_sheheri_time[0].':'.$sheheri_min;
            // var_dump($e_iftar_time);
            // var_dump($data[0][1]);
            echo "<h4>ইফতার   :  $iftar</h4>";
            echo "<h4>সেহেরি   :  $sheheri </h4>";
            ?>
        </div>
        <hr>
        <div class="remaining">
            ইফতারের জন্য সময় বাকী আছে 
            <h1 class="special">10:15:30</h1>
        </div>
    </div>

    <footer>
    <img src="assets/img/Asset 1.png" alt="">
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>