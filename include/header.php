<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/chosen.css">
    <link rel="stylesheet" href="DataTables/datatables.min.css">
    <title>NDC-ECS</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand font-weight-bold text-danger" href="#">NDC-ECS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-items-center font-weight-bold text-warning" href="#" id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-expanded="false">Configuration
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="constituencies.php">Load Constituencies</a></li>
                            <li><a class="dropdown-item" href="electoral_areas.php">Load Electoral Areas</a></li>
                            <li><a class="dropdown-item" href="polling_stations.php">Load Polling Stations</a></li>
                            <li><a class="dropdown-item" href="parties.php">Load Parties</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-items-center font-weight-bold text-warning" href="#" id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-expanded="false">Constituency Ballots
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="ballot.php">Add Ballot</a></li>
                            <li><a class="dropdown-item" href="view_ballot.php">Load Ballots</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-items-center font-weight-bold text-warning" href="#" id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-expanded="false">Results
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="new_result.php">Add Result</a></li>
                            <li><a class="dropdown-item" href="load_results.php">Load Results</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mr-5">
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-items-center" href="#" id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="img/logo.jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mr-5"></ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <div class="container">
    
