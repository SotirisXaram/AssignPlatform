<?php
// Σύνδεση με τη βάση 
include('config.php');


$course_id = $_POST['course_id'];
$assignment_title = $_POST['assignment_title'];
$assignment_text = $_POST['assignment_text'];


// Διαχείριση εικόνας
$allowed = array('jpg', 'jpeg', 'png', 'gif');
$filename = $_FILES['assignment_image']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

// Έλεγχος εάν το αρχειο είναι 'jpg', 'jpeg', 'png', 'gif'.
if (!in_array(strtolower($ext), $allowed)) {
    header("Location: create_ergasia.php?error=Μη αποδεκτός τύπος αρχειο");
    exit();
}

// Έλεγχος εάν το αρχειο >5ΜΒ
if ($_FILES['assignment_image']['size'] > 5000000) { 
    header("Location: create_ergasia.php?error=Αρχείο μεγάλο");
    exit();
}

// Ανέβασμα  του αρχείου
$upload_path = 'uploads/' . $filename;
if (move_uploaded_file($_FILES['assignment_image']['tmp_name'], $upload_path)) {
    $assignment_image = $filename;
} else {
    header("Location: create_ergasia.php?error=error uploading image");
    exit();
}


$query = "INSERT INTO Assignment_Description (course_id, assignment_title, assignment_text, assignment_image) 
              VALUES ('$course_id', '$assignment_title', '$assignment_text', '$assignment_image')";

if (mysqli_query($con, $query)) {
    header("Location: create_ergasia.php?success=Η εργασία δημιουργήθηκε επιτυχώς!");
} else {
    header("Location: create_ergasia.php?error=Σφάλμα κατά την αποθήκευση: " . mysqli_error($con));
}

?>