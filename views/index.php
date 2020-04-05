<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Ingyenes apróhirdetés</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="/fa4zpw/css/app.css" />
    <link rel="stylesheet" media="print" href="/fa4zpw/css/print.css" />
    <link rel="icon" type="image/png" href="/fa4zpw/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="/fa4zpw/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/fa4zpw/favicon-96x96.png" sizes="96x96" />
</head>

<body>
<?php include_once("views/header.php") ?>
<main class="placeholder">
    <div class="wrapper">
        <div class="container">
            <section class="main">
                <?php
                if (isset($page) && is_file("views/{$page}.php"))
                    require_once ("views/{$page}.php");
                else
                    require_once ("views/404.php");
                ?>
            </section>
            <?php require_once ("views/sidebar.php"); ?>
        </div>
    </div>
</main>
<?php include_once("views/footer.php") ?>
<script src="/fa4zpw/js/app.js"></script>
</body>
</html>