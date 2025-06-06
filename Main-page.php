<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Eye Flood System</title>

        <!-- CSS FILES -->               
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">

    </head>
    <body>
        <main>
            <nav class="navbar navbar-expand-lg">                
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="wave.png" class="navbar-brand-image img-fluid">
                        <span class="navbar-brand-text">
                            Eye Flood
                            <small>Flood Monitoring System</small>
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            
                            
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>
                        </ul>

                                       
                        <style>





/* CSS OF MODAL STARTS HERE /Modal Content */
.modal-content {
  background-color: #f8f9fa;
  margin: 15% auto; /* Adjust vertically for centering */
  padding: 20px;
  border: 1px;
  width: 80%; /* Adjust width as needed */
  max-width: 600px; /* Maximum width for responsiveness */
  overflow: auto; /* Prevent scrolling */
  position: relative; /* Required for absolute positioning */
  border: 2px solid #1D4ED8; /* Change color and width as needed */
}

/* Close Button */
.close {
  color: #aaa;
  position: absolute;
  top: 8px; /* Adjust distance from top */
  right: 25px; /* Adjust distance from right */
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
.btn{
    background-color:#1D4ED8;
}
.btn:hover {
    background-color: #1D4ED8; /* Change to your desired hover color */
}

/* Responsive Styling */
@media (max-width: 768px) {
  .modal-content {
    margin: 10% auto; /* Adjust margin for smaller screens */
    padding: 15px;
  }
}


</style>


                               <!-- Signup Button -->
                               <button type="button" class="btn btn-success" onclick="document.getElementById('signupModal').style.display='block'">Sign Up</button>

                                <!-- Signup Modal -->
                                <div id="signupModal" class="modal">
                                <div class="modal-content">
                                <span class="close" onclick="document.getElementById('signupModal').style.display='none'">&times;</span>
                                <h2>Data Privacy Notice</h2>
                                <p>Republic Act No. 10173 or known as the Data Privacy Act of 2012 and other relevant 
                                    Philippine laws that apply to the collection and processing of your personal data. 
                                    By subscribing to Eye Flood site, you allow the collection, use, and processing of your personal data.</p>


                    <!-- Registration Form -->
                    <form id="registrationForm" action="register.php" method="post"> <!--to redirect in register-->
                    <label for="agree_terms">I agree to the terms:</label>
                    <input type="checkbox" id="agree_terms" name="agree_terms" required>
                    <p>By signing up, you agree to follow our terms, privacy policy, and guidelines. You must be 15+, provide accurate info, 
            and secure your account. Illegal or abusive behavior, as well as unauthorized content use, are prohibited. 
            We respect your privacy and reserve the right to terminate accounts for violations. Updated terms apply, and your 
            continued use signals acceptance. Additionally, please note that the data provided will be stored for one year 
            from the date of account creation, after which it will be deleted.</p>

                    
                    <!-- Change this line to a regular button, not wrapped in an anchor tag -->
                    <button type="button" class="btn btn-success" type="submit" id="signupButton">Sign Up</button>
                    </form>
                    </div>
                    </div>

                    <script>
                    document.getElementById("signupButton").addEventListener("click", function(event) {
                    var agreeCheckbox = document.getElementById("agree_terms");
                    if (!agreeCheckbox.checked) {
                    event.preventDefault(); // Prevent form submission if checkbox is not checked
                    alert("You must agree to the terms to sign up.");
                    } else {
                    // If checkbox is checked, redirect to register.php
                    window.location.href = "register.php";
                    
                    }
                    });
                    </script>





                        </nav>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">                
                <div class="offcanvas-header">
                </div>
                
                <div class="offcanvas-body d-flex flex-column">
                        <div class="member-login-form-body">
                        <div class="text-center my-4">
                        </div>
                        </div>
                    <div class="mt-auto mb-5">
                        </div>
                        </div>
                        </div>
            <section class="hero-section hero-50 d-flex justify-content-center align-items-center" id="section_1">
                <div class="section-overlay"></div>

                <svg viewBox="0 0 1962 178" xmlns="" xmlns:xlink="">
                    <path fill="#3D405B" d="M 0 114 C 118.5 114 118.5 167 237 167 L 237 167 L 237 0 L 0 0 Z" stroke-width="0"></path> 
                <path fill="#3D405B" d="M 236 167 C 373 167 373 128 510 128 L 510 128 L 510 0 L 236 0 Z" stroke-width="0"></path> 
                <path fill="#3D405B" d="M 509 128 C 607 128 607 153 705 153 L 705 153 L 705 0 L 509 0 Z" stroke-width="0"></path>
                <path fill="#3D405B" d="M 704 153 C 812 153 812 113 920 113 L 920 113 L 920 0 L 704 0 Z" stroke-width="0"></path>
                <path fill="#3D405B" d="M 919 113 C 1048.5 113 1048.5 148 1178 148 L 1178 148 L 1178 0 L 919 0 Z" stroke-width="0"></path>
                <path fill="#3D405B" d="M 1177 148 C 1359.5 148 1359.5 129 1542 129 L 1542 129 L 1542 0 L 1177 0 Z" stroke-width="0"></path>
                <path fill="#3D405B" d="M 1541 129 C 1751.5 129 1751.5 138 1962 138 L 1962 138 L 1962 0 L 1541 0 Z" stroke-width="0"></path></svg>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <h1 class="text-white mb-4 pb-2">Monitor Flood Automatically</h1>
                            <a href="index.php" class="btn custom-btn smoothscroll me-3">Start Now</a>
                        </div>
                    </div>
                </div>
                <svg viewBox="0 0 1962 178" xmlns="" xmlns:xlink="">
                    <path fill="#ffffff" d="M 0 114 C 118.5 114 118.5 167 237 167 L 237 167 L 237 0 L 0 0 Z" stroke-width="0"></path>
                    <path fill="#ffffff" d="M 236 167 C 373 167 373 128 510 128 L 510 128 L 510 0 L 236 0 Z" stroke-width="0"></path>
                    <path fill="#ffffff" d="M 509 128 C 607 128 607 153 705 153 L 705 153 L 705 0 L 509 0 Z" stroke-width="0"></path>
                    <path fill="#ffffff" d="M 704 153 C 812 153 812 113 920 113 L 920 113 L 920 0 L 704 0 Z" stroke-width="0"></path>
                    <path fill="#ffffff" d="M 919 113 C 1048.5 113 1048.5 148 1178 148 L 1178 148 L 1178 0 L 919 0 Z" stroke-width="0"></path>
                    <path fill="#ffffff" d="M 1177 148 C 1359.5 148 1359.5 129 1542 129 L 1542 129 L 1542 0 L 1177 0 Z" stroke-width="0"></path>
                    <path fill="#ffffff" d="M 1541 129 C 1751.5 129 1751.5 138 1962 138 L 1962 138 L 1962 0 L 1541 0 Z" stroke-width="0"></path></svg>
            
            </section>

            <section class="events-section events-detail-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-8 col-12 mx-auto">
                            <h2 class="mb-lg-5 mb-4">About</h2>

                            <div class="custom-block-info">
                                <h3 class="mb-3">Eye Flood Monitoring System</h3>

                                <p>"Welcome to EyeFlood, your trusted companion in flood monitoring and alternative route. 
                                    Our website provides real-time flood alerts and precise traffic routes to help you 
                                    navigate safely during emergencies.  reliable routes to help you get to safety. 
                                    With our technology, you can stay informed and prepared, finding secure evacuation paths when needed. 
                                    Don’t let floods take you by surprise—count on EyeFlood to guide you safely."</p> 
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 me-auto mb-5 mb-lg-0">
                    </div>
                    <div class="col-lg-3 col-12">      
                         <br>
                        <p class="copyright-text"></p>
                    </div>     
                </div>
            </div>
            <svg xmlns="" viewBox="0 0 1440 320"><path fill="#81B29A" fill-opacity="1" 
            d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,
            549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,
            203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,
            320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,
            823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,
            206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
    </body>
</html>
