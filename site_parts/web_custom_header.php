<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Register</title>
    <link rel="stylesheet" href="./css/forms.css" />
    <link rel="stylesheet" href="./css/colors.css" />
    <link rel="stylesheet" href="./css/index.css" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/fonts.css" />


    <style>
    .navbar-brand {
        padding: 0;
        /* Remove default padding */
    }

    .navbar-brand img {
        max-height: 100%;
        /* Ensure the logo doesn't exceed navbar height */
    }

    .navbar-nav .nav-link {
        position: relative;
    }

    .navbar-nav .nav-link::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--secondary);
        /* Adjust to your desired underline color */
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover::before {
        width: 100%;
    }

    .nav-li-c {
        margin: 0 8px;
    }

    .footer {
        background-color: var(--dark);
        color: white;
        text-align: center;
        padding: 20px 0;
        margin-top: auto;
    }
    </style>

</head>


<body>

    <nav class="navbar navbar-expand-md navbar-dark"
        style="background-color: var(--primary) !important; position:fixed; z-index: 99; width: 100%; height: var(--nav-height); top:0;">
        <div class="container-fluid" style="background-color: var(--primary) !important;">
            <a class="navbar-brand" href="#">
                <img src="./images/logo_.png" alt="Logo" style="width: 70px; height: 70px;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item nav-li-c">
                        <a href="index.php" class="nav-link text-color-main nav-texts">Home</a>
                    </li>
                    <li class="nav-item nav-li-c">
                        <a href="about_us.php" class="nav-link text-color-main nav-texts">About Us</a>
                    </li>
                    <li class="nav-item nav-li-c">
                        <a href="our_process.php" class="nav-link text-color-main nav-texts">Our Process</a>
                    </li>
                    <li class="nav-item nav-li-c">
                        <a href="register.php" class="nav-link text-color-main nav-texts">Registrations</a>
                    </li>
                    <li class="nav-item nav-li-c">
                        <a href="login.php" class="nav-link text-color-main nav-texts">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>