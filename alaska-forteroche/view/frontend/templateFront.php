<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Billet simple pour l'Alaska, roman de Jean Forteroche">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="icon" href="public/imgs/favicon.ico" />
    <title><?= $head_title ?></title>
</head>
<body class="body-front">

<div>
    <?= $headerHome ?>
</div>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light box-shadow-nav border-bottom">
    <a class="navbar-brand mb-0 h1" href="index.php">Jean Forteroche</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse font-weight-bold" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= $homeActive ?>">
                <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= $chapterActive ?>">
                <a class="nav-link" href="index.php?action=allChapter&amp;p=1">Chapitres<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= $authorActive ?>">
                <a class="nav-link" href="index.php?action=author">L'auteur<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div>
    <?= $headerRest ?>
</div>

<div class="container">
    <?= $content ?>
</div>

<div style="height: 50px"></div>

<footer class="position-absolute container-fluid footer text-center border-top pt-3 pb-2 box-shadow-footer">
    <h1 class="h6">Billet simple pour l'Alaska - Copyright 2018</h1>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</body>
</html>