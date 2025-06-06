<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact Us</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}

.footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 10px 20px; /* Reduced padding for a thinner look */
            text-align: center;
        }
        .footer a {
            color: #1abc9c;
            text-decoration: none;
            font-size: 15px;
        }
        .footer a:hover {
            text-decoration: underline;
            font-size: 15px;
        }
        .footer .contact-info {
            margin-top: 15px;
            font-size: 15px;
        }
        .footer .social-links a {
            margin: 0 15px;
        }
        
</style>
</head>
<body>

<!-- Page content -->
<div class="w3-content" style="max-width:1000px;margin-top:46px">


  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">THE TEAM</h2>
    <p class="w3-opacity"><i>PLV BSIT</i></p>
    <p class="w3-justify">
    Thank you for your interest in our Flood Monitoring System! 
    We’re here to give you all the information you need, answer any questions, 
    and help you use our flood monitoring tools to keep your community safe and prepared.
        <br><br>
    Our team is made up of four dedicated 4th-year IT students from 
    Pamantasan ng Lungsod ng Valenzuela. We are driven by a shared goal, to create practical 
    solution that help with disaster management of the Barangay. As students, we saw the need for better ways to 
    keep communities aware of possible flood risks, especially in areas that often face heavy rains. Our goal is to provide real-time updates and safe route suggestions, 
    reducing the risks for commuters and residents during floods.
        <br><br>
    Thank you for supporting our vision of making communities more resilient. 
    We’re excited to help you build a safer, more prepared environment.
    </p>
    </div>
    </div>
    </div>

  <!-- The Contact Section -->
  <div style="background-color: #f0dab1;" id="#">
  <div class="w3-container w3-content w3-padding-64" style="max-width:800px">

    <div class="w3-container w3-content w3-padding-50" style="max-width:800px" id="contact">
      <h2 class="w3-wide w3-center">CONTACT US</h2>
      <p class="w3-opacity w3-center"><i>Experiencing a problem in System?</i></p>
      <div class="w3-row w3-padding-32">
        <div class="w3-col m6 w3-large w3-margin-bottom">
          <i class="fa fa-map-marker" style="width:30px"></i> Valenzuela City, Metro Manila<br>
          <i class="fa fa-phone" style="width:30px"></i> Phone: +639497123110<br>
          <i class="fa fa-envelope" style="width:30px"> </i> Email: rhya.maria04@gmail.com<br>
        </div>
        <form action="send_email.php" method="post" onsubmit="return showConfirmationMessage()">
          <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Name" required name="name">
            </div>
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Contact" required name="contact">
            </div>
          </div>
          <input class="w3-input w3-border" type="email" placeholder="Email" required name="email">
          <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
          <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
          <button class="w3-button w3-black w3-section w3-right" onclick="window.location.href='Main-page.php'">HOME</button>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- Confirmation Message Box -->
<div id="confirmationMessage" class="w3-modal" style="display:none">
  <div class="w3-modal-content w3-animate-top w3-card-4 w3-padding-large">
    <header class="w3-container">
      <span onclick="document.getElementById('confirmationMessage').style.display='none'" class="w3-button w3-display-topright">&times;</span>
      <h2>Message Sent</h2>
    </header>
    <div class="w3-container">
      <p>Thank you! Your message has been sent successfully. We will get back to you shortly.</p>
    </div>
  </div>
</div>

<!-- Footer Section -->
<footer class="footer">
      <p>© 2024 Eye Flood | Your Reliable Source for Flood Monitoring</p>
      <div class="contact-info">
          <p>Email: <a href="barangaymalanday@gmail.com">barangaymalanday@gmail.com</a></p>
          <p>Phone: +63 949 7123 110</p>
          <p>Address: 1444, 380 Marcelo H. Del Pilar St, Valenzuela, 1444 Metro Manila</p>
      </div>
      <div class="footer-links">
          <a href="#privacy-policy">Privacy Policy</a> | 
          <a href="#terms-of-service">Terms of Service</a> | 
          <a href="#accessibility">Accessibility</a>
          <p class="footer-note" style="font-size: 12px; font-style: italic; margin-top: 10px;">
          Stay informed, stay safe.
          </p>

      </div>
  </footer>

<script>
// Show the confirmation message box
function showConfirmationMessage() {
  document.getElementById('confirmationMessage').style.display = 'block';
  
  // Send form data to send_email.php using AJAX without redirect
  var form = document.querySelector("form");
  var formData = new FormData(form);
  
  fetch('send_email.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    console.log('Message sent:', data);
  })
  .catch(error => {
    console.error('Error sending message:', error);
  });

  return false; // Prevent actual form submission
}

// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}
</script>

</body>
</html>
