<?php
require_once 'config.php';
session_start();

$student_id = $_GET['student_id'] ?? null;
if (!$student_id) {
    die("Student ID is required.");
}
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");

$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();




$stmt = $conn->prepare("SELECT * FROM user_profile WHERE user_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

$stmt = $conn->prepare("SELECT sa.*, ad.assignment_title, c.course_id,
c.course_title
FROM submitted_assignment sa
JOIN assignment_description ad ON sa.assignment_id =
ad.assignment_id
JOIN courses c ON ad.course_id = c.course_id
WHERE sa.user_id = ?
ORDER BY sa.submission_timestamp DESC");

$stmt->bind_param("i", $student_id);
$stmt->execute();
$assignments_result = $stmt->get_result();

$dom = new DOMDocument();

$dtd_declaration = '<?xml version="1.0" encoding="utf-8" standalone="yes"?>
<!DOCTYPE student_profile [
<!ELEMENT student_profile (profile_info, submitted_assignments)>
<!ELEMENT profile_info (full_name, occupation, social_media)>
<!ELEMENT full_name (#PCDATA)>
<!ELEMENT occupation (#PCDATA)>
<!ELEMENT social_media (linkedin, facebook, youtube, instagram, twitter)>
<!ELEMENT linkedin (#PCDATA)>
<!ELEMENT facebook (#PCDATA)>
<!ELEMENT youtube (#PCDATA)>
<!ELEMENT instagram (#PCDATA)>
<!ELEMENT twitter (#PCDATA)>
<!ELEMENT submitted_assignments (assignment*)>
<!ELEMENT assignment (title, description, submission_file, submission_date)>
<!ELEMENT title (#PCDATA)>
<!ELEMENT description (#PCDATA)>
<!ELEMENT submission_file (#PCDATA)>
<!ELEMENT submission_date (#PCDATA)>
]>';

$root = $dom->createElement('student_profile');
$dom->appendChild($root);
$profile_info = $dom->createElement('profile_info');
$root->appendChild($profile_info);
$full_name = $dom->createElement('full_name', $profile['full_name']);
$profile_info->appendChild($full_name);
$occupation = $dom->createElement('occupation', $profile['occupation']);
$profile_info->appendChild($occupation);
$social_media = $dom->createElement('social_media');
$profile_info->appendChild($social_media);
$social_networks = ['linkedin', 'facebook', 'youtube', 'instagram',
'twitter'];
foreach ($social_networks as $network) {
$element = $dom->createElement($network, $profile[$network]);
$social_media->appendChild($element);
}
$submitted_assignments = $dom->createElement('submitted_assignments');
$root->appendChild($submitted_assignments);


while ($assignment = $assignments_result->fetch_assoc()) {
$assignment_elem = $dom->createElement('assignment');
$title = $dom->createElement('title', $assignment['submission_title']);
$assignment_elem->appendChild($title);
$description = $dom->createElement('description',
$assignment['submission_description']);
$assignment_elem->appendChild($description);
$submission_file = $dom->createElement('submission_file',
$assignment['submission_file']);
$assignment_elem->appendChild($submission_file);

$submission_date = $dom->createElement('submission_date',
$assignment['submission_timestamp']);
$assignment_elem->appendChild($submission_date);
$submitted_assignments->appendChild($assignment_elem);
}

$xml_output = $dtd_declaration .
"\n" . $dom->saveXML($dom->documentElement);

$validation_xml = new DOMDocument();

if (!$validation_xml->loadXML($xml_output)) {
echo "<div class='error-message'>";
echo "<h3>Σφάλμα: Το XML έγγραφο δεν είναι έγκυρο</h3>";
echo "</div>";
} else {
$filename = 'student_' . $profile['full_name'] . '_profile.xml';
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="' . $filename . '"');
echo $xml_output;

}
?>