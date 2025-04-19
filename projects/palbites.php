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
    <title>Clark Fadel - Palbites</title>
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
            <div class="project-bg" style="background-image: url('../images/projects/palbites.svg');"></div>
        </section>

        <!-- Project Container -->
        <section>
            <div class="project-container">
                <h1 class="project-h1">PalBites - Developing a Website Application for a Bakeshop</h1>
                <!-- Project Content -->
                <div class="project-content">
                    <!-- Project Text Content -->
                    <div class="project-text">
                        <p>PalBites is more than just a bakeshop; it’s a cozy corner where warmth is baked into every treat and every order brings a little joy to someone's day. Focused on pastries and local delicacies, PalBites believes in creating heartfelt experiences through handcrafted desserts. This case study outlines the web design strategy developed to visually convey the bakeshop’s commitment to simplicity, quality, and authenticity through a modern and minimalist web experience.</p>

                        <h2>Objectives and Target Audience</h2>
                        <p>The primary objective of the web design is to reflect PalBites as a refined, modern bakeshop that values simplicity and thoughtful presentation. The target audience includes local customers, working professionals, and food lovers who appreciate convenience and clean, straightforward design. By delivering an uncluttered and elegant online environment, the website encourages seamless engagement and builds trust with a digital-first audience.</p>

                        <h2>Key Design Features</h2>
                        <p>The website embraces a minimalist black-and-white aesthetic that conveys both sophistication and warmth. The monochrome color scheme is used not just for visual appeal, but to place full attention on the pastries and delicacies themselves, allowing the food photography to stand out with subtle elegance. The homepage features clean typography and plenty of negative space, giving users a relaxed browsing experience. A simple product catalog showcases each item with just enough detail—name, description, and price—while the ordering interface remains smooth and intuitive, avoiding unnecessary distractions. Every page has a clear purpose, ensuring users can find what they need quickly, whether it's browsing the menu or submitting an order.</p>

                        <h2>Design Process</h2>
                        <p>The design process began with a focus on understanding PalBites’ brand values: quality, simplicity, and sincerity. Through discussions with the owner, it became clear that the website should reflect not only the physical space of the bakeshop but also the philosophy behind the products—no frills, no fluff, just honest food. From this foundation, minimalist wireframes were developed to strip the experience down to its essentials. Careful attention was paid to typography, spacing, and content flow, ensuring everything felt light and intentional. The black-and-white color palette was selected to give the site a timeless, editorial feel, while still maintaining a sense of approachability. Development followed a responsive-first approach, ensuring the site worked flawlessly across devices, with quick load times and a straightforward interface for ordering and product management.</p>

                        <h2>Results and Conclusion</h2>
                        <p>The final website captures the spirit of PalBites with clarity and elegance. Its minimalist design distinguishes it from typical bakeshop websites, offering a modern, clean experience that appeals to design-conscious users. Customers praised the ease of browsing and the straightforward order process, while the owner found the content management system intuitive and efficient. The new website has helped streamline operations and increase visibility without sacrificing the brand’s identity. Following the success of this launch, PalBites continues to evolve its digital presence, with plans for subtle seasonal updates and promotional integrations—always staying true to its minimalist roots.</p>
                    </div>
                    
                    <!-- Project Left Content -->
                    <div class="project-left-content">
                        <!-- Project Description -->
                        <div class="project-description">
                            <div class="upper-description">
                                <div class="upper-content u1">
                                    <h3>Client</h3>
                                    <h4>Palbites</h4>
                                </div>
                                <div class="upper-content u2">
                                    <h3>Project Status</h3>
                                    <h4>4 months (Jan - April 2025)</h4>
                                </div>
                            </div>
                            <div class="lower-description">
                                <div class="lower-content l1">
                                    <h3>Category</h3>
                                    <h4>Website Development</h4>
                                </div>
                                <div class="lower-content l2">
                                    <a href="https://palbites.store/" target="_blank" class="project-url">Visit Website<i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback -->
                        <div class="project-feedback">
                            <div class="feedback-content">
                                <h6>"</h6>
                                <p>Clark understood exactly what we needed and delivered a website design that truly reflects our brand. His design skills were exceptional, and he was always available to help us out.</p>
                            </div>
                            <div class="feedback-person">
                                <h2>Carlos</h2>
                                <h3>Palbites, CEO</h3>
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