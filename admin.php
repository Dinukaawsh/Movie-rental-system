<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Fixed background image */
        #background-image {
            background-image: url('images/slide3.png'); /* Replace with your background image URL */
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            z-index: -1; /* Ensures it stays behind the content */
        }

        /* Style for table images */
        .movie-image {
            width: 100px;  /* Set a fixed width for all movie images */
            height: 150px; /* Set a fixed height for all movie images */
            object-fit: cover; /* Ensures the images maintain their aspect ratio without distortion */
            border-radius: 5px; /* Optional: adds rounded corners */
        }

        /* Button Styles */
        .btn {
            min-width: 120px;
        }

        /* Table Responsive Design */
        .table-responsive {
            overflow-x: auto;
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
            }
        }

        /* Title text white and improved visibility */
        h1.text-white {
            color: white;
            font-weight: bold;
        }

        /* Optional: Add styling for the table header to improve readability */
        .thead-dark th {
            background-color: #343a40;
            color: white;
        }

        /* Button styling */
        .btn {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top" style="background: linear-gradient(45deg, #ff6a00, #ee0979);">
            <div class="container">
                <a class="navbar-brand fw-bold text-uppercase text-white" href="#">BLASTER Movie Rental System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="home.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="admin_login.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <!-- Title Section -->
        <h1 class="text-center mb-4 text-white">Movie Admin Panel</h1>
        
        <!-- Add Movie Button -->
        <div class="text-center mb-4">
            <button id="addMovieBtn" class="btn btn-success" onclick="window.location.href='addMovie.php'">Add Movie</button>
        </div>

        <!-- Movie Table Section -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Genre</th>
                        <th>Release Year</th>
                        <th>Rating</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="movieTableBody">
                    <?php
                    $xml = simplexml_load_file('movies.xml') or die("Error: Cannot create object");
                    foreach ($xml->movie as $movie) {
                        echo "<tr>";
                        echo "<td>" . $movie['id'] . "</td>";
                        echo "<td>" . $movie->title . "</td>";
                        echo "<td><img src='" . $movie->image . "' alt='Movie Image' class='movie-image'></td>";
                        echo "<td>" . $movie->genre . "</td>";
                        echo "<td>" . $movie->releaseYear . "</td>";
                        echo "<td>" . $movie->rating . "</td>";
                        echo "<td><button class='btn btn-warning' onclick=\"editMovie('" . $movie['id'] . "')\">Edit</button></td>";
                        echo "<td><button class='btn btn-danger' onclick=\"deleteMovie('" . $movie['id'] . "')\">Delete</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Fixed Background Image -->
    <div id="background-image" class="position-fixed top-0 left-0 w-100 h-100 bg-image"></div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <!-- Footer Links -->
                <div class="col-md-4">
                    <h5>BLASTER Movie Rental</h5>
                    <p>Providing the best online movie rental experience for movie enthusiasts around the world.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#about-us" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="terms.html" class="text-white text-decoration-none">Terms & Conditions</a></li>
                        <li><a href="privacy.html" class="text-white text-decoration-none">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p class="mb-0">© 2024 BLASTER Movie Rental System. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="admin.js"></script>
</body>
</html>
