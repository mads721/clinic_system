<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Team | Complete Dental Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="interactions/style.css">
</head>
<body>
    
    <!-- Navbar -->
    <?php include 'topNavbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section team-hero d-flex flex-column justify-content-center align-items-center text-center" id="hero" data-aos="fade-up">
        <h1 class="display-4 fw-bold text-white" data-aos="zoom-in">Meet Our Development Team</h1>
        <p class="lead text-white" data-aos="fade-up">The talented individuals behind our dental practice website</p>
    </section>

    <!-- Team Section -->
    <section class="team-section py-5" data-aos="fade-up">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="subtitle text-primary fw-bold">OUR EXPERTS</span>
                    <h2 class="display-5 fw-bold">The Developers</h2>
                    <div class="divider mx-auto my-3"></div>
                    <p class="lead">Meet the talented team that designed and developed our dental practice website, combining technical expertise with a passion for creating exceptional user experiences.</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Team Member 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-card h-100 rounded-4 shadow-sm overflow-hidden">
                        <div class="team-image position-relative">
                            <img src="pictures/mads.png" alt="John Doe" class="img-fluid w-100">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info p-4">
                            <h3 class="fw-bold mb-1">Maderick Vipinosa</h3>
                            <p class="text-primary mb-3">Lead Developer</p>
                            <p>Responsible for the overall architecture and back-end development of our website, ensuring security and performance.</p>
                            <div class="skills mt-3">
                                <span class="badge bg-light text-dark me-1">PHP</span>
                                <span class="badge bg-light text-dark me-1">MySQL</span>
                                <span class="badge bg-light text-dark me-1">JavaScript</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-card h-100 rounded-4 shadow-sm overflow-hidden">
                        <div class="team-image position-relative">
                            <img src="pictures/rhea.jpg" alt="Jane Smith" class="img-fluid w-100">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info p-4">
                            <h3 class="fw-bold mb-1">Rhea Jean Turbanada</h3>
                            <p class="text-primary mb-3">UI/UX Designer</p>
                            <p>Created the user interface design and experience, ensuring the website is both beautiful and functional for all users.</p>
                            <div class="skills mt-3">
                                <span class="badge bg-light text-dark me-1">Figma</span>
                                <span class="badge bg-light text-dark me-1">HTML/CSS</span>
                                <span class="badge bg-light text-dark me-1">Bootstrap</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-card h-100 rounded-4 shadow-sm overflow-hidden">
                        <div class="team-image position-relative">
                            <img src="pictures/alver.png" alt="Mark Johnson" class="img-fluid w-100">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info p-4">
                            <h3 class="fw-bold mb-1">Alver</h3>
                            <p class="text-primary mb-3">Front-End Developer</p>
                            <p>Implemented the interactive elements and responsive design, ensuring a seamless experience across all devices.</p>
                            <div class="skills mt-3">
                                <span class="badge bg-light text-dark me-1">JavaScript</span>
                                <span class="badge bg-light text-dark me-1">CSS3</span>
                                <span class="badge bg-light text-dark me-1">jQuery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="team-card h-100 rounded-4 shadow-sm overflow-hidden">
                        <div class="team-image position-relative">
                            <img src="pictures/ren.jpg  " alt="Sarah Williams" class="img-fluid w-100">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info p-4">
                            <h3 class="fw-bold mb-1">Antoine Henry Mijares</h3>
                            <p class="text-primary mb-3">Database Architect</p>
                            <p>Designed and implemented the database structure to securely store patient and appointment information.</p>
                            <div class="skills mt-3">
                                <span class="badge bg-light text-dark me-1">SQL</span>
                                <span class="badge bg-light text-dark me-1">Database Design</span>
                                <span class="badge bg-light text-dark me-1">API Integration</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="team-card h-100 rounded-4 shadow-sm overflow-hidden">
                        <div class="team-image position-relative">
                            <img src="pictures/joel.png" alt="Alex Chen" class="img-fluid w-100">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info p-4">
                            <h3 class="fw-bold mb-1">Joel Bermudez</h3>
                            <p class="text-primary mb-3">QA & Testing</p>
                            <p>Ensured the website functions perfectly across all browsers and devices, with rigorous testing protocols.</p>
                            <div class="skills mt-3">
                                <span class="badge bg-light text-dark me-1">Testing</span>
                                <span class="badge bg-light text-dark me-1">Automation</span>
                                <span class="badge bg-light text-dark me-1">Debugging</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="team-card h-100 rounded-4 shadow-sm overflow-hidden">
                        <div class="team-image position-relative">
                            <img src="pictures/brent.jpg" alt="Lisa Rodriguez" class="img-fluid w-100 h-100">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                        <div class="team-info p-4">
                            <h3 class="fw-bold mb-1">Brent Ivan Bendal</h3>
                            <p class="text-primary mb-3">Content Strategist</p>
                            <p>Developed the content strategy and wrote engaging copy that effectively communicates our dental services.</p>
                            <div class="skills mt-3">
                                <span class="badge bg-light text-dark me-1">Content Writing</span>
                                <span class="badge bg-light text-dark me-1">SEO</span>
                                <span class="badge bg-light text-dark me-1">Marketing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Development Process Section -->
    <section class="process-section py-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-title fw-bold mb-2">Our Development Process</h2>
        <div class="title-underline"></div>
        <p class="subtitle mt-4">How we built this dental practice website from concept to completion.</p>
      </div>
    </div>

    <!-- Simple horizontal timeline with no dots -->
    <div class="row">
      <div class="col-12">
        <!-- Timeline bar -->
        <div class="timeline-bar mb-4"></div>
        
        <!-- Timeline items -->
        <div class="row timeline-items">
          <!-- Phase 1 -->
          <div class="col-md">
            <div class="timeline-box">
              <div class="icon-wrapper mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/9151/9151181.png" alt="Discovery" class="process-icon" />
              </div>
              <h4 class="step-title">Discovery & Planning</h4>
              <p class="step-text">We started by understanding the dental practice's needs, patient demographics, and business goals to create a comprehensive project plan.</p>
            </div>
          </div>
          
          <!-- Phase 2 -->
          <div class="col-md">
            <div class="timeline-box">
              <div class="icon-wrapper mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/2274/2274962.png" alt="Design" class="process-icon" />
              </div>
              <h4 class="step-title">Design & Wireframing</h4>
              <p class="step-text">Our designers created mockups and wireframes, focusing on user experience and a clean, professional aesthetic that inspires patient confidence.</p>
            </div>
          </div>
          
          <!-- Phase 3 -->
          <div class="col-md">
            <div class="timeline-box">
              <div class="icon-wrapper mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/11096/11096817.png" alt="Development" class="process-icon" />
              </div>
              <h4 class="step-title">Development</h4>
              <p class="step-text">The development team built a secure, responsive website with features like online booking, patient portals, and service information.</p>
            </div>
          </div>
          
          <!-- Phase 4 -->
          <div class="col-md">
            <div class="timeline-box">
              <div class="icon-wrapper mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/10435/10435234.png" alt="Testing" class="process-icon" />
              </div>
              <h4 class="step-title">Testing & QA</h4>
              <p class="step-text">Rigorous testing across multiple browsers and devices ensured the website works flawlessly for all users.</p>
            </div>
          </div>
          
          <!-- Phase 5 -->
          <div class="col-md">
            <div class="timeline-box">
              <div class="icon-wrapper mb-3">
                <img src="https://static.vecteezy.com/system/resources/previews/026/226/970/non_2x/website-optimization-icon-vector.jpg" alt="Launch" class="process-icon" />
              </div>
              <h4 class="step-title">Launch & Optimization</h4>
              <p class="step-text">After successfully launching the website, we continuously monitor performance and make adjustments.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    </section>
    <!-- Technologies Section -->
    <section class="technologies-section py-5" data-aos="fade-up">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold">Technologies Used</h2>
                    <div class="divider mx-auto my-3"></div>
                    <p class="lead">The modern tech stack we utilized to build this high-performance dental practice website.</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-filetype-php fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">PHP</h5>
                        <p class="small">Server-side scripting language for dynamic content and database integration.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-bootstrap fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Bootstrap 5</h5>
                        <p class="small">Frontend framework for responsive design and modern UI components.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-database fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">MySQL</h5>
                        <p class="small">Reliable database management system for secure data storage.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-braces fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">JavaScript</h5>
                        <p class="small">Client-side scripting for enhanced interactivity and user experience.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-aws fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">AWS</h5>
                        <p class="small">Cloud hosting providing scalability, reliability, and security.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-lock fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">SSL Security</h5>
                        <p class="small">Encryption for secure data transmission and patient privacy.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-speedometer2 fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Performance Optimization</h5>
                        <p class="small">Techniques for fast page load times and responsive performance.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="tech-card text-center p-4 rounded-4 shadow-sm h-100">
                        <div class="tech-icon mb-3">
                            <i class="bi bi-phone fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Mobile-First Design</h5>
                        <p class="small">Ensuring optimal experience across all devices and screen sizes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5 bg-primary text-white" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-4">Get In Touch</h2>
                    <p class="lead mb-4">Have questions about our development process or interested in working with our team? We'd love to hear from you!</p>
                    <ul class="list-unstyled contact-info">
                        <li class="mb-3"><i class="bi bi-envelope me-2"></i> development@dentalwebsite.com</li>
                        <li class="mb-3"><i class="bi bi-telephone me-2"></i> (123) 456-7890</li>
                        <li class="mb-3"><i class="bi bi-geo-alt me-2"></i> 123 Web Dev Street, Tech City, 12345</li>
                    </ul>
                    <div class="social-links mt-4">
                        <a href="#" class="btn btn-outline-light rounded-circle me-2"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2"><i class="bi bi-github"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 rounded-4 shadow">
                        <div class="card-body p-4">
                            <h3 class="card-title text-primary fw-bold text-center mb-4">Send Us a Message</h3>
                            <form action="process-contact.php" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" name="message" placeholder="Your Message" style="height: 150px" required></textarea>
                                    <label for="message">Your Message</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-3">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
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