<?php

include('../db_connect/connection.php');
include('header.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organic Vegetables</title>
     <style>

            
    .fruite-item {
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        min-height: 350px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom:10px;
    }

    .fruite-item:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(20, 197, 91, 0.1);
        
    }

    .fruite-img {
        width: 100%;
        height: 200px; 
        overflow: hidden;
    }

    .fruite-img img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
        transition: transform 0.5s ease;
    }
    
    .fruite-item:hover .fruite-img img {
        transform: scale(1.1);
    }

    /* Category Badge */
    .category-badge {
        top: 10px; 
        left: 10px;
        background-color: rgb(204, 141, 39);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    /* Tab Styling */
    .custom-tab-link {
        background-color: #f8f9fa;
        color: #333;
        border-radius: 50px;
        transition: all 0.3s ease;
        border: none;
    }

        .custom-tab-link:hover,
        .custom-tab-link.active {
            background-color: rgb(204, 141, 39) !important;
            color: white !important;
            text-decoration:none;
        }

    /* Button Styling */
    .btn-custom {
        border: 1px solid rgb(204, 77, 39);
        color: rgb(86, 204, 39);
        transition: all 0.3s ease;
    }
    
    .btn-custom:hover {
        background-color: rgb(204, 141, 39);
        color: white;
    }
    
    /* Special Offer Cards */
    .service-item {
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .service-item:hover {
        transform: translateY(-5px);
        text-decoration:none;
    }
    
    .service-content {
        background-color: rgb(86, 204, 39);
        padding: 20px;
        color: white;
        

    }
    
    /* Price Styling */
    .price-display {
        font-weight: bold;
        color: rgb(96, 101, 94);
    }

         
    </style>
</head>
<body>
<div class="container-fluid py-5"><br><br><br><br>
    <div class="container">
        <h2 class="text-center page-title mb-5"> Organic Vegetables</h2>
        <div class="row g-4">
            <?php
            // Prepare and execute the query securely
            $sql = "SELECT * FROM organic";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Image path: assuming images are stored in 'css/img/'
                    $imagePath = 'css/img/' . $row['image'];
                    if (!file_exists($imagePath) || empty($row['image'])) {
                        $imagePath = 'css/img/default-vegetable.jpg';
                    }

                    // Debug log (view page source)
                    echo "<!-- Showing: {$row['name']} | Image: {$row['image']} -->";
            ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="fruite-item h-100">
                        <div class="fruite-img">
                            <img src="<?= $imagePath ?>" class="img-fluid" alt="<?= htmlspecialchars($row['name']) ?>"
                                 onerror="this.src='css/img/default-vegetable.jpg';">
                        </div>
                        <div class="p-4">
                            <h4><?= htmlspecialchars($row['name']) ?></h4>
                            <p class="text-muted"><?= htmlspecialchars($row['description']) ?></p>
                            <p class="price-display fs-5 fw-bold mb-0">
                                <i class="fas fa-rupee-sign"></i> <?= htmlspecialchars($row['price']) ?> /
                                <?= htmlspecialchars($row['weight']) ?><?= htmlspecialchars($row['weight_type']) ?>
                            </p>
                            <?php if (isset($_SESSION['id'])) { ?>
                                <a href="add_to_cart.php?id=organic-<?= $row['id']; ?>" class="btn btn-custom rounded-pill px-3 mt-2">
                                    <i class="fas fa-shopping-bag me-2"></i> Add to Cart
                                </a>
                            <?php } else { ?>
                                <button type="button" class="btn btn-custom rounded-pill px-3 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="fas fa-shopping-bag me-2"></i> Add to Cart
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo '<div class="col-12 text-center py-5">
                        <div class="alert alert-info">No organic vegetables available at the moment.</div>
                      </div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal for non-logged-in users -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             Please login
            </div>
            <div class="modal-footer">
                <a href="login.php" class="btn btn-primary">Login</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
