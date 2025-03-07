<?php
include 'process.php';
include 'db.php';

// Fetch images from the database
$sql = "SELECT * FROM images ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>WonderKids</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="WonderKids, Education, School, Learning" name="keywords" />
    <meta content="WonderKids is dedicated to providing a supportive and engaging environment where students thrive academically, socially, and emotionally." name="description" />

    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
      <nav
        class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5"
      >
        <a
          href="index.php"
          class="navbar-brand font-weight-bold text-secondary"
          style="font-size: 50px"
        >
          <img
            src="img/title.png"
            alt="Wonderkids Logo"
            style="height: 55px; width: auto; mix-blend-mode: multiply"
          />
        </a>
        <button
          type="button"
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarCollapse"
        >
          <div class="navbar-nav font-weight-bold mx-auto py-0">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <a href="class.php" class="nav-item nav-link">Classes</a>
            <a href="team.php" class="nav-item nav-link">Governing Body</a>
            <a href="gallery.php" class="nav-item nav-link">Gallery</a>
            <!-- <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
                >Pages</a
              >
              <div class="dropdown-menu rounded-0 m-0">
                <a href="blog.php" class="dropdown-item">Blog Grid</a>
                <a href="single.php" class="dropdown-item">Blog Detail</a>
              </div>
            </div> -->
            <a href="contact.php" class="nav-item nav-link">Contact</a>
          </div>
          <a href="contact.php" class="btn btn-primary px-4">Join Class</a>
        </div>
      </nav>
    </div>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php 
        // Check if there are any images
        $first = true; 
        while ($row = $result->fetch_assoc()):
            $imagePath = htmlspecialchars($row['image_data']); // Get the image path
            ?>
            <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                <img class="d-block w-100" src="<?php echo $imagePath; ?>" alt="Carousel image" style="object-fit:cover;">
            </div>
            <?php 
            $first = false; // After the first image, set $first to false so others aren't active
        endwhile;
        ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Header End -->

    <!-- Facilities Start -->
    <div class="container-fluid pt-5">
      <div class="container pb-3">
        <div class="row">
        <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex grow bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i id="digital-classrooms"></i>
              <div class="pl-4">
                <h4>Digital Classrooms</h4>
                <p class="m-0">
                  Learning is improved in spacious classrooms and air-conditioned smart classrooms,
                  along with fun activities that encourage creativity and teamwork.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex grow bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
            <i id="play-Ground"></i>
              <div class="pl-4">
                <h4>Play Ground</h4>
                <p class="m-0">
                  Our playground offers a vibrant space for children to explore and engage in physical activities, 
                  fostering creativity, teamwork, and healthy play.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex grow bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i id="music-and-dance"></i>
              <div class="pl-4">
                <h4>Music and Dance</h4>
                <p class="m-0">
                  Our music and dance program nurtures creativity and self-expression, allowing students to explore various genres while developing rhythm,
                  coordination, and a love for the arts.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex grow bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i id="art-and-craft"></i>
              <div class="pl-4">
                <h4>Arts and Crafts</h4>
                <p class="m-0">
                  Our arts and crafts program encourages creativity and imagination, 
                  providing students with the opportunity to explore various mediums and techniques while developing 
                  their artistic skills and self-confidence.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex grow bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i id="self-transportation"></i>
              <div class="pl-4">
                <h4>Safe Transportation</h4>
                <p class="m-0">
                  Our safe transportation program ensures that students learn essential safety skills and practices 
                  for navigating their environment responsibly.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex grow bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i id="education-tour"></i>
              <div class="pl-4">
                <h4>Educational Tour</h4>
                <p class="m-0">
                  Our educational tours provide students with enriching experiences, 
                  allowing them to explore new environments while applying classroom knowledge in real-world settings.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Facilities End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <p class="section-title pr-5">
              <span class="pr-2">know About Us</span>
            </p>
            <h1 class="mb-4">Best School For Your Kids</h1>
            <div class="fade-effect">
              <p>
                At WonderKids, we firmly believe that education is the foundation of a bright future,
                and our mission is to cultivate a supportive and engaging environment where students thrive academically, 
                socially, and emotionally. We recognize that each child is unique, possessing individual strengths and interests, 
                and we're dedicated to nurturing these attributes through personalized learning approaches.....
              </p>
            </div>
            <a href="about.php" class="btn btn-primary mt-2 py-2 px-4 mb-3">Learn More</a>
          </div>
          <div class="col-lg-5">
            <img
              class="img-fluid rounded mb-5 mb-lg-0"
              src="img/about-1.jpeg"
              alt="" 
              style="height:30rem; width:25rem; object-fit:fill;"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- About End -->

    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="rowdies-font px-2">Popular Classes</span>
          </p>
          <h1 class="mb-4">Classes for Your Kids</h1>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-5">
            <div class="card border-0 bg-light shadow-sm pb-2">
              <img class="card-img-top mb-2" src="img/class-1.jpeg" alt="" />
              <div class="card-body text-center">
                <h4 class="card-title">D.B.H.P Sabha Learning</h4>
                <p class="card-text">
                Fluent in the national language, Hindi, D.B.H.P. (Delhi Bharat Hindi Pakhwada) offers specialized classes 
                for students preparing for Hindi examinations conducted by the Sabha.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="card border-0 bg-light shadow-sm pb-2">
              <img class="card-img-top mb-2" src="img/class-2.jpeg" alt="" />
              <div class="card-body text-center">
                <h4 class="card-title">Abacus & Vedic maths</h4>
                <p class="card-text">
                  Students learn Abacus and Vedic Maths to enhance their educational 
                  experience and improve their mathematical skills.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="card border-0 bg-light shadow-sm pb-2">
              <img class="card-img-top mb-2" src="img/class-3.jpeg" alt="" />
              <div class="card-body text-center">
                <h4 class="card-title">Science Lab</h4>
                <p class="card-text">
                  Our science lab classes encourage hands-on learning and exploration, 
                  allowing kids to discover the wonders of science in a fun way.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center"> 
            <a href="class.php" class="btn btn-primary mt-2 py-2 px-4">Learn More</a>
        </div>
      </div>
    </div>
    <!-- Class End -->

    <!-- Team Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Our Governing Body</span>
          </p>
          <h1 class="mb-4">Meet Our Governing Body</h1>
        </div>
        <div class="row justify-content-between">
        <!-- Team Member 1 -->
        <div class="col-md-2 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid" src="img/team-1.jpeg" alt="Julia Smith" style="border-radius: 100%;" />
            </div>
            <h4>
                <span class="position-light ">
                  Chairman
                </span>
            </h4>
            <h4 class="teacher-name">Mr. Allu Rama krishna</h4>
            <i class="education">M.A, Edu</i>
        </div>

        <!-- Team Member 2 -->
        <div class="col-md-2 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid" src="img/team-2.png" alt="Jhon Doe" style="border-radius: 100%;" />
            </div>
            <h4>
                <span class="position-light">
                  Managing Director
                </span>
            </h4>
            <h4 class="teacher-name">Mr. Allu Vamsi krishna</h4>
            <i class="education">B.Sc, B.F.A, M.B.A, LLB</i>
        </div>

        <!-- Team Member 3 -->
        <div class="col-md-2 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid" src="img/team-3.png" alt="Mollie Ross" style="border-radius: 100%;" />
            </div>
            <h4>
                <span class="position-light">
                    Head Mistress
                </span>
            </h4>
            <h4 class="teacher-name">Mrs. Allu vanajakshi kumari</h4>
            <i class="education">B.Com, B.Ed</i>
        </div>

        <!-- Team Member 4 -->
        <div class="col-md-2 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid" src="img/team-4.png" alt="Donald John" style="border-radius: 100%;" />
            </div>
            <h4>
                <span class="position-light">
                    Principal
                </span>
            </h4>
            <h4 class="teacher-name">Mrs. T. Vani</h4>
            <i class="education">M.A, B.Ed & HPT</i>
        </div>

        <!-- Team Member 5 -->
        <div class="col-md-2 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid" src="img/team-5.png" alt="Julia Smith" style="border-radius: 100%;" />
            </div>
            <h4>
                <span class="position-light">
                    Vice Principal
                </span>
            </h4>
            <h4 class="teacher-name">Mrs. Allu Vijaya Bhagya Sri Lakshmi</h4>
            <i class="education">B.Tech, LLM</i>
        </div>
    </div>

      </div>
    </div>
    <!-- Team End -->

    <!-- Registration Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Get In Touch</span>
          </p>
          <h1 class="mb-4">Contact Us For Admissions</h1>
        </div>
        <div class="row">
          <div class="col-lg-7 mb-5">
            <div class="contact-form">
              <div id="success"></div>
              <form name="sentMessage" id="contactForm" method="post" novalidate="novalidate">
                  <div class="control-group">
                      <input
                          name="name"
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Your Name"
                          required="required"
                          data-validation-required-message="Please enter your name"
                      />
                      <p class="help-block text-danger"></p>
                  </div>
                    <div class="control-group">
                      <input
                      name="mobile"
                      type="text"
                      class="form-control"
                      id="mobile"
                      placeholder="Your Mobile Number"
                      pattern="^(\+\d{1,3}\s?\d{10}|\d{10}|\d{3}[-\s]?\d{3}[-\s]?\d{4})$"
                      required="required"
                      data-validation-required-message="Please enter a mobile number"
                      />
                      <p class="help-block text-danger"></p>
                    </div>
                  <div class="control-group">
                      <input
                          name="email"
                          type="email" 
                          class="form-control"
                          id="email"
                          placeholder="Your Email Address"
                          required="required"
                          data-validation-required-message="Please enter your email address"
                      />
                      <p class="help-block text-danger"></p>
                  </div>
                  <div class="control-group">
                      <select name="class" id="classSelect" class="form-control" required data-validation-required-message="Please select your class.">
                          <option value="" disabled selected>Select your class</option>
                          <option value="LKG">LKG</option>
                          <option value="UKG">UKG</option>
                          <option value="class 1">Class 1</option>
                          <option value="class 2">Class 2</option>
                          <option value="class 3">Class 3</option>
                          <option value="class 4">Class 4</option>
                          <option value="class 5">Class 5</option>
                          <option value="class 6">Class 6</option>
                          <option value="class 7">Class 7</option>
                          <option value="class 8">Class 8</option>
                          <option value="class 9">Class 9</option>
                          <option value="class 10">Class 10</option>
                      </select>
                      <small class="form-text text-muted">Please Select A Class.</small>
                      <p class="help-block text-danger"></p>
                  </div>
                  <div class="control-group">
                      <textarea
                          name="message"
                          class="form-control"
                          rows="6"
                          id="message"
                          placeholder="Message (optional)"
                      ></textarea>
                  </div>
                  <div>
                      <button
                          class="btn btn-primary py-2 px-3 mt-3"
                          type="submit"
                          id="sendMessageButton"
                      >
                          Send Message
                      </button>
                  </div>
              </form>
            </div>
          </div>
          <div class="col-lg-5 mb-5">
            <p class="section-title pr-5">
              <span class="pr-2">Book A Seat</span>
            </p>
            <p>
            Parents are welcome to reach out for any questions about school information,
            student behaviors, or the admissions process. 
            We are here to provide details about our programs and support you with any inquiries you may have.
            </p>
            <div class="row">
              <div class="col-md-4 team">
                <ul class="list-inline m-0">
                  <li class="py-2">
                    <i class="fa fa-check text-success mr-3"></i>Education
                  </li>
                  <li class="py-2">
                    <i class="fa fa-check text-success mr-3"></i>Discipline
                  </li>
                  <li class="py-2">
                    <i class="fa fa-check text-success mr-3"></i>Ethics
                  </li>
                </ul>
              </div>
              <div class="col-md-4 team mb-3">
                <ul class="list-inline m-0">
                  <li class="py-2">
                    <i class="fa fa-check text-success mr-3"></i>Moral Values
                  </li>
                  <li class="py-2">
                    <i class="fa fa-check text-success mr-3"></i>Honesty
                  </li>
                </ul>
              </div>
            </div>
            <a href="contact.php" class="btn btn-primary py-2 px-3 mt-3">Know More</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Registration End -->

    <!-- Footer Start -->
    <div
      class="container-fluid bg-secondary text-white mt-5 px-sm-3 px-md-5"
    >
      <div class="row pt-5">
        <div class="col-lg-3 col-md-6 mb-5">
        <span style="font-size: 40px; line-height: 40px" class="navbar-brand font-weight-bold m-0 mb-4 p-0 text-white rowdies-font">Wonder Kids</span>
          <p>
            The school focuses on teaching students good values, discipline, and ethics, 
            helping them grow into responsible members of society. 
            They offer a strong education that emphasizes both learning and doing the right thing, 
            making sure every child is well-prepared for the future.
          </p>          
          <div class="d-flex justify-content-start mt-4">
            <a
              class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
              style="width: 38px; height: 38px"
              href="#"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a
              class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
              style="width: 38px; height: 38px"
              href="https://youtube.com/@wonderkidse.mschool?si=kSq7iQQ66OE-lqjd"
              ><i class="fab fa-youtube"></i
            ></a>
            <a
              class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
              style="width: 38px; height: 38px"
              href="https://www.instagram.com/wonder._kids7/"
              ><i class="fab fa-instagram"></i
            ></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Get In Touch</h3>
          <div class="d-flex">
            <h4 class="fa fa-map-marker-alt text-primary"></h4>
            <div class="pl-3">
              <a
                href="https://maps.app.goo.gl/u132iB2nr3sHDg6R6"
                class="text-decoration-none"
              >
                <h5 class="text-white">Address</h5>
                <p class="text-white">Mentay Vari Thota, Bhimavaram, Andhra Pradesh 534201</p>
              </a>
            </div>
          </div>
          <div class="d-flex">
            <h4 class="fa fa-envelope text-primary"></h4>
            <div class="pl-3">
              <a
                href="mailto:allukrishna6@gmail.com"
                class="text-decoration-none"
              >
                <h5 class="text-white">Email</h5>
                <p class="text-white">allukrishna6@gmail.com</p>
              </a>
            </div>
          </div>
          <div class="d-flex">
            <h4 class="fa fa-phone-alt text-primary"></h4>
            <div class="pl-3">
              <a href="tel:+91 9392758577" class="text-decoration-none">
                <h5 class="text-white">Phone</h5>
                <p class="text-white">+91 9392758577</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Quick Links</h3>
          <div class="d-flex flex-column justify-content-start">
            <a class="text-white mb-2" href="/wonderkids/index.php"
              ><i class="fa fa-angle-right mr-2"></i>Home</a
            >
            <a class="text-white mb-2" href="/wonderkids/about.php"
              ><i class="fa fa-angle-right mr-2"></i>About Us</a
            >
            <a class="text-white mb-2" href="/wonderkids/class.php"
              ><i class="fa fa-angle-right mr-2"></i>Our Classes</a
            >
            <a class="text-white mb-2" href="/wonderkids/team.php"
              ><i class="fa fa-angle-right mr-2"></i>Our Governing Body</a
            >
            <!-- <a class="text-white mb-2" href="/wonderkids/blog.php"
              ><i class="fa fa-angle-right mr-2"></i>Our Blog</a
            > -->
            <a class="text-white" href="/wonderkids/contact.php"
              ><i class="fa fa-angle-right mr-2"></i>Contact Us</a
            >
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Map</h3>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3824.563896429001!2d81.52839999999999!3d16.548099999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a37d2a7b4b97b6f%3A0x8dda23123746569e!2sWonderKids%20EnglishMedium%20School!5e0!3m2!1sen!2sin!4v1728069922942!5m2!1sen!2sin" width="100%"  style="border: 0px; border-radius: 8px;" height="300" ></iframe>
        </div>
      </div>
    </div>
    <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid text-white " style="background-color:#8f2022;">
      <div class="container text-center">
        <p class="m-0">
          &copy; <?php echo date("Y"); ?> WonderKids. All Rights Reserved.
        </p>
      </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"
      ><i class="fa fa-angle-double-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Svgicons Font -->
    <script src="lib/svg/Svgicons.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <script>
      $(document).ready(function () {
        $("#contactForm input").jqBootstrapValidation();
      });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
