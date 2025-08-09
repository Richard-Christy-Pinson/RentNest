   
    <?php
    session_start(); 
    $properties = $_SESSION['properties'];
        ?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RentNest</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <?php include 'navbar.php'; ?>

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                <form action="search_properties.php" method="GET">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <!-- <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                            </div> -->
                            <div class="col-md-4">
                                <select name="property_type" class="form-select border-0 py-3">
                                    <option selected>Property Type</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="House">House</option>
                                    <option value="Hostel">Hostel</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="district" class="form-select border-0 py-3">
                                    <option selected>District</option>
                                    <option value="Kottayam">Kottayam</option>
                                    <option value="Eranakulam">Eranakulam</option>
                                    <option value="Alappuzha">Alappuzha</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Search End -->


        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h2 class="mb-3">Property Listing at <?php echo htmlspecialchars($properties[0]['district']);?> </h2>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">

                        <?php if (!empty($properties) && is_array($properties)) { 
                            foreach ($properties as $property) { 
                                if($property['status'] == 1) 
                                { ?>
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href=""><img class="img-fluid" src="<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image"></a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"><?php echo htmlspecialchars($property['property_type']); ?></div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">₹<?php echo htmlspecialchars($property['rent']); ?></h5>
                                            <a class="d-block h5 mb-2" href="#" data-bs-toggle="modal" data-bs-target="#dateModal<?php echo htmlspecialchars($property['p_id']); ?>">
                                                <?php echo htmlspecialchars($property['caption']); ?>
                                            </a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                <?php echo htmlspecialchars($property['panch_munci']) . ', ' . htmlspecialchars($property['pincode']); ?>
                                            </p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>  <?php echo htmlspecialchars($property['sqft']); ?> Sqft</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?php echo htmlspecialchars($property['bedrooms']); ?> Bed</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i><?php echo htmlspecialchars($property['bathrooms']); ?> Bath</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Date Selection -->
                                <div class="modal fade" id="dateModal<?php echo htmlspecialchars($property['p_id']); ?>" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="margin-top: 100px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dateModalLabel">Select Dates for <?php echo htmlspecialchars($property['caption']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="submit-rent-out.php">
                                                    <div class="mb-3">
                                                        <label for="fromDate" class="form-label">From Date</label>
                                                        <input type="date" class="form-control" id="fromDate" name="from_date" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="toDate" class="form-label">To Date</label>
                                                        <input type="date" class="form-control" id="toDate" name="to_date" required>
                                                    </div>
                                                    <!-- Pass the property ID as a hidden field -->
                                                    <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property['p_id']); ?>">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } 
                                }
                            } 
                            else { ?>
                                <p>No properties available.</p>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property List End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

<?php
?>
