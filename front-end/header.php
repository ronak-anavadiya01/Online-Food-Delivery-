<?php
include '../db_connect/connection.php';
session_start();
$user_id = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foodie</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <style>
               
    .btn-primary {
        background-color: rgb(86, 204, 39) !important;
    }
    .bg-primary {
        background-color: rgb(86, 204, 39) !important;
    }
    
    .text-primary {
        color: rgb(86, 204, 39) !important;
    }
    
    .border-primary {
        border-color: rgb(86, 204, 39) !important;
    }
    .navbar-nav .nav-link {
        transition: color 0.3s;
        color: #000;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: rgb(86, 204, 39) !important;
    }
    

    
    </style>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class= "container-fluid fixed-top  bg-white shadow-sm ">
        <div class="container topbar bg-primary" style="height:40px;">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">107 City Center, Deesa</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Foodie@Gmail.com</a></small>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl" style="height:100px;">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-primary display-6">Foodie</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="shop.php" class="nav-item nav-link">Organic Food</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0" >
                        <a href="mycart.php" class="position-relative me-4 my-auto text-primary ">
                            <i class="fa fa-shopping-bag fa-2x" ></i>
                        </a>
                        <?php if ($user_id): ?>
                        <div class="nav-item dropdown  ">
                            <a href="#" class="nav-link dropdown-toggle text-primary" data-bs-toggle="dropdown">
                                <i class="fas fa-user fa-2x "></i> <?php echo htmlspecialchars($user_id); ?>
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="user-profile.php" class="dropdown-item"><i class="fa fa-user "></i> Profile</a>
                                <a href="user-change-password.php" class="dropdown-item"><i class="fa fa-lock"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a href="user-logout.php" class="dropdown-item text-danger"><i class="fa fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </div>
                        <?php else: ?>
                        <a href="#" class="my-auto" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Sign In Modal -->
    <div class="modal fade" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" name="email"required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password"required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="signup" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#mySignUpModal">Sign Up</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="mySignUpModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="full_name"required>
                        </div>
                        <div class="mb-3">
                            <label for="signupEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="signupEmail" name="email"required>
                        </div>
                        <div class="mb-3">
                            <label for="signupPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="signupPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile"required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="signin" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal">Sign In</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>