<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.78.1">
    <title><?= lang('Errors.whoops') ?></title>
    <meta name="theme-color" content="#dc3545">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.3/examples/sign-in/sign-in.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-danger text-white ">

    <main class="form-signin w-100 m-auto">
        <form>
            <h1 class="display-1 fw-normal"><?= lang('Errors.whoops') ?></h1>
            <p><?= lang('Errors.weHitASnag') ?></p>
            <hr>
            <small>
                <p>IP Address: <?= $_SERVER['REMOTE_ADDR']; ?></p>
                <p>User Agent: <?= $_SERVER['HTTP_USER_AGENT']; ?></p>
            </small>
            <hr>
            <div class="d-grid gap-2 d-flex justify-content-end">
                <div class="btn-group" role="group">
                    <button class="btn btn-light btn-block bg-gradient" type="button" onclick="window.history.back();">Go Back</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>