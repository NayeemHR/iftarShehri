<?php 
session_name('is_app');
session_start();

if(isset($_POST['location'])){
    $_SESSION['location'] = $_POST['location'];
    echo $_SESSION['location'];
    header('location:index.php');
    return;
}
echo $_SESSION['location'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IftarSheri</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php 
    $district_list = [
    "কক্সবাজার",
    "কিশোরগঞ্জ",
    "কুড়িগ্রাম",
    "কুমিল্লা",
    "কুষ্টিয়া",
    "খাগড়াছড়ি",
    "খুলনা",
    "গাইবান্ধা",
    "গাজীপুর",
    "গোপালগঞ্জ",
    "চট্টগ্রাম",
    "চাঁদপুর",
    "চাঁপাইনবাবগঞ্জ",
    "চুয়াডাঙ্গা",
    "জয়পুরহাট",
    "জামালপুর",
    "ঝালকাঠি",
    "ঝিনাইদহ",
    "টাঙ্গাইল",
    "ঠাকুরগাঁও",
    "ঢাকা",
    "দিনাজপুর",
    "নওগাঁ",
    "নড়াইল",
    "নরসিংদী",
    "নাটোর",
    "নারায়ণগঞ্জ",
    "নীলফামারী",
    "নেত্রকোনা",
    "নোয়াখালী",
    "পঞ্চগড়",
    "পটুয়াখালী",
    "পাবনা",
    "পিরোজপুর",
    "ফরিদপুর",
    "ফেনী",
    "বগুড়া",
    "বরগুনা",
    "বরিশাল",
    "বাগেরহাট",
    "বান্দরবন",
    "বি.বাড়িয়া",
    "ভোলা",
    "ময়মনসিংহ",
    "মাগুরা",
    "মাদারীপুর",
    "মানিকগঞ্জ",
    "মুন্সিগঞ্জ",
    "মেহেরপুর",
    "মৌলভীবাজার",
    "যশোর",
    "রংপুর",
    "রাঙ্গামাটি",
    "রাজবাড়ী",
    "রাজশাহী",
    "লক্ষীপুর",
    "লালমনিরহাট",
    "শরীয়তপুর",
    "শেরপুর",
    "সাতক্ষীরা",
    "সিরাজগঞ্জ",
    "সিলেট",
    "সুনামগঞ্জ",
    "হবিগঞ্জ",
    ]
    ?>
    <div class="location">
        <h3>আপনার অবস্থানটি বাছাই করুন</h3>
        <form method="POST">
        <select name="location" id="location">
            <?php 
            foreach($district_list as $district){
                echo "<option value='$district'>$district</option>";
            }
            ?>
        </select>
        <!-- <input type="text" name="location" id="location" placeholder="Enter Your Location"> -->
        <button type="submit">এগিয়ে যান</button>
        </form>

    </div>
</body>
</html>