<!-- Footer Section -->
<footer class="footer-section py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <!-- About Us Column -->
      <div class="col">
        <h5 class="fw-bold mb-3">About Us</h5>
        <p class="text-muted">Dental Care provides top-quality care services for oral health.</p>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="Learn more about our mission">Our Mission</a></li>
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="Meet our team">Our Team</a></li>
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="Explore career opportunities">Careers</a></li>
        </ul>
      </div>

      <!-- Services Column -->
      <div class="col">
        <h5 class="fw-bold mb-3">Our Services</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="Home care services">Home Care</a></li>
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="Medical assistance services">Basic Services</a></li>
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="Companion care services">Specialized Services</a></li>
        </ul>
      </div>

      <!-- Contact Us Column -->
      <div class="col">
        <h5 class="fw-bold mb-3">Contact Us</h5>
        <ul class="list-unstyled">
          <li><i class="bi bi-geo-alt-fill me-2"></i>123 Main St, Anytown, Philippines</li>
          <li><i class="bi bi-telephone-fill me-2"></i>(123) 456-7890</li>
          <li><i class="bi bi-envelope-fill me-2"></i><a href="mailto:info@eldcare.com" class="text-decoration-none text-muted">info@dentalcare.com</a></li>
        </ul>
      </div>

      <!-- Social Media Column -->
      <div class="col">
        <h5 class="fw-bold mb-3">Follow Us</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted d-flex align-items-center" data-bs-toggle="tooltip" title="Facebook">
            <img src="https://img.icons8.com/fluency/20/facebook.png" class="me-2" alt="Facebook">Facebook</a></li>
          <li><a href="#" class="text-decoration-none text-muted d-flex align-items-center" data-bs-toggle="tooltip" title="Twitter">
            <img src="https://img.icons8.com/fluency/20/twitter.png" class="me-2" alt="Twitter">Twitter</a></li>
          <li><a href="#" class="text-decoration-none text-muted d-flex align-items-center" data-bs-toggle="tooltip" title="Instagram">
            <img src="https://cdn1.iconfinder.com/data/icons/social-circle-3/32/instagram_circle-512.png" class="me-2" alt="Instagram" style="width: 20px;">Instagram</a></li>
          <li><a href="#" class="text-decoration-none text-muted d-flex align-items-center" data-bs-toggle="tooltip" title="LinkedIn">
            <img src="https://img.icons8.com/fluency/20/linkedin.png" class="me-2" alt="LinkedIn">LinkedIn</a></li>
        </ul>
      </div>

      <!-- Legal & Policies Column -->
      <div class="col">
        <h5 class="fw-bold mb-3">Legal & Policies</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#termsServiceModal">Terms of Service</a></li>
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#ethicsModal">Code of Ethics</a></li>
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#privacyModal">Data Privacy</a></li>
          
          <li><a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal" data-bs-target="#manualModal">User Manual</a></li>
        </ul>
      </div>
    </div>

    <!-- Copyright -->
    <div class="row mt-4">
      <div class="col text-center">
        <p class="text-muted">&copy; 2023 Eld Care. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>









<div class="modal fade" id="termsServiceModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms of Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: justify;">
      <p><strong>Effective Date:</strong></p>
Date: <span id="datetime"></span>
<script>
  var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
