<?php
include('../db_connect/connection.php');
?>

<div class="container-fluid py-5 mb-5" 
     style="background: url('css/img/hero-img.jpg') no-repeat center center; background-size: cover; min-height: 300px; margin-top: 110px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 " style="color: rgb(211, 32, 53);">100% Organic Foods</h4>
                <h1 class="mb-5 display-3" style="color: rgb(86, 204, 39);">Organic Veggies & Fruits & Foods</h1>
            </div>
        </div>
    </div>
</div>

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

    .category-badge {
        top: 10px; 
        left: 10px;
        background-color: rgb(204, 141, 39);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

   
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

 
    .btn-custom {
        border: 1px solid rgb(204, 77, 39);
        color: rgb(86, 204, 39);
        transition: all 0.3s ease;
    }
    
    .btn-custom:hover {
        background-color: rgb(204, 141, 39);
        color: white;
    }
    
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
    
    .price-display {
        font-weight: bold;
        color: rgb(96, 101, 94);
    }
    
    
</style>
<div class="container-fluid fruite py-5" style="margin-top:-100px;">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Categories</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                         
                            <a class="d-flex m-2 py-2 rounded-pill custom-tab-link active" data-bs-toggle="pill" href="#tab-all">
                                <span style="width: 130px;">All Products</span>
                            </a>
                        </li>   
                        <?php
                        $query = "SELECT * FROM categories WHERE status = 1";
                        $result = $con->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 rounded-pill custom-tab-link" data-bs-toggle="pill" href="#tab-<?php echo $row['id']; ?>">
                                        <span style="width: 130px;"><?php echo $row['name']; ?></span>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
              
                <div id="tab-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                $query = "SELECT foods.*,categories.name as category_name,food_images.name as food_image FROM foods LEFT JOIN categories ON categories.id = foods.category_id LEFT JOIN food_images ON food_images.food_id = foods.id";
                                $result = $con->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="../admin/food/upload/<?= $row['food_image']; ?>" alt="Food Image" class="img-fluid">
                                                </div>
                                                <div class="category-badge position-absolute">
                                                    <?= $row['category_name']; ?>
                                                </div>
                                                <div class="p-4 rounded-bottom">
                                                    <h4><?= $row['name']; ?></h4>
                                                    <p class="text-muted"><?= $row['description']; ?></p>
                                                    <p class="price-display fs-5 fw-bold mb-0">
                                                        <i class="fas fa-rupee-sign"></i> <?= $row['price']; ?> / <?= $row['weight']; ?> <?= $row['weight_type']; ?>
                                                    </p>

                                                    <?php if (isset($_SESSION) && isset($_SESSION['id'])) { ?>
                                                        <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-custom rounded-pill px-3 mt-2">
                                                            <i class="fas fa-shopping-bag me-2"></i> Add to cart
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
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
              
                <?php
                $query = "SELECT * FROM categories WHERE status = 1";
                $categories = $con->query($query);

                if ($categories->num_rows > 0) {
                    while ($category = $categories->fetch_assoc()) {
                ?>
                        <div id="tab-<?php echo $category['id']; ?>" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php
                                        $query = "SELECT foods.*,categories.name as category_name,food_images.name as food_image 
                                                  FROM foods 
                                                  LEFT JOIN categories ON categories.id = foods.category_id 
                                                  LEFT JOIN food_images ON food_images.food_id = foods.id 
                                                  WHERE foods.category_id = " . $category['id'];
                                        $result = $con->query($query);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="../admin/food/upload/<?= $row['food_image']; ?>" alt="Food Image" class="img-fluid">
                                                        </div>
                                                        <div class="category-badge position-absolute">
                                                            <?= $category['name']; ?>
                                                        </div>
                                                        <div class="p-4 rounded-bottom">
                                                            <h4><?= $row['name']; ?></h4>
                                                            <p class="text-muted"><?= $row['description']; ?></p>
                                                            <p class="price-display fs-5 fw-bold mb-0">
                                                                <i class="fas fa-rupee-sign"></i> <?= $row['price']; ?> / <?= $row['weight']; ?> <?= $row['weight_type']; ?>
                                                            </p>
                                                            <?php if (isset($_SESSION) && isset($_SESSION['id'])) { ?>
                                                                <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-custom rounded-pill px-3 mt-2">
                                                                    <i class="fas fa-shopping-bag me-2"></i> Add to cart
                                                                </a>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-custom rounded-pill px-3 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">
                                                                    <i class="fas fa-shopping-bag me-2"></i> Add to Cart
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <?php
            $query3 = "SELECT foods.*,categories.name as category_name,food_images.name as food_image FROM foods LEFT JOIN categories ON categories.id = foods.category_id LEFT JOIN food_images ON food_images.food_id = foods.id LIMIT 3";
            $result3 = $con->query($query3);
            if ($result3->num_rows > 0) {
                while ($row = $result3->fetch_assoc()) {
            ?>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item rounded overflow-hidden">
                                <img src="../admin/food/upload/<?php echo $row['food_image']; ?>" class="img-fluid w-100" alt="">
                                <div class="service-content text-center p-4" >
                                <h5 class="text-white"><?php echo $row['category_name']; ?></h5>
                                <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>