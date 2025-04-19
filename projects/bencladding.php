<?php
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
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
    <link rel="stylesheet" href="../css/project-content.css">
    <title>Clark Fadel - Ben Cladding</title>
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
            <a href="../index.php" class="logo"><h1>Clark Fadel</h1></a>
            <div class="nav-toggle" id="navToggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="nav-links">
                <ul class="nav-ul">
                    <li><a href="../index.php" class="scramble-link">Home</a></li>
                    <li><a href="../index.php" class="scramble-link">About</a></li>
                    <li><a href="../index.php" class="scramble-link">Projects</a></li>
                    <li><a href="../index.php" class="scramble-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Overlay (very important for navigation) -->
    <div class="overlay" id="overlay"></div>

    <section class="body">
        
        <!-- Project Header -->
        <section class="project-background">
            <div class="project-bg" style="background-image: url('../images/projects/bencladding.svg');"></div>
        </section>

        <!-- Project Container -->
        <section>
        <div class="project-container">
            <h1 class="project-h1">Ben Cladding - Developing a comprehensive
            website with Content Management System</h1>
            <!-- Project Content -->
            <div class="project-content">
                <!-- Project Text Content -->
                <div class="project-text">
                    <p>Ben Cladding™ is an architectural and engineering firm specializing in facade design and engineering works. Known for their innovative and sustainable solutions, they have established a strong reputation in the industry. However, despite their success, Ben Cladding™ lacks an online presence, which is crucial for modern business operations. This case study outlines the development of a website to showcase their projects and articles, thereby attracting potential clients and partners.</p>

                    <h2>Objectives and Target Audience</h2>
                    <p>The primary objective of the website is to establish a professional online presence for Ben Cladding™, highlighting their expertise and capabilities through detailed project showcases and insightful articles. The target audience includes potential clients such as property developers and construction companies, industry peers, potential partners, and the general public interested in architectural advancements. By providing a platform for knowledge sharing, the website aims to enhance Ben Cladding’s™ visibility and engagement.</p>

                    <h2>Key Features and Design</h2>
                    <p>The website features a homepage with an introduction to Ben Cladding™, a showcase of featured projects, and teasers of the latest articles. The projects page displays all projects with images and titles, while detailed pages offer comprehensive information on each project. The articles page lists all articles and their categories. The contact page includes a form for inquiries and direct contact information. The website is designed to be responsive, ensuring accessibility across all devices, and features intuitive navigation for a seamless user experience.</p>

                    <h2>Development Process</h2>
                    <p>The development process began with thorough planning and research, including meetings with Ben Cladding™ to understand their vision and goals. The design phase involved creating wireframes and mockups that align with the firm’s branding and aesthetic principles. The development phase utilized modern web technologies and a content management system (CMS) for easy updates. Rigorous testing ensured functionality, usability, accessibility, and performance across devices and browsers. The website was then launched on a reliable hosting platform, with ongoing monitoring to address any post-launch issues.</p>

                    <h2>Results and Conclusion</h2>
                    <p>The completed website successfully addresses Ben Cladding’s™ needs by establishing a professional online presence, showcasing their projects and expertise, and facilitating easy communication with potential clients and partners. The minimalist design and user-friendly features ensure that the website reflects the firm's aesthetic principles while enhancing their visibility and engagement in the industry.</p>
                </div>
                
                <!-- Project Left Content -->
                <div class="project-left-content">
                    <!-- Project Description -->
                    <div class="project-description">
                        <div class="upper-description">
                            <div class="upper-content u1">
                                <h3>Client</h3>
                                <h4>Ben Cladding</h4>
                            </div>
                            <div class="upper-content u2">
                                <h3>Project Duration</h3>
                                <h4>3 months (May - July 2024)</h4>
                            </div>
                        </div>
                        <div class="lower-description">
                            <div class="lower-content l1">
                                <h3>Category</h3>
                                <h4>Website Development</h4>
                            </div>
                            <div class="lower-content l2">
                                <a href="https://bencladding.com/" target="_blank" class="project-url">Visit Website<i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Feedback -->
                    <div class="project-feedback">
                        <div class="feedback-content">
                            <h6>"</h6>
                            <p>We needed a minimalistic, modern, and responsive website to impress investors and partners, and Clark knocked it out of the park. The design is sleek and the functionality is spot on. The whole process was smooth and efficient.</p>
                        </div>
                        <div class="feedback-person">
                            <h2>Ignacio</h2>
                            <h3>Ben Cladding, Founder & CEO</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

        <!-- Pagination Section -->
        <section>
            <div class="pagination">
                <div class="prev">
                        <a href=""><i class="fa-solid fa-arrow-left"></i>Back</a>
                </div>

                <div class="prev-2">
                    <a href=""><i class="fa-solid fa-arrow-left"></i>Prev</a>
                </div>

                <div class="project-page">
                    <a href="../project.php"><i class="fa-solid fa-person-through-window"></i></a>
                </div>

                <div class="next-2">
                    <a href="">Next<i class="fa-solid fa-arrow-right"></i></a>
                </div>


                <div class="next">
                        <a href="">Next<i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </section>


        <!-- Footer -->
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
    </section>

    <script src="../js/nav.js"></script>
    <script src="../js/swiper.js"></script>
    <script src="../js/scramble.js"></script>
    <script src="<?php echo $swiperJs; ?>"></script>
    <script src="<?php echo $fontAwesomeJs; ?>" crossorigin="anonymous"></script>

    <!-- Scrolling Animation for Navigation Links -->
    <script>
        document.querySelectorAll('.nav-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const targetElement = document.querySelector(href);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>

</body>
</html>