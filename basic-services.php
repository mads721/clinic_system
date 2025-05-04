<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Dental Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="interactions/style.css">
    <style>
        
    </style>
</head>
<body>
    

    <!-- Navbar -->
    <?php include 'topNavbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section basic-hero d-flex flex-column justify-content-center align-items-center text-center" id="hero" data-aos="fade-up">
        <h1 class="display-4 fw-bold" data-aos="zoom-in">Our Basic Services</h1>
        <p class="lead" data-aos="fade-up">Our mission is to deliver high-quality, personalized care to enhance your dental health.</p>
        <div data-aos="fade-up">
            <a href="#services" class="btn btn-primary btn-lg">View Services</a>
            <a href="specialized-services.php" class="btn btn-outline-light btn-lg ms-2">Specialized Services</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5" id="services" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Our Basic Services</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                
                <!-- Service 1: Tooth Fillings -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Tooth Fillings</h5>
                            <div class="image-container mb-3">
                                <img src="https://www.wilkdental.com/wp-content/uploads/2020/09/Tooth-filling-procedure-featuring-ultraviolet-lamp-1024x682-1-768x512.jpg" alt="Tooth Fillings" class="img-fluid">
                            </div>
                            <p>Tooth fillings restore damaged or decayed teeth by sealing cavities and preventing further decay.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 2: Tooth Extraction -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Tooth Extraction</h5>
                            <div class="image-container mb-3">
                                <img src="https://teethcarecentre.com/dentist-ahmedabad-india/wp-content/uploads/2021/08/Tooth-Romoval-extraction-oral-surgeon-dentist-painfree-dental-treatment-surgery-in-ahmedabad-teeth-care-centre.jpg" alt="Tooth Extraction" class="img-fluid">
                            </div>
                            <p class="card-text">Safe and professional tooth removal with minimal discomfort.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 3: Teeth Cleaning -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Teeth Cleaning (Oral Prophylaxis)</h5>
                            <div class="image-container mb-3">
                                <img src="https://media.post.rvohealth.io/wp-content/uploads/2020/11/dentist-732x549-thumbnail-732x549.jpg" alt="Teeth Cleaning" class="img-fluid">
                            </div>
                            <p class="card-text">Professional cleaning to remove plaque and tartar buildup.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 4: X-ray and Diagnostic Services -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">X-ray and Diagnostic Services</h5>
                            <div class="image-container mb-3">
                                <img src="https://martindaledental.com/wp-content/uploads/2023/09/guide-to-dental-x-rays.jpg" alt="X-ray Services" class="img-fluid">
                            </div>
                            <p class="card-text">Advanced diagnostic tools for accurate dental assessments.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 5: Braces -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Braces</h5>
                            <div class="image-container mb-3">
                                <img src="https://live-cms.s3.eu-south-1.amazonaws.com/Img_2_Metal_Braces_6168c96499.jpeg" alt="Braces" class="img-fluid">
                            </div>
                            <p class="card-text">Correct misaligned teeth and improve your smile with braces.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 6: Teeth Whitening -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Teeth Whitening</h5>
                            <div class="image-container mb-3">
                                <img src="https://ih-sad.wp02.ihealthspot.com/wp-content/uploads/sites/592/2020/03/Teeth-Whitening.jpg" alt="Teeth Whitening" class="img-fluid">
                            </div>
                            <p class="card-text">Brighten your smile with professional whitening treatments.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Get Service Modal -->
    <div class="modal fade" id="getServiceModal" tabindex="-1" aria-labelledby="getServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="getServiceModalLabel">Get This Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service Needed</label>
                            <select class="form-select" required>
                                <option value="">Select a service</option>
                                <option value="tooth-fillings">Tooth Fillings</option>
                                <option value="tooth-extraction">Tooth Extraction</option>
                                <option value="teeth-cleaning">Teeth Cleaning</option>
                                <option value="x-ray">X-ray and Diagnostic Services</option>
                                <option value="braces">Braces</option>
                                <option value="teeth-whitening">Teeth Whitening</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Get This Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="password"]');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    </script>
</body>
</html>