</script>
</p>
        
        <p>Welcome to the <strong>E/Care Dental Clinic Online Appointment Management System</strong>. 
        By accessing, browsing, or using any part of this platform, you acknowledge that you have read, understood, and agreed to comply with these Terms of Service.</p>

        <h6>1. Purpose of the System</h6>
        <p>The system is intended solely for scheduling dental appointments within the services offered by <strong>E/Care Dental Clinic</strong>. Any other use outside this purpose is prohibited.</p>

        <h6>2. User Responsibilities</h6>
        <ul>
          <li><strong>Accurate Information:</strong> Users must provide accurate, complete, and updated information when registering and booking appointments.</li>
          <li><strong>Account Security:</strong> Users are responsible for maintaining the confidentiality of their account credentials.</li>
          <li><strong>Notification of Breaches:</strong> Users must immediately notify administrators in case of unauthorized access or security breaches.</li>
        </ul>

        <h6>3. Service Availability and Modifications</h6>
        <p>E/Care Dental Clinic reserves the right to modify, suspend, or discontinue any part of the service, with or without prior notice. Accounts and appointments may be canceled if user conduct violates these Terms.</p>

        <h6>4. Communication and Consent</h6>
        <p>By using the system, you consent to receive electronic communications related to appointments, system updates, and services.</p>

        <h6>5. Privacy Policy</h6>
        <p>Personal information collected through the system is handled according to our Privacy Policy. [Link if available]</p>

        <h6>6. Prohibited Activities</h6>
        <ul>
          <li>Using the system for fraudulent, illegal, or unauthorized purposes</li>
          <li>Attempting to access other users' data or breaching system security</li>
          <li>Disrupting the normal operations of the system</li>
        </ul>

        <h6>7. Intellectual Property</h6>
        <p>All content and materials in the system belong to <strong>E/Care Dental Clinic</strong>. Unauthorized use is prohibited.</p>

        <h6>8. Limitation of Liability</h6>
        <p>E/Care Dental Clinic is not liable for damages arising from the use or inability to use the system, unauthorized access, or unforeseen events like cyberattacks.</p>

        <h6>9. Changes to Terms</h6>
        <p>These Terms of Service may be updated periodically. Continued use after updates means acceptance of the new Terms.</p>

        <h6>10. Governing Law</h6>
        <p>These Terms are governed by the laws of the <strong>Republic of the Philippines</strong>. Disputes will be handled by the courts of [Insert Location].</p>

        <h6>Contact Us</h6>
        <p>Email: [Insert Clinic Email] <br>
        Phone: [Insert Clinic Phone Number]</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Code of Ethics Modal -->
