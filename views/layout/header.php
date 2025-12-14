<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'Мій блог' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { background-color: #fafafa; }
        header { text-align: center; margin: 24px 0; }
    </style>
</head>
<body>
<header>
    <h1 class="text-primary">Мій блог</h1>
    <hr>
    <div class="container">
        <form class="row g-3 justify-content-center" method="get" action="index.php">
            <div class="col-12 col-md-6">
                <input type="text" class="form-control" name="search" placeholder="Пошук..." value="<?= isset($search) ? htmlspecialchars($search, ENT_QUOTES, 'UTF-8') : '' ?>">
            </div>
            <div class="col-12 col-md-auto">
                <button type="submit" class="btn btn-primary mb-3">Пошук</button>
            </div>
        </form>
    </div>
</header>
