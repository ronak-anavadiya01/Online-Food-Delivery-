<?php
include('../db_connect/connection.php');
include('header.php');

// Form submission logic
$showSuccess = false;
$showError = false;

if (isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $message = $_POST['message'] ?? '';

    $query = "INSERT INTO contact_messages (name, email, mobile, message) 
              VALUES ('$name', '$email', '$mobile', '$message')";

    if (mysqli_query($con, $query)) {
        $showSuccess = true;
    } else {
        $showError = true;
    }
}
?>

<style>
    .bg-primary {
        background-color: rgb(86, 204, 39) !important;
    }
</style>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Trigger SweetAlert based on status -->
<?php if ($showSuccess): ?>
<script>
    swal("Success", "Message sent successfully!", "success");
</script>
<?php elseif ($showError): ?>
<script>
    swal("Error", "Something went wrong. Please try again!", "error");
</script>
<?php endif; ?>

<div class="container-fluid contact py-5"><br><br>
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Contact Us</h1>
                    </div>
                </div>

                <!-- Google Map -->
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100"
                                style="height: 400px;"
                                   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.2026551949326!2d72.1858399750375!3d24.256263378335496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395c0d78fa95c1b9%3A0x3536e2109f1f601a!2sDeesa%2C%20Gujarat%20385535%2C%20India!5e0!3m2!1sen!2sin!4v1713095807759!5m2!1sen!2sin"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <h2 align=center>contact page</h2>
                    <form method="post" action="">
                        <input type="text" name="name" class="w-100 form-control border-2 py-3 mb-4" placeholder="Your Name" required>
                        <input type="email" name="email" class="w-100 form-control border-2 py-3 mb-4" placeholder="Enter Your Email" required>
                        <input type="text" name="mobile" class="w-100 form-control border-2 py-3 mb-4" placeholder="Your Mobile Number" required>
                        <textarea name="message" class="w-100 form-control border-2 mb-4" rows="5" placeholder="Your Message" required></textarea>
                        <button type="submit" name="submit" class="w-100 btn form-control border-secondary py-2 bg-primary text-white">Submit</button>
                    </form>
                </div>

                <!-- Contact Info Cards -->
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">107 City Center, Deesa, B.K-353335</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">Foodie@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Phone</h4>
                            <p class="mb-2">(+91) 8511202454</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
