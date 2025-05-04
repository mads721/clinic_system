<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Specialized Dental Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="interactions/style.css">
</head>
<body>

    
    <!-- Navbar -->
    <?php include 'topNavbar.php'; ?>
    <!-- Hero Section -->
    <section class="hero-section specialized-hero d-flex flex-column justify-content-center align-items-center text-center" id="hero" data-aos="fade-up">
        <h1 class="display-4 fw-bold" data-aos="zoom-in">Our Specialized Services</h1>
        <p class="lead" data-aos="fade-up">Advanced dental care tailored to your specific needs.</p>
        <div data-aos="fade-up">
            <a href="#services" class="btn btn-primary btn-lg">View Services</a>
            <a href="basic-services.php" class="btn btn-outline-light btn-lg ms-2">Basic Services</a>
        </div>
        </section>

    <!-- Services Section -->
    <section class="services-section py-5" id="services" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Our Specialized Services</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                
                <!-- Service 1: Root Canal Treatment -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Root Canal Treatment</h5>
                            <div class="image-container mb-3">
                                <img src="https://hollywoodsmiledc.com/wp-content/uploads/2022/09/Root-Canal-Treatment-2x-1.jpg" alt="Root Canal Treatment" class="img-fluid">
                            </div>
                            <p>Save your natural teeth with our advanced root canal treatment that eliminates infection and relieves pain.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 2: Dental Implants -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Dental Implants</h5>
                            <div class="image-container mb-3">
                                <img src="https://cdn-ilahmol.nitrocdn.com/fzTBLMVYFyNXrnAMnqhxQvIhscuElgWS/assets/images/optimized/rev-3dbf601/puredentalhealth.co.uk/wp-content/uploads/what-is-a-dental-implant.jpg" alt="Dental Implants" class="img-fluid">
                            </div>
                            <p class="card-text">Permanent tooth replacement solutions with natural-looking results and improved functionality.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 3: Orthodontic Treatment -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Invisalign Treatment</h5>
                            <div class="image-container mb-3">
                                <img src="https://www.mapledentalhealth.com/media/cache/blog/post/invisalign_OdgNeS7.jpg.874x364_q85_box-0%2C250%2C2213%2C1170_crop_detail.jpg" alt="Invisalign Treatment" class="img-fluid">
                            </div>
                            <p class="card-text">Discreet teeth straightening with clear aligners for a confident smile.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 4: Cosmetic Dentistry -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Porcelain Veneers</h5>
                            <div class="image-container mb-3">
                                <img src="https://www.culvercitydentist.com/cdn/shop/articles/dental-veneers-432137_0523a1f1-b70d-4ef4-b624-482ced9b0cfd-890405.webp?v=1738803559" alt="Porcelain Veneers" class="img-fluid">
                            </div>
                            <p class="card-text">Transform your smile with custom-made porcelain veneers for a flawless appearance.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 5: Periodontal Treatment -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Periodontal Treatment</h5>
                            <div class="image-container mb-3">
                                <img src="https://irp.cdn-website.com/10f9caf0/dms3rep/multi/New-Advances-in-Periodontal-Treatment.jpg" alt="Periodontal Treatment" class="img-fluid">
                            </div>
                            <p class="card-text">Specialized gum disease treatment to restore and maintain gum health.</p>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#getServiceModal">Get This Service</button>
                        </div>
                    </div>
                </div>

                <!-- Service 6: Full Mouth Reconstruction -->
                <div class="col" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Full Mouth Reconstruction</h5>
                            <div class="image-container mb-3">
                                <img src="https://www.shawnkellerdds.com/wp-content/uploads/2021/11/full-mouth-reconstruction.jpg" alt="Full Mouth Reconstruction" class="img-fluid">
                            </div>
                            <p class="card-text">Comprehensive treatment to restore function and aesthetics for complex dental issues.</p>
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
                    <h5 class="modal-title fw-bold" id="getServiceModalLabel">Request Specialized Service</h5>
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
                                <option value="root-canal">Root Canal Treatment</option>
                                <option value="dental-implants">Dental Implants</option>
                                <option value="invisalign">Invisalign Treatment</option>
                                <option value="veneers">Porcelain Veneers</option>
                                <option value="periodontal">Periodontal Treatment</option>
                                <option value="reconstruction">Full Mouth Reconstruction</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Additional Information</label>
                            <textarea class="form-control" rows="3" placeholder="Please describe your dental concerns or questions..."></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="consultationCheck">
                            <label class="form-check-label" for="consultationCheck">I would like a free initial consultation</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Request Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Our Specialized Services Section -->
    <section class="why-choose-section py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Why Choose Our Specialized Dental Care</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="feature text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-award fs-1 text-primary"></i>
                        </div>
                        <h4>Expert Specialists</h4>
                        <p>Our team consists of board-certified specialists with advanced training in their respective fields.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-gear fs-1 text-primary"></i>
                        </div>
                        <h4>Advanced Technology</h4>
                        <p>We utilize state-of-the-art equipment and techniques for precise diagnosis and effective treatment.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-heart fs-1 text-primary"></i>
                        </div>
                        <h4>Personalized Care</h4>
                        <p>Every treatment plan is tailored to your specific needs for optimal results and comfort.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item mb-3 border rounded-3 shadow-sm" data-aos="fade-up">
                    <h3 class="accordion-header">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How long does a root canal treatment take?
                        </button>
                    </h3>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            A root canal treatment typically takes 1-2 appointments, with each session lasting 60-90 minutes depending on the complexity of the case and the tooth being treated.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 2 -->
                <div class="accordion-item mb-3 border rounded-3 shadow-sm" data-aos="fade-up">
                    <h3 class="accordion-header">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Are dental implants painful?
                        </button>
                    </h3>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Most patients report that the procedure is much less uncomfortable than they expected. We use local anesthesia during the procedure, and patients typically experience only mild discomfort afterward that can be managed with over-the-counter pain medications.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 3 -->
                <div class="accordion-item mb-3 border rounded-3 shadow-sm" data-aos="fade-up">
                    <h3 class="accordion-header">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            How long does Invisalign treatment take?
                        </button>
                    </h3>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            The duration of Invisalign treatment varies depending on the complexity of your case. On average, treatment takes 12-18 months, but some cases may see results in as little as 6 months, while more complex cases may take longer.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 4 -->
                <div class="accordion-item mb-3 border rounded-3 shadow-sm" data-aos="fade-up">
                    <h3 class="accordion-header">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            How long do porcelain veneers last?
                        </button>
                    </h3>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            With proper care and maintenance, porcelain veneers can last 10-15 years or even longer. Regular dental check-ups and good oral hygiene habits are essential for extending the lifespan of your veneers.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section py-5 bg-primary text-white text-center" data-aos="fade-up">
        <div class="container">
            <h2 class="fw-bold mb-4" data-aos="zoom-in">Ready to Transform Your Smile?</h2>
            <p class="lead mb-4" data-aos="fade-up">Schedule your consultation today and discover the perfect specialized treatment for your dental needs.</p>
            <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#getServiceModal" data-aos="fade-up">Book Consultation</button>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"></script>
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
</html>