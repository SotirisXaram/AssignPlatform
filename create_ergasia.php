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
                <img src="img/logo.png" alt="logo" class="logo">
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
    

    <div class="container main-content3 my-4">
        <h1 class="text-center mb-4">Δημιουργία Εργασίας</h1>
        <p class="text-center text-muted mb-4">Συμπληρώστε τα στοιχεία της νέας εργασίας.</p>

        <?php
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . $_GET['error'] . '</div>';
        }
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible"> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . $_GET['success'] . '</div>';
        }
        ?>

        <div class="profile-form">
            <form action="process_assignment.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <b><label for="course" class="form-label">Μάθημα</label></b>
                    <select class="form-select" id="course" name="course_id" required>
                        <option value="" selected disabled>Επιλέξτε μάθημα</option>
                        <?php
                        // Σύνδεση με τη βάση και λήψη των μαθημάτων
                        include('config.php');
                        $result = mysqli_query($conn, "SELECT course_id, course_title FROM courses");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['course_id'] . "'>" . $row['course_title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <b><label for="title" class="form-label">Τίτλος Εργασίας</label></b>
                    <input type="text" class="form-control" id="title" name="assignment_title"
                        placeholder="Εισάγετε τον τίτλο της εργασίας" required>
                </div>

                <div class="mb-4">
                    <b><label for="description" class="form-label">Πλήρης Εκφώνηση Εργασίας</label></b>
                    <textarea class="form-control" id="description" name="assignment_text" rows="6"
                        placeholder="Εισάγετε την πλήρη εκφώνηση της εργασίας" required></textarea>
                </div>

                <div class="mb-4">
                    <b><label for="image" class="form-label">Αρχείο Εικόνας Εργασίας</label></b>
                    <input type="file" class="form-control" id="image" name="assignment_image" accept="image/x-png,image/gif,image/jpg,image/jpeg"
                        required>
                    <small class="form-text text-muted">Αποδεκτοί τύποι: JPG, PNG, GIF. Μέγιστο μέγεθος: 5MB</small>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Δημιουργία Εργασίας</button>
                </div>
            </form>

        </div>
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