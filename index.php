<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dental Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="interactions/style.css">

</head>
<body>
<?php
// Example: Redirect if logged in
// if (isset($_SESSION['user'])) header('Location: account-settings.php');
?>
            



<!-- Navbar -->
 <?php include 'topNavbar.php'; ?>

            <!-- Hero Section -->

<section class="hero-section d-flex flex-wrap align-items-center hero-bg" id = "home">
        <div class="col-lg-6 col-md-12 pe-4 mb-4 mb-lg-0 " data-aos="fade-right" data-aos-duration="1500">
            <img src="pictures/ai-dental.jfif" alt="Elderly Care" class="img-fluid">
        </div>
        <div class="hero-text col-lg-6 col-md-12" data-aos="fade-left" data-aos-duration="1400">
            <h1>Providing Quality Dental Healthcare</h1>
            <p>We are dedicated to offering exceptional dental care services. Book an appointment today and experience compassionate care tailored for you.</p>
            <button class="btn btn-success book-btn" data-aos="zoom-in">Book Appointment</button>
        </div>
    </section>
    
<!-- about section -->
<section id="about" class="about-section py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="about-text col-lg-6 col-md-12" data-aos="fade-right" data-aos-duration="1000">
                <div class="section-header mb-4">
                    <span class="subtitle text-primary fw-bold">Who We Are</span>
                    <h2 class="display-5 fw-bold">About Us</h2>
                    <div class="divider my-3"></div>
                </div>
                <p class="lead mb-4">We are a team of dedicated dental professionals committed to providing innovative, patient-centered dental care with the latest technology and techniques.</p>
                <p class="mb-4">With over 15 years of experience in the dental industry, our practice combines clinical excellence with compassionate care. We believe in creating lasting relationships with our patients built on trust and exceptional results.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="./services.php" class="btn btn-primary btn-lg">Our Services</a>
                    <a href="./team.php" class="btn btn-outline-primary btn-lg">Meet Our Team</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 position-relative" data-aos="fade-left" data-aos-duration="1000">
                <div class="about-image-container">
                    <img src="pictures/service-ai.jfif" alt="About Our Dental Practice" class="img-fluid rounded-4 shadow">
                    <div class="experience-badge position-absolute bg-primary text-white p-3 rounded-circle shadow-lg d-flex flex-column justify-content-center align-items-center">
                        <span class="h1 fw-bold mb-0">15+</span>
                        <span class="small">Years of Excellence</span>
                    </div>
                </div>
                <div class="stats-container mt-4 d-flex flex-wrap justify-content-between">
                    <div class="stats-item text-center px-3">
                        <h3 class="fw-bold text-primary mb-1">5000+</h3>
                        <p class="small text-muted">Happy Patients</p>
                    </div>
                    <div class="stats-item text-center px-3">
                        <h3 class="fw-bold text-primary mb-1">10+</h3>
                        <p class="small text-muted">Dental Experts</p>
                    </div>
                    <div class="stats-item text-center px-3">
                    <h3 class="fw-bold text-primary mb-1">5000+</h3>
                    <p class="small text-muted">Happy Patients</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</section>
<hr>
<!-- Services Section -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">

            <!-- Question 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                        Q: What services do you offer?
                    </button>
                </h2>
                <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A:We offer a range of dental services, including general checkups, preventive care, cosmetic dentistry, restorative treatments, orthodontics, and specialized dental care.
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        Q: How do I get started with your services?
                    </button>
                </h2>
                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: To get started, contact us through our website or by phone to schedule a consultation. We'll work with you to develop a personalized care plan that meets your needs.
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                        Q:Are your dentists trained and certified?
                    </button>
                </h2>
                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: Yes, all our dentists are highly trained, licensed, and certified professionals who undergo continuous education to provide top-quality dental care.
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                        Q: Can I customize the care plan according to my needs?
                    </button>
                </h2>
                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: Absolutely! We work with you to create a care plan that suits your specific needs and preferences.
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                        Q: What are your clinic hours?
                    </button>
                </h2>
                <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: Our dental clinic is open [insert hours], including [mention weekends or holidays if applicable], to accommodate your dental care needs.
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                        Q: Do you offer emergency or short-term care?
                    </button>
                </h2>
                <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: Yes, we provide emergency dental care for urgent issues such as severe tooth pain, broken teeth, and other immediate dental concerns.
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading7">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse7" aria-expanded="false" aria-controls="faqCollapse7">
                        Q: How can I make payments for the services?
                    </button>
                </h2>
                <div id="faqCollapse7" class="accordion-collapse collapse" aria-labelledby="faqHeading7" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: We accept various payment methods, including credit/debit cards, bank transfers, and insurance coverage (where applicable).
                    </div>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading8">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse8" aria-expanded="false" aria-controls="faqCollapse8">
                        Q: Can I change or cancel services if needed?
                    </button>
                </h2>
                <div id="faqCollapse8" class="accordion-collapse collapse" aria-labelledby="faqHeading8" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A: Yes, you can modify or cancel services at any time. Just contact our support team, and we’ll assist you with any changes.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Contact Section -->
    <section id="contact" class="contact-container">
        <div class="locations" data-aos="fade-up">
            <h1>Location:</h1>
            <p>
                <strong>Dasmariñas, Cavite:</strong><br> 
                ABC Building, Aguinaldo Highway<br> 
                Contact no.: +63 912 345 6789<br> 
                <a href="#" style="color: lightgreen;">Location Map</a>
            </p>
        </div>
        <div class="contact-form" data-aos="fade-up">
            <form>
                <h3 class="mb-3">Contact Us</h3>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" rows="3" placeholder="Type your message here..." required></textarea>
                </div>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
</section>

<!-- Footer -->
 <?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // For desktop: auto-show dropdown on hover
        const dropdowns = document.querySelectorAll('.dropdown');
        
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                if (window.innerWidth >= 992) { // Only on desktop (lg breakpoint)
                    const dropdownMenu = this.querySelector('.dropdown-menu');
                    dropdownMenu.classList.add('show');
                }
            });
            
            dropdown.addEventListener('mouseleave', function() {
                if (window.innerWidth >= 992) {
                    const dropdownMenu = this.querySelector('.dropdown-menu');
                    dropdownMenu.classList.remove('show');
                }
            });
        });
        
        // For mobile: make the dropdown toggle work normally
        const dropdownToggle = document.querySelectorAll('.dropdown-toggle');
        dropdownToggle.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle('show');
                }
            });
        });
    });
    $(document).ready(function() {
        // Check if the URL has a hash
        if (window.location.hash) {
            // Scroll to the element with the matching ID
            $('html, body').animate({
                scrollTop: $(window.location.hash).offset().top
            }, 1000);
        }
    });



</script>



<!-- login modal re-open script -->
<?php if (isset($_SESSION['login_error'])): ?>
<script>
    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    loginModal.show();
</script>
<?php endif; ?>

<?php if (isset($_SESSION['show_login_modal'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show the login modal
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        
        <?php if(isset($_SESSION['password_reset_message'])): ?>
        // Add success message to the login modal
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success mb-3';
        alertDiv.innerHTML = '<?php echo $_SESSION['password_reset_message']; ?>';
        
        // Insert before the form
        var form = document.querySelector('#loginModal form');
        if (form) {
            form.parentNode.insertBefore(alertDiv, form);
        }
        <?php endif; ?>
    });
</script>
<?php 
    // Clear the session variables
    unset($_SESSION['show_login_modal']);
    unset($_SESSION['password_reset_message']);
?>
<?php endif; ?>
</body>
</html>