<div class="modal fade" id="ethicsModal" tabindex="-1" aria-labelledby="ethicsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ethicsModalLabel">IT Code of Ethics for IT Professionals</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: justify;">
        <h6>1. Ethical Principles Based on Ethical Frameworks</h6>
        <p><strong>Integrity and Honesty:</strong> IT professionals must uphold truthfulness, transparency, and accountability in all actions and decisions. Users must be clearly informed about how their data is collected, used, and protected. Any mistakes or system failures must be promptly reported and resolved, rather than concealed.</p>
        <p>As custodians of sensitive data and critical systems, IT professionals must maintain the accuracy, reliability, and security of the information under their care. Deception, misrepresentation, or manipulation of data, software, or systems for personal gain or to mislead others is strictly prohibited.</p>
        <p><strong>Respect for Privacy:</strong></p>
        <ul>
          <li>Ensuring the confidentiality of all digital records.</li>
          <li>Employing robust security protocols to safeguard sensitive information.</li>
        </ul>
        <p><strong>Fairness and Justice:</strong> Ethical decision-making must be based on fairness, equal access, and respect for all individuals. IT professionals must treat users, clients, and stakeholders impartially, ensuring inclusivity and equal opportunities for all.</p>
        <p><strong>Responsibility:</strong> IT professionals are accountable for the consequences of their actions in the design, development, and implementation of IT systems. They must ensure that technology serves ethical and legal purposes and does not cause harm to individuals or society.</p>
        <p><strong>Professional Competence:</strong></p>
        <ul>
          <li>Clearly communicating system capabilities and limitations to clients and stakeholders.</li>
          <li>Staying updated with technological advancements and cybersecurity best practices.</li>
        </ul>

        <h6 class="mt-4">2. Ethical Obligations to Customers</h6>
        <p><strong>Transparency:</strong> Clearly communicate policies, terms, and conditions related to digital services to ensure user understanding and build trust.</p>
        <p><strong>Data Protection:</strong></p>
        <ul>
          <li>Implement data encryption, access controls, and secure storage methods.</li>
          <li>Use explicit consent mechanisms for data collection and usage.</li>
          <li>Comply with regulations such as HIPAA and local data protection laws.</li>
        </ul>
        <p><strong>User Support:</strong> Provide responsive customer support to address technical issues and concerns promptly.</p>
        <p><strong>User Consent:</strong> Obtain explicit consent before collecting, using, or sharing personal data.</p>
        <p><strong>Accessibility and Inclusivity:</strong> Ensure digital platforms are accessible to all users by following established accessibility standards.</p>

        <h6 class="mt-4">3. Legal Compliance</h6>
        <p><strong>Data Privacy Laws:</strong> Adhere to the Philippine Data Privacy Act of 2012 (RA 10173) and other relevant regulations.</p>
        <p><strong>Intellectual Property:</strong> Respect copyrights, patents, and software licenses, and avoid software piracy or unauthorized usage of technologies.</p>
        <p><strong>Consumer Protection:</strong> Provide accurate information, transparent pricing, and avoid misleading advertising.</p>
        <p><strong>Cybersecurity:</strong> Implement strong security measures, conduct regular audits, and prevent data breaches and cyberattacks.</p>

        <h6 class="mt-4">4. Terms and Conditions</h6>
        <p>Ensure digital services include clear terms covering:</p>
        <ul>
          <li>User responsibilities and prohibited activities.</li>
          <li>Limitations of liability for service providers.</li>
          <li>Policies on refunds, cancellations, and rescheduling.</li>
          <li>Privacy policies on data collection and usage.</li>
          <li>Dispute resolution processes and applicable jurisdiction.</li>
        </ul>

        <h6 class="mt-4">5. Public Relations Strategy</h6>
        <p><strong>Reputation Management:</strong> Engage professionally with users and stakeholders, and respond promptly to feedback.</p>
        <p><strong>Transparency:</strong> Regularly update stakeholders on system improvements and security measures.</p>
        <p><strong>Community Engagement:</strong> Promote digital literacy and data privacy awareness through educational initiatives.</p>
        <p><strong>Crisis Management:</strong> Establish clear protocols for handling security breaches or service disruptions to ensure quick recovery.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Data Privacy Policy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="dataPrivacyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataPrivacyModalLabel">Data Privacy Policy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2>Data Privacy Policy</h2>
        <p>At <strong>E/Care Dental Clinic</strong>, we recognize the importance of protecting your personal information. This Data Privacy Policy outlines how we collect, use, disclose, and safeguard your data when you use our Online Appointment Management System, in compliance with Republic Act No. 10173, otherwise known as the Data Privacy Act of 2012 of the Philippines.</p>

        <h3>1. Collection of Information</h3>
        <p>We collect only the essential information needed to provide you with our services. This may include, but is not limited to, your full name, contact number, email address, preferred appointment date and time, and selected dental services.</p>

        <h3>2. Purpose of Data Collection</h3>
        <p>The personal data collected is used solely for the following purposes:</p>
        <ul>
          <li>Scheduling and managing dental appointments</li>
          <li>Sending appointment confirmations and reminders</li>
          <li>Improving the quality of our services</li>
          <li>Maintaining internal records</li>
          <li>Communicating important updates regarding your dental care</li>
        </ul>

        <h3>3. Data Protection Measures</h3>
        <p>We implement appropriate organizational, physical, and technical security measures to protect your personal data. All information is securely stored in encrypted databases accessible only to authorized personnel. We ensure the confidentiality, integrity, and availability of your personal information against unauthorized access, disclosure, alteration, or destruction.</p>

        <h3>4. Sharing and Disclosure</h3>
        <p>We do not sell, distribute, or lease your personal information to third parties unless we have your explicit permission or are required by law to do so. In certain cases, your information may be disclosed to service providers who assist in operational activities, under strict confidentiality agreements and with full compliance to the Data Privacy Act.</p>

        <h3>5. User Rights</h3>
        <p>You have the following rights regarding your personal data, as provided under the Data Privacy Act of 2012:</p>
        <ul>
          <li>The right to be informed of how your personal data will be processed</li>
          <li>The right to access the personal data we hold about you</li>
          <li>The right to correct inaccurate or incomplete data</li>
          <li>The right to object to data processing under certain conditions</li>
          <li>The right to request the deletion or suspension of your data, subject to legal and regulatory requirements</li>
        </ul>
        <p>Requests may be made by contacting our Data Protection Officer through the contact information provided on our website.</p>

        <h3>6. Retention Period</h3>
        <p>Your personal information will be retained only as long as necessary for the fulfillment of the purposes stated in this policy, or as required by applicable laws and regulations. Upon fulfillment of the purpose or the lapse of the required retention period, your data will be securely deleted or anonymized.</p>

        <h3>7. Updates to the Policy</h3>
        <p>We may update this Data Privacy Policy from time to time to reflect changes in relevant laws, regulations, or our practices. We encourage you to periodically review this page to stay informed about how we protect your information.</p>

        <p>For questions or concerns regarding this policy or the handling of your personal data, please contact Us.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  
</div>



<!-- User Manual Modal -->
<div class="modal fade" id="manualModal" tabindex="-1" aria-labelledby="manualModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="manualModalLabel">User Manual</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Welcome to Dental Care, a simple and easy-to-use platform for scheduling and managing appointments. Whether you're a dentist, clinic staff, or a patient, this system helps you book, view, and keep track of appointments quickly and easily. It's designed to save time and make appointment management smooth for everyone.</p>
        <br>
        <p>This manual provides a step-by-step guide on how to:</p>
        <p> - Navigate the system interface </p>
        <p> - Create and manage appointments </p>
        <p> - Forgot Password </p>
        <p> - Registered </p>
        <br>
        <h4>Getting Started</h4>
        <p> This section helps you begin using the Dental Care Appointment System. </p>
        <h4> What You Need </h4>
        <p> Use a modern browser like Chrome, Firefox, or Edge </p>
        <p> Make sure you're connected to the internet </p>
        <h4> Open the Website </h4>
        <p> Go to the homepage
        (example: http://localhost/web-proto/#home) </p>

        <h4> Log In </h4>
        <p> Click “Login” to go to your dashboard </p>
        <img src="pictures/login.jpg" alt="Login Image" width="460" height="390">
        <p> Enter your email and password </p>
        <p> Click “Login”  </p>
        <img src="pictures/login1.jpg" alt="Login Image" width="460" height="390">

        <h4> Create an Account (For Patients) </h4>
        <p> Click “Create a new account” </p>
        <p> Fill in your Firstname,Lastname, email, and password </p>
        <img src="pictures/Create an Account.jpg" alt="Create account Image" width="460" height="390">
        <br>
        <br>
        <p> Click “Create Account” </p>
        <p> After signing up, you’ll go to the Login page </p>

        <h4> Forgot Your Password? </h4>
        <p> On the Login page, click “Forgot Password?” </p>
        <img src="pictures/Forgot Password.jpg" alt="Forgot Image" width="460" height="390">
        <p> Enter your registered email  </p>
        <img src="pictures/fpass.png" alt="Forgot Image" width="460" height="390">
        <p> Check your email for a password reset link </p>
        <img src="pictures/mail.png" alt="Forgot Image" width="460" height="390">
        <p> Follow the instructions to create a new password </p>

        <h4> Services </h4> 
        <p> You can view and select from different types of dental services when booking: </p>
        <h4> Basic Services: </h4>
        <img src="pictures/services.jpg" alt="services Image" width="460" height="390">
        <p> Include cleaning, tooth filings, braces, teeth whitening, tooth extraction, X-ray and diagnostic services. </p>
        <h4> Specialized Services: </h4>
        <img src="pictures/servicesSpecialized.jpg" alt="services Image" width="460" height="390">
        <p> Include root canal treatment, dental implants, Invisalign treatment, porcelain veneers, periodontal treatment, and full mouth Reconstruction </p> 
        <h4> All Services: </h4>
        <p> A full list combining both basic and specialized services — you can browse and choose what fits your needs </p>
        <h4> Request Appointment (Homepage Form) </h4>
        <p> You can quickly request an appointment directly from the homepage without logging in: </p>
        <p> Go to the allservices and scroll down to the “Request Appointment” section </p>
        <img src="pictures/Appointment.jpg" alt="Appointment Image" width="500" height="350">
        <p> Once submitted, your request will be reviewed by the dental office. They may contact you to confirm your schedule. </p>
        <h4> About </h4>
        <p> The About section explains who we are and what we do. </p>
        <p> It usually includes: </p>
        <p> A short introduction to the dental clinic </p>
        <p> Our mission and commitment to patient care </p>
        <p> Background of the team or dental professionals </p>
        <p> FAQ </p>
        <img src="pictures/faq.jpg" alt="faq Image" width="500" height="350">
        <br>
        <br>
        <p> Visit this page to learn more about the clinic’s values and services. </p>

        <h4> Contact </h4>
        <p> You can find contact details on the Contact page: </p>
        <p> Phone Number – Call us to ask questions or confirm appointments </p>
        <p> Email Address – Send inquiries or follow-ups </p>
        <p> Clinic Address – View our location and working hours </p>
        <p> Map or Directions – Get directions if visiting in person </p>
        <img src="pictures/contact.jpg" alt="Contact Image" width="500" height="350">
        <br>
        <br>
        <p> There may also be a simple contact form for sending a quick message. </p>
       

      </div>
    </div>
  </div>
</div>


<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Initialize Tooltips -->
<script>
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
</script>