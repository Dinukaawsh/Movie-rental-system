<?php
$id = $_GET['id'];
$xml = simplexml_load_file('movies.xml');
$movie = $xml->xpath("//movie[@id='$id']")[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie->title = $_POST['title'];
    $movie->genre = $_POST['genre'];
    $movie->releaseYear = $_POST['releaseYear'];
    $movie->rating = $_POST['rating'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        $movie->image = "uploads/" . $imageName;
    }

    $xml->asXML('movies.xml');
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
    <title>Edit Movie</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
        /* Custom styling for the background */
        #background-image {
            background-image: url('images/slide2.jpg'); /* Update with your image URL */
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Form Container Styling */
        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .form-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .button-container {
            text-align: center;
        }
        .form-container img {
    max-width: 50%; /* Adjust the width to be smaller */
    height: auto; /* Maintain aspect ratio */
    border-radius: 8px;
    margin-bottom: 20px;
    display: block; /* Ensure it behaves as a block element */
    margin-left: auto;
    margin-right: auto; /* Center the image */
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
                            <a class="nav-link fw-semibold text-white" href="admin.php">Back</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div id="background-image"></div> <!-- Fixed background image -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="form-container">
                <h1>Edit Movie</h1>

                <form action="editMovie.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <!-- Movie Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo $movie->title; ?>" required>
                    </div>

                    <!-- Movie Genre -->
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre</label>
                        <input type="text" name="genre" id="genre" class="form-control" value="<?php echo $movie->genre; ?>" required>
                    </div>

                    <!-- Release Year -->
                    <div class="mb-3">
                        <label for="releaseYear" class="form-label">Release Year</label>
                        <input type="number" name="releaseYear" id="releaseYear" class="form-control" value="<?php echo $movie->releaseYear; ?>" required>
                    </div>

                    <!-- Movie Rating -->
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" step="0.1" name="rating" id="rating" class="form-control" value="<?php echo $movie->rating; ?>" required>
                    </div>

                    <!-- Movie Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload New Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <!-- Current Image Preview -->
                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <img src="<?php echo $movie->image; ?>" alt="Current Image" class="img-fluid">
                    </div>

                    <!-- Submit Button -->
                    <div class="button-container">
                        <button class="btn btn-primary" type="submit">Update Movie</button>
                    </div>
                </form>
            </div>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</body>

</html>