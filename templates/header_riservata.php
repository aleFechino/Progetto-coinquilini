<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>RooMatch</title>
</head>
<body>
    <?php
    session_start(); //apre o crea una sessione

    if(!isset($_SESSION["login"])){  //gestisce la sicurezza dell'area privata: se uno accede dall'url alla pagine senza la sessione attiva viene reindirizzato al login
        header("location: ./index.php");
        exit();
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <div class="d-flex flex-column">
        <a class="navbar-brand fw-bold fs-3 mb-0"
        href="./home.php"
        style="background: linear-gradient(90deg, #fd267a, #ff6036); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            RooMatch
        </a>

        <span class="small text-muted ms-1">
            Ciao <?php echo $_SESSION["nomeUtente"]?>
        </span>
    </div>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 fw-semibold text-dark" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-semibold text-dark" href="./conquiPreferiti.php">Preferiti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-semibold text-dark" href="./cercaCasa.php">Cerca Casa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-semibold text-dark" href="./offreCasa.php">Offri Casa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-semibold text-dark" href="./profiloUtente.php">
                        <i class="bi bi-person-circle fs-5"></i> Profilo
                    </a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-danger rounded-pill px-4 fw-bold border-2" href="./logout.php" style="border-color: #fd267a; color: #fd267a;">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>