<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$swiperCss = $_ENV['SWIPER_CSS'];
$swiperJs = $_ENV['SWIPER_JS'];
$fontAwesomeJs = $_ENV['FONTAWESOME_JS'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Clark Fadel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $swiperCss; ?>"/>

    <link rel="icon" type="image/x-icon" href="logo.ico">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="nav-bar">
            <a href="#" class="logo"><h1>Clark Fadel</h1></a>
            <div class="nav-toggle" id="navToggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="nav-links">
                <ul class="nav-ul">
                    <li><a href="#" class="scramble-link">Home</a></li>
                    <li><a href="#about" class="scramble-link">About</a></li>
                    <li><a href="#projects" class="scramble-link">Projects</a></li>
                    <li><a href="#contact" class="scramble-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Overlay (very important for mobile navigation) -->
    <div class="overlay" id="overlay"></div>

    <!-- Header -->
    <header>
        <div class="header">
            <div class="left-header">
                <div class="header-h1">
                    <h1>Hello, my name is <span>Clark</span>.</h1>
                </div>
                <h6>I design and develop - <span>Website Applications</span></h6>
                <a href="https://calendly.com/clarkfadel/30min" class="scramble-link" target="_blank">Schedule a Meeting</a>
                <div class="left-image">
                    <img src="images/shooting-star.png" alt="">
                </div>
            </div>
            <div class="right-header">
                <img src="images/header-img.svg" alt="">
            </div>
        </div>
    </header>

    <!-- Scroll -->
    <div class="scroll">
        <h1>SCROLL</h1>
    </div>

    <!-- About -->
    <section id="about">
        <div class="about">
            <h1>About me</h1>
            <p>Hi! I'm an aspiring 20-year-old UI/UX designer and website/mobile application developer currently studying at Mapúa University. I strive to create digital experiences that are not only functional but also engaging and unique. I am specializing in building applications that align with a brand’s identity, ensuring that each project reflects its values and vision.
                <br><br>
            In addition to design and development, I also have experience in digital marketing, allowing me to approach projects from both a technical and a strategic perspective. I love exploring new ideas and finding innovative solutions that elevate user experiences.</p>
        </div>
    </section>

    <!-- Projects -->
    <section id="projects">
        <div class="projects">
            <h1 class="project-h1">Projects</h1>
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <div class="swiper-slide project-slide p1">
                        <div class="project-image-p1"></div>
                        <div class="project-content">
                            <h1>Ben Cladding</h1>
                            <p>An architectural and engineering firm. They approached me to create a custom website application that would highlight their expertise and streamline their content management.</p>
                            <h6>Website Development</h6>
                            <!-- Navigation Arrows -->
                            <div class="swiper-navigation">
                                <div class="swiper-button-prev">&lt;</div>
                                <div class="swiper-button-next">&gt;</div>
                            </div>
                            <h2>01</h2>
                        </div>
                    </div>

                    <div class="swiper-slide project-slide p2">
                        <div class="project-image-p2"></div>
                        <div class="project-content">
                            <h1>Greenviro</h1>
                            <p>A packaging business for manufacturing and supplying high-quality tableware, food containers, and paper bags. They approached me to design a semi e-commerce website that highlights their eco-conscious products.</p>
                            <h6>Website Development</h6>
                            <!-- Navigation Arrows -->
                            <div class="swiper-navigation">
                                <div class="swiper-button-prev">&lt;</div>
                                <div class="swiper-button-next">&gt;</div>
                            </div>
                            <h2>02</h2>
                        </div>
                    </div>

                    <div class="swiper-slide project-slide p3">
                        <div class="project-image-p3"></div>
                        <div class="project-content">
                            <h1>Palbites</h1>
                            <p>An upcoming project of Clark Fadel.</p>
                            <h6>Website Development</h6>
                            <!-- Navigation Arrows -->
                            <div class="swiper-navigation">
                                <div class="swiper-button-prev">&lt;</div>
                                <div class="swiper-button-next">&gt;</div>
                            </div>
                            <h2>03</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact">
        <div class="contact">
            <h1>Contact</h1>
            <p>Have a project in mind? Whether it's UI/UX design, web, or mobile development, I'm here to help. Let's create something great together!</p>
            <div class="connect">
                <a href="https://calendly.com/clarkfadel/30min"  class="scramble-link" target="_blank">Let's connect</a>
                <h2>clarkfadel02@gmail.com</h2>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <footer>
        <div class="footer">
            <h1>© 2024 Clark Fadel. All rights reserved.</h1>
            <div class="footer-icons">
                <a href="https://www.instagram.com/hatdog_098/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/clark-jhian-fadel-262060295/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://github.com/clarkfadel" target="_blank"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>
    </footer>




    <script src="js/nav.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/scramble.js"></script>
    <script src="<?php echo $swiperJs; ?>"></script>
    <script src="<?php echo $fontAwesomeJs; ?>" crossorigin="anonymous"></script>

    <!-- Scrolling Animation for Navigation Links -->
    <script>
        document.querySelectorAll('.nav-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    </script>
</body>
</html>