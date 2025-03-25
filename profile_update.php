<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user_profile WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$userProfile = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $occupation = $_POST['occupation'];
    $linkedin = $_POST['linkedin'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];

    if ($userProfile) {
        // Αν υπάρχει προφίλ
        $query = "UPDATE user_profile SET 
                 full_name = '$fullName',
                 occupation = '$occupation',
                 linkedin = '$linkedin',
                 facebook = '$facebook',
                 youtube = '$youtube',
                 instagram = '$instagram',
                 twitter = '$twitter'
                 WHERE user_id = '$user_id'";
    } else {
        // Αν δεν υπάρχει προφίλ
        $query = "INSERT INTO user_profile 
                (user_id, full_name, occupation, linkedin, facebook, youtube, instagram, twitter)
                VALUES 
                ('$user_id', '$fullName', '$occupation', '$linkedin', '$facebook', '$youtube', '$instagram', '$twitter')";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: profile.php?success=1");
        exit();
    } else {
        echo "Σφάλμα: " . mysqli_error($conn);
    }
}
?>