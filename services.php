<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complete Dental Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="interactions/style.css">
</head>
<body>
    
    <!-- Navbar -->
    <?php include 'topNavbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section general-hero d-flex flex-column justify-content-center align-items-center text-center" id="hero" data-aos="fade-up">
        <h1 class="display-4 fw-bold" data-aos="zoom-in">Complete Dental Services</h1>
        <p class="lead" data-aos="fade-up">Comprehensive dental care for every smile at every stage of life.</p>
        <div data-aos="fade-up">
            <a href="#services-overview" class="btn btn-primary btn-lg">Explore Services</a>
            <a href="#appointment" class="btn btn-outline-light btn-lg ms-2">Book Appointment</a>
        </div>
    </section>

    <!-- Services Overview Section -->
    <section class="services-overview py-5" id="services-overview" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Our Comprehensive Services</h2>
            <p class="text-center mb-5 lead" data-aos="fade-up">We offer a complete range of dental services to meet all your oral health needs in one location.</p>
            
            <div class="row g-4 mb-5">
                <!-- Basic Services Card -->
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="service-icon mb-3">
                                <i class="bi bi-heart-pulse fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title fw-bold">Basic Dental Services</h3>
                            <p class="card-text">Essential treatments and preventive care for maintaining optimal oral health.</p>
                            <ul class="list-unstyled text-start">
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Tooth Fillings</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Tooth Extraction</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Teeth Cleaning</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>X-ray and Diagnostic Services</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Braces</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Teeth Whitening</li>
                            </ul>
                            <a href="basic-services.php" class="btn btn-primary mt-3">View Basic Services</a>
                        </div>
                    </div>
                </div>
                
                <!-- Specialized Services Card -->
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="service-icon mb-3">
                                <i class="bi bi-stars fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title fw-bold">Specialized Dental Services</h3>
                            <p class="card-text">Advanced treatments for complex dental issues and cosmetic enhancements.</p>
                            <ul class="list-unstyled text-start">
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Root Canal Treatment</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Dental Implants</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Invisalign Treatment</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Porcelain Veneers</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Periodontal Treatment</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Full Mouth Reconstruction</li>
                            </ul>
                            <a href="specialized-services.php" class="btn btn-primary mt-3">View Specialized Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Approach Section -->
    <section class="our-approach py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Our Approach to Dental Care</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="approach-card text-center p-4">
                        <div class="approach-icon mb-3">
                            <i class="bi bi-shield-check fs-1 text-primary"></i>
                        </div>
                        <h4>Preventive Care</h4>
                        <p>We focus on preventing dental issues before they start through regular check-ups, cleanings, and patient education.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="approach-card text-center p-4">
                        <div class="approach-icon mb-3">
                            <i class="bi bi-tools fs-1 text-primary"></i>
                        </div>
                        <h4>Restorative Excellence</h4>
                        <p>When treatment is needed, we use the latest techniques and materials to restore your teeth to optimal function and appearance.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="approach-card text-center p-4">
                        <div class="approach-icon mb-3">
                            <i class="bi bi-emoji-smile fs-1 text-primary"></i>
                        </div>
                        <h4>Cosmetic Artistry</h4>
                        <p>We combine science and artistry to create beautiful smiles that enhance your natural features and boost confidence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services Carousel -->
    <section class="featured-services py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Featured Services</h2>
            <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded-4 shadow">
                    <div class="carousel-item active">
                        <img src="https://cdn-ilahmol.nitrocdn.com/fzTBLMVYFyNXrnAMnqhxQvIhscuElgWS/assets/images/optimized/rev-3dbf601/puredentalhealth.co.uk/wp-content/uploads/what-is-a-dental-implant.jpg" class="d-block w-100" alt="Dental Implants">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h3>Dental Implants</h3>
                            <p>The gold standard for tooth replacement, providing a permanent solution that looks and functions like natural teeth.</p>
                            <a href="specialized-services.php#dental-implants" class="btn btn-primary btn-sm">Learn More</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://www.mapledentalhealth.com/media/cache/blog/post/invisalign_OdgNeS7.jpg.874x364_q85_box-0%2C250%2C2213%2C1170_crop_detail.jpg" class="d-block w-100" alt="Invisalign">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h3>Invisalign Treatment</h3>
                            <p>Straighten your teeth discreetly with clear aligners that are comfortable and removable.</p>
                            <a href="specialized-services.php#invisalign" class="btn btn-primary btn-sm">Learn More</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://ih-sad.wp02.ihealthspot.com/wp-content/uploads/sites/592/2020/03/Teeth-Whitening.jpg" class="d-block w-100" alt="Teeth Whitening">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
                            <h3>Professional Teeth Whitening</h3>
                            <p>Achieve a brighter, whiter smile with our safe and effective whitening treatments.</p>
                            <a href="basic-services.php#teeth-whitening" class="btn btn-primary btn-sm">Learn More</a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Patient Journey Section -->
    <section class="patient-journey py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Your Patient Journey</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="timeline">
                        <div class="timeline-item" data-aos="fade-up">
                            <div class="timeline-icon bg-primary text-white">1</div>
                            <div class="timeline-content p-4 shadow-sm rounded-3 bg-white">
                                <h4>Initial Consultation</h4>
                                <p>We begin with a comprehensive examination and discuss your dental concerns, goals, and medical history.</p>
                            </div>
                        </div>
                        <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="timeline-icon bg-primary text-white">2</div>
                            <div class="timeline-content p-4 shadow-sm rounded-3 bg-white">
                                <h4>Diagnosis & Treatment Planning</h4>
                                <p>Based on your examination, we create a personalized treatment plan addressing your specific needs.</p>
                            </div>
                        </div>
                        <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="timeline-icon bg-primary text-white">3</div>
                            <div class="timeline-content p-4 shadow-sm rounded-3 bg-white">
                                <h4>Treatment Implementation</h4>
                                <p>We perform the agreed-upon treatments with a focus on your comfort and the highest quality care.</p>
                            </div>
                        </div>
                        <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="timeline-icon bg-primary text-white">4</div>
                            <div class="timeline-content p-4 shadow-sm rounded-3 bg-white">
                                <h4>Follow-up & Maintenance</h4>
                                <p>We schedule follow-up appointments and provide guidance on maintaining your oral health long-term.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Insurance & Payment Section -->
    <section class="insurance-payment py-5" data-aos="fade-up">
        <div class="container">
        <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Insurance & Payment Options</h2>
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-shield-check fs-1 text-primary"></i>
                                <h3 class="card-title fw-bold mt-3">Insurance Coverage</h3>
                            </div>
                            <p>We accept most major dental insurance plans and will help you maximize your benefits.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle text-primary me-2"></i>In-network with many providers</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Insurance verification before treatment</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Assistance with claims submission</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Explanation of benefits</li>
                            </ul>
                            <a href="insurance.php" class="btn btn-outline-primary mt-3">View Accepted Insurance</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-credit-card fs-1 text-primary"></i>
                                <h3 class="card-title fw-bold mt-3">Payment Options</h3>
                            </div>
                            <p>We offer flexible payment solutions to make quality dental care accessible to everyone.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Cash, credit, and debit cards</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Flexible payment plans</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>CareCredit financing options</li>
                                <li><i class="bi bi-check-circle text-primary me-2"></i>Health Savings Account (HSA)</li>
                            </ul>
                            <a href="payment-options.php" class="btn btn-outline-primary mt-3">Learn About Payment Plans</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Appointment Section -->
    <section class="appointment-section py-5 bg-primary text-white" id="appointment" data-aos="fade-up">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="fw-bold mb-4">Book Your Appointment Today</h2>
                    <p class="lead">Take the first step toward your healthiest smile. Our friendly team is ready to provide you with exceptional dental care.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Convenient scheduling options</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Same-day emergency appointments available</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Evening and weekend hours</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Comfortable, modern facilities</li>
                    </ul>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="tel:+1234567890" class="btn btn-light"><i class="bi bi-telephone me-2"></i>Call Us</a>
                        <a href="book-appointment.php" class="btn btn-outline-light"><i class="bi bi-calendar-check me-2"></i>Book Online</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 rounded-4 shadow">
                        <div class="card-body p-4">
                            <h3 class="card-title text-primary fw-bold text-center mb-4">Request Appointment</h3>
                            <form action="process-appointment.php" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                                            <label for="firstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                                            <label for="lastName">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="serviceType" name="serviceType" required>
                                        <option value="" selected disabled>Select a service</option>
                                        <option value="General Checkup">General Checkup</option>
                                        <option value="Teeth Cleaning">Teeth Cleaning</option>
                                        <option value="Teeth Whitening">Teeth Whitening</option>
                                        <option value="Dental Implants">Dental Implants</option>
                                        <option value="Invisalign">Invisalign</option>
                                        <option value="Other">Other (please specify)</option>
                                    </select>
                                    <label for="serviceType">Type of Service</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" name="message" placeholder="Additional Information" style="height: 100px"></textarea>
                                    <label for="message">Additional Information</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-3">Submit Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">What Our Patients Say</h2>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="testimonial-card p-4 shadow-sm rounded-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="testimonial-avatar me-3">
                                <img src="images/avatar-1.jpg" alt="Patient" class="rounded-circle" width="60" height="60">
                            </div>
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <small class="text-muted">Invisalign Patient</small>
                            </div>
                        </div>
                        <div class="testimonial-rating text-warning mb-3">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"I couldn't be happier with my Invisalign treatment! The entire process was so much easier than I expected, and the results are amazing. The staff was always helpful and made me feel comfortable at every visit."</p>
                    </div>
                </div>
                
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card p-4 shadow-sm rounded-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="testimonial-avatar me-3">
                                <img src="images/avatar-2.jpg" alt="Patient" class="rounded-circle" width="60" height="60">
                            </div>
                            <div>
                                <h5 class="mb-0">Michael Thompson</h5>
                                <small class="text-muted">Dental Implant Patient</small>
                            </div>
                        </div>
                        <div class="testimonial-rating text-warning mb-3">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"After years of being embarrassed about my missing tooth, I finally got a dental implant. The procedure was much less painful than I feared, and now I can smile with confidence again. Thank you for your exceptional care!"</p>
                    </div>
                </div>
                
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card p-4 shadow-sm rounded-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="testimonial-avatar me-3">
                                <img src="images/avatar-3.jpg" alt="Patient" class="rounded-circle" width="60" height="60">
                            </div>
                            <div>
                                <h5 class="mb-0">Emily Rodriguez</h5>
                                <small class="text-muted">Regular Checkup Patient</small>
                            </div>
                        </div>
                        <div class="testimonial-rating text-warning mb-3">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="testimonial-text">"I've been coming here for regular checkups for years, and I always have a great experience. The hygienists are thorough but gentle, and the dentists take time to explain everything. My whole family trusts this practice!"</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4" data-aos="fade-up">
                <a href="testimonials.php" class="btn btn-outline-primary">Read More Patient Stories</a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="zoom-in">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3" data-aos="fade-up">
                            <h3 class="accordion-header">
                                <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How often should I visit the dentist?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    For most patients, we recommend checkups and cleanings every six months. However, some patients may need more frequent visits depending on their specific dental health needs. During your initial consultation, we'll establish a personalized care schedule.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3" data-aos="fade-up">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Do you offer emergency dental services?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer same-day emergency appointments for our patients experiencing dental pain or trauma. Call our office immediately, and we'll do our best to see you as soon as possible to address your dental emergency.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3" data-aos="fade-up">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    How long does Invisalign treatment take?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The length of Invisalign treatment varies depending on the complexity of your case. On average, treatment takes about 12-18 months. During your consultation, we can provide a more specific timeline based on your individual needs.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3" data-aos="fade-up">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    What payment options do you accept?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We accept most major credit cards, cash, and personal checks. We also work with several dental insurance providers and offer financing options through CareCredit. Our front desk staff would be happy to discuss payment options in detail during your visit.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3" data-aos="fade-up">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Are dental implants right for me?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Dental implants are an excellent solution for many patients with missing teeth. However, the suitability depends on factors such as bone density, overall health, and oral hygiene habits. During a consultation, we can evaluate your specific case and discuss whether implants are the right option for you.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-3" data-aos="fade-up">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                    How long do dental crowns last?
                                </button>
                            </h3>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    With proper care and maintenance, dental crowns can last 10-15 years or even longer. Regular checkups, good oral hygiene, and avoiding habits like teeth grinding can help extend the life of your crown. We use high-quality materials and precise techniques to ensure the longevity of all our dental restorations.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4" data-aos="fade-up">
                        <a href="faq.php" class="btn btn-outline-primary">View All FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section py-5 bg-primary text-white text-center" data-aos="fade-up">
        <div class="container">
            <h2 class="fw-bold mb-4" data-aos="zoom-in">Ready to Transform Your Smile?</h2>
            <p class="lead mb-4" data-aos="fade-up">Schedule your appointment today and take the first step toward optimal dental health.</p>
            <div class="d-flex justify-content-center flex-wrap gap-3" data-aos="fade-up">
                <a href="book-appointment.php" class="btn btn-light btn-lg">Book Appointment</a>
                <a href="contact.php" class="btn btn-outline-light btn-lg">Contact Us</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
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