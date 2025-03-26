<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <title>Πλατφόρμα Μεταπτυχιακού</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php
        include('config.php'); 
        session_start(); 
        ?>
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="logo" style="height: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation  -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Αρχική</a>
                    </li>
                    <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
                    echo '<li class="nav-item">
                    <a class="nav-link active" href="portfolio.php">Portfolio Εργασιών</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Προφίλ</a>
                    </li>';
                } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'professor') {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="create_ergasia.php">Δημιουργία Εργασίας</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_ergasies.php">Προβολή Εργασιών</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_foititis.php">Εικόνα Φοιτητή</a>
                    </li>';
                } ?>
                </ul>
                <?php if (isset($_SESSION['user_id'])) {
                echo '<button type="button" class="btn btn-danger btn-lg"><a href="logout.php" 
						class="nav-link">Έξοδος</a></button>';
            } else {
                echo '<button type="button" class="btn btn-primary btn-lg"><a href="login.html" 
						class="nav-link">Είσοδος</a></button>';
            }
            ?>
                
            </div>
        </div>
    </header>

    <div class="container main-content3 my-8"><br>
        <h1 class="text-center mb-4">Εικόνα Φοιτητή</h1>
        <p class="text-center text-muted mb-4">Επιλέξτε φοιτητή για να δείτε το προφίλ του και τις υποβληθείσες εργασίες
            του.</p>

        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <form method="GET" action="">
                    <div class="mb-12">
                        <b><label for="student" class="form-label">Φοιτητής</label></b>
                        <select class="form-select" id="student" name="student_id" onchange="this.form.submit()">
                            <option value="" selected disabled>Επιλέξτε φοιτητή</option>
                            <?php
                            include('config.php');
                            $result = mysqli_query($conn, "SELECT u.user_id, u.email, up.full_name 
                                                         FROM users u 
                                                         JOIN user_profile up ON u.user_id = up.user_id 
                                                         WHERE u.role = 'student' 
                                                         ORDER BY up.full_name");
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = '';
                                if (isset($_GET['student_id']) && $_GET['student_id'] == $row['user_id']) {
                                    $selected = 'selected';
                                }
                                echo "<option value='" . $row['user_id'] . "' $selected>" . $row['full_name'] . " (" . $row['email'] . ")</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_GET['student_id'])) {
            $student_id = $_GET['student_id'];

            $profile_query = "SELECT *
                             FROM users u 
                             JOIN user_profile up ON u.user_id = up.user_id 
                             WHERE u.user_id = '$student_id'";
            $profile_result = mysqli_query($conn, $profile_query);

            if (mysqli_num_rows($profile_result) > 0) {
                $profile = mysqli_fetch_assoc($profile_result);

                echo '<div class="row">';

                // Προφίλ φοιτητή
                echo '<div class="col-md-12">';
                echo '<div class="card mb-12">';
                echo '<div class="card-header bg-primary text-white">';
                echo '<h3>Προφίλ Φοιτητή</h3>';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">' . $profile['full_name'] . '</h4>';
                echo '<p class="card-text"><strong>Email:</strong> ' . $profile['email'] . '</p>';

                if (!empty($profile['occupation'])) {
                    echo '<p class="card-text"><strong>Επαγγελματική Ενασχόληση:</strong> ' . $profile['occupation'] . '</p>';
                }

                echo '<h5 class="mt-4">Κοινωνικά Δίκτυα</h5>';
                echo '<ul class="list-group list-group-flush">';

                if (!empty($profile['linkedin'])) {
                    echo '<li class="list-group-item"><strong>LinkedIn:</strong> <a href=https://' . $profile['linkedin'] . ' target="_blank">' . $profile['linkedin'] . '</a></li>';
                }

                if (!empty($profile['facebook'])) {
                    echo '<li class="list-group-item"><strong>Facebook:</strong> <a href=https://' . $profile['facebook'] . ' target="_blank">' . $profile['facebook'] . '</a></li>';
                }

                if (!empty($profile['youtube'])) {
                    echo '<li class="list-group-item"><strong>YouTube:</strong> <a href=https://' . $profile['youtube'] . ' target="_blank">' . $profile['youtube'] . '</a></li>';
                }

                if (!empty($profile['instagram'])) {
                    echo '<li class="list-group-item"><strong>Instagram:</strong> <a href=https://' . $profile['instagram'] . ' target="_blank">' . $profile['instagram'] . '</a></li>';
                }

                if (!empty($profile['twitter'])) {
                    echo '<li class="list-group-item"><strong>Twitter/X:</strong> <a href=https://' . $profile['twitter'] . ' target="_blank">' . $profile['twitter'] . '</a></li>';
                }

                echo '</ul>';
                echo '</div>';  
                echo '</div>';
                echo '</div>';  
        
                echo '<div class="col-md-12">';
                echo '<div class="card">';
                echo '<div class="card-header bg-primary text-white">';
                echo '<h3>Υποβληθείσες Εργασίες</h3>';
                echo '</div>';
                echo '<div class="card-body">';

                $submissions_query = "SELECT * 
                                     FROM submitted_assignment sa 
                                     JOIN assignment_description ad ON sa.assignment_id = ad.assignment_id 
                                     JOIN courses c ON ad.course_id = c.course_id
                                     WHERE sa.user_id = '$student_id' 
                                     ORDER BY sa.submission_timestamp DESC";
                $submissions_result = mysqli_query($conn, $submissions_query);

                if (mysqli_num_rows($submissions_result) > 0) {
                    echo '<div class="accordion" id="submissionsAccordion">';

                    
                    $counter = 1;
                    
                    while ($submission = mysqli_fetch_assoc($submissions_result)) {
                        echo '<div class="accordion-item mb-3">';
                        echo '<h2 class="accordion-header">';

                        echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse' . $counter . '" aria-expanded="false"
                                aria-controls="collapse' . $counter . '">';
                        
                        echo $submission['submission_title'] . ' <span class="badge bg-secondary ms-2">' . $submission['course_title'] . '</span>';
                        echo '</button>';
                        echo '</h2>';

                        echo '<div id="collapse' . $counter . '" class="accordion-collapse collapse" data-bs-parent="#submissionsAccordion">';

                        echo '<div class="accordion-body">';
                        echo '<h5>Πληροφορίες Εργασίας</h5>';
                        echo '<p><strong>Μάθημα:</strong> ' . $submission['course_title'] . '</p>';
                        echo '<p><strong>Εκφώνηση:</strong> ' . $submission['assignment_title'] . '</p>';
                        echo '<p><strong>Ημερομηνία Υποβολής:</strong> ' . date('d/m/Y H:i:s', strtotime($submission['submission_timestamp'])) . '</p>';

                        echo '<h5 class="mt-3">Περιγραφή</h5>';
                        echo '<p>' . $submission['submission_description'] . '</p>';

                        echo '<div class="mt-3">';
                        echo '<a href="' . $submission['submission_file'] . '" class="btn btn-primary" download><i class="bi bi-download"></i> Λήψη Αρχείου Υποβολής</a>';
                        echo '</div>';

                        echo '</div>';  
                        echo '</div>';  
                        echo '</div>';  
        
                        $counter++;  
                    }

                    echo '</div>';  
                } else {
                    echo '<div class="alert alert-info">Ο φοιτητής δεν έχει υποβάλει ακόμα κάποια εργασία.</div>';
                }

                echo '</div>';  
                echo '</div>';  
                echo '</div>';  
        
                echo '</div><br><br>'; 
            } else {
                echo '<div class="alert alert-warning">Δεν βρέθηκαν στοιχεία για τον επιλεγμένο φοιτητή.</div>';
            }
        }
        ?>

    </div>
    <br><br>

    
    <footer class="footer">
        <div class="container text-center">
            <a href="pdf\terms.pdf" target="_blank">Όροι χρήσης</a>&emsp;|&emsp;
            <a href="pdf\privacy.pdf" target="_blank">Πολιτική Απορρήτου</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Bootstrap JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script την προσθηκη της κλασσης active ετσι ωστε να ειναι highlight το επιλεγμενο -->
<script>
 
   const links = document.querySelectorAll('.nav-link');
   
   links.forEach(link => {
       if (link.href === window.location.href) {
           link.classList.add('active'); 
       }
   });
</script>
</body>

</html>