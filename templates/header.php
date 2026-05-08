<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RooMatch - Trova il tuo coinquilino</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons (Opzionale, utile per icone social) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Il tuo file CSS personalizzato -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <!-- Header pulito: mostriamo il titolo solo se NON siamo nella pagina di login -->
    <?php if (basename($_SERVER['PHP_SELF']) != 'login.php'): ?>
    <header class="bg-white shadow-sm py-3 mb-4">
        <div class="container text-center">
            <h1 class="h3 fw-bold mb-0" style="background: linear-gradient(90deg, #fd267a, #ff6036); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
    RooMatch
</h1>
            <small class="text-muted">Cerca il tuo coinquilino perfetto</small>
        </div>
    </header>
    <?php endif; ?>