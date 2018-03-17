<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <title><?= $head_title ?></title>
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-0 h1" href="index.php">Jean Forteroche</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse font-weight-bold" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= $accueilActive ?>">
                <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= $chapitresActive ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Chapitres
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?= $chapterNav ?>
                </div>
            </li>
            <li class="nav-item <?= $contactActive ?>">
                <a class="nav-link" href="#">Contact<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div>
    <?= $header ?>
</div>

<div class="container">
    <?= $content ?>
</div>

<footer class="container-fluid footer text-center border-top pt-4 pb-1">
    <p>Billet simple pour l'Alaska - Jean Forteroche - Copyright 2018</p>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>