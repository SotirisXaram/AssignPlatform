<!DOCTYPE html>
<html lang="el">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Μεταπτυχιακό Machine Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- style.css -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    include('config.php'); //Σύνδεση με την βάση
    session_start(); // Για να ξεκινήσουν τα sessions
    ?>
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Αρχική</a>
                    </li>
                    <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="portfolio.php">Portfolio Εργασιών</a>
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



    <div class="container main my-4">
        <!-- Μηνυμα καλωσορισματος -->
        <div class="text-center mb-5">
            <h1 class="display-4 mb-3">Καλωσήλθατε στο Μεταπτυχιακό μας Πρόγραμμα<br>Data Science and Machine Learning
                (DAMA)</h1>
            <p class="lead">Σκοπός του ΠΜΣ «Data Science and Machine Learning» (Επιστήμη των Δεδομένων και Μηχανική
                Μάθηση) <br>είναι να προσφέρει γνώσεις και δεξιότητες γύρω από σύγχρονες μεθόδους και σύγχρονα
                υπολογιστικά
                εργαλεία της Επιστήμης των Δεδομένων και της Μηχανικής Μάθησης</p>
        </div>

        <!-- Τμήμα που περιλαμβάνει τις εικόνες -->
        <div class="row mb-5">
            <div class="text-center mb-5">
                <img src="img/img1.jpg" alt="Εικόνα 1" class="img-thumbnail mx-2"
                    style="max-width: 250px; height: 200px;">
                <img src="img/img2.jpg" alt="Εικόνα 2" class="img-thumbnail  mx-2"
                    style="max-width: 250px; height: 200px;">
                <img src="img/img3.jpg" alt="Εικόνα 3" class="img-thumbnail  mx-2"
                    style="max-width: 250px; height: 200px;">
            </div>
        </div>


        <!-- Buttons  -->
        <?php if (!isset($_SESSION['user_id'])) { ?>
        <div class="text-center">
            <a href="login.html" class="btn btn-primary btn-lg mx-2">Είσοδος</a>
            <a href="register.html" class="btn btn-success btn-lg mx-2">Εγγραφή</a>
        </div>
        <?php } ?>
        
    </div>
    <br>
    <br>
    <br>
    <br>
    <!-- Footer.  -->
    <footer class="footer">
        <div class="container text-center">
            <a href="pdf/terms.pdf" target="_blank">Όροι χρήσης</a>&emsp;|&emsp;
            <a href="pdf/privacy.pdf" target="_blank">Πολιτική Απορρήτου</a>
        </div>
    </footer>

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