<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Load the XML file
    $xml = simplexml_load_file('movies.xml');

    // Add new movie
    $newMovie = $xml->addChild('movie');
    $newMovie->addAttribute('id', time());
    $newMovie->addChild('title', $_POST['title']);
    $newMovie->addChild('genre', $_POST['genre']);
    $newMovie->addChild('releaseYear', $_POST['releaseYear']);
    $newMovie->addChild('rating', $_POST['rating']);
    $newMovie->addChild('available', 'true');

    // Handle the image upload
    $imageName = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $imageName);
    $newMovie->addChild('image', "images/" . $imageName);

    // Save the updated XML with proper formatting
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $dom->save('movies.xml');

    // Redirect to the admin panel after saving
    header("Location: admin.php");
    exit(); // Stop further execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Light background */
        }

        /* Full-page background image */
        #background-image {
            background-image: url('images/slider.jpeg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: absolute;
            width: 100%;
            z-index: -1;
        }

        /* Form container style */
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Slight transparency */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .movie-image {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .preview-container img {
            max-width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        footer {
            background-color: #343a40;
            color: white;
        }

        footer a {
            color: white;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="background-image"></div> <!-- Full background image -->

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
                            <a class="nav-link fw-semibold text-white" href="admin.php">Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h1 class="text-center mb-4">Add New Movie</h1>

            <form action="addMovie.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter movie title" required>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" name="genre" id="genre" class="form-control" placeholder="Enter movie genre" required>
                </div>

                <div class="mb-3">
                    <label for="releaseYear" class="form-label">Release Year</label>
                    <input type="number" name="releaseYear" id="releaseYear" class="form-control" placeholder="Enter release year" required>
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" step="0.1" placeholder="Enter movie rating" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Movie Image</label>
                    <input type="file" name="image" id="movieImage" class="form-control" accept="image/*" required onchange="previewImage()">
                </div>

                <!-- Image Preview Section -->
                <div class="preview-container mb-3 text-center">
                    <img id="imagePreview" src="" alt="Image Preview" style="display: none;">
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Add Movie</button>
                </div>
            </form>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      <!-- JavaScript to preview image -->
      <script>
        function previewImage() {
            const file = document.getElementById('movieImage').files[0];
            const reader = new FileReader();

            reader.onloadend = function () {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block'; // Display the image preview
            };

            if (file) {
                reader.readAsDataURL(file); // Read the image file
            }
        }
    </script>
</body>

</html>
