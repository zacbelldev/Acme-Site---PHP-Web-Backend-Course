<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">   
        <meta name="author" content="Zac Bell">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acme</title>
        <link rel="stylesheet" href="/acme/css/style.css" media="screen">
    </head>
    <!--Page Content-->
    <body id="body">
        <!--Child ONE - Left -->
        <aside id="body_aside_left">

        </aside>
        <!--Child TWO - Middle -->
        <section id="body_article">
            <!--Child 2.1-->
            <header id="article_header">
                <img id="logoImage" src="/acme/images/logo.gif" alt="Logo Image"/>
                <section id="article_header_nav">
                    <ul>
                        <?php
                        if (isset($_SESSION['loggedin'])) {
                            $firstname = $_SESSION['clientData']['clientFirstname'];
                            echo "
                                <li>
                                    <a href='/acme/index.php?action=admin'><span id='welcome' class='menu-right'>Welcome, $firstname</span></a>
                                </li>                                
                                <li>
                                    <a href='/acme/accounts/?action=logout' class='menu-right' title='Logout'>Logout</a>
                                </li>";
                        } else {
                            echo "<li>
                                    <img id='accountImage' src='/acme/images/account.gif' alt='Account Folder Image'/>
                                    <a href='/acme/index.php?action=signin' class='menu-right' title='Go to your account'>My Account</a>
                                </li>";                            

                        }
                        ?>
                        <li>
                            <img id="helpImage" src="/acme/images/help.gif" alt="Help Question Mark Image"/>
                            <a href="#" class="menu-right" title="Need Help?">Help</a>
                        </li>
                    </ul>
                </section>
            </header>
            <!--Child 2.2-->
            <nav id="article_nav_bar">
                <!--NOTE: Change id of ul below per page, so active will work-->
                <!--                <ul id="home">
                                    <li><a href="#" title="Go to the home page">Home</a></li>
                                    <li><a href="#" title="Go to the anvils page">Anvils</a></li>
                                    <li><a href="#" title="Go to the cannons page">Cannons</a></li>
                                    <li><a href="#" title="Go to the protection page">Protection</a></li>
                                    <li><a href="#" title="Go to the rockets page">Rockets</a></li>
                                    <li><a href="#" title="Go to the traps page">Traps</a></li>
                                </ul>-->
                <?php echo $navList; ?>
            </nav>
            <!--Child 2.3-->
            <main id="article_main">
                <!--Child 2.3.1-->
                <section id="main_section_heading">
                    <h1 id="main_section_heading_text">Welcome to Acme!</h1>
                </section>
                <!--Child 2.3.2-->
                <section id="main_section_hero">
                    <div>
                        <img id="dinnerRocketImage" src="/acme/images/dinnerrocketfeature.jpg" alt="Dinner Rocket Image"/>
                        <ul id="heroText">
                            <li><h2>Get Dinner Rocket</h2></li>
                            <li>Quick lighting fuse</li>
                            <li>NHTSA approved seat belts</li>
                            <li>Mobile launch stand included</li>
                            <li><a href="/acme/cart/" title="Add to cart"><img id="actionbtn" alt="Add to cart button" src="/acme/images/iwantit.gif"></a></li>
                        </ul>
                    </div>
                </section>
                <!--Child 2.3.3-->                
                <section id="main_section_testimonial">
                    <!--Child 2.3.3.1-->
                    <section id="main_section_testimonial_recipes">
                        <h1>Featured Recipes</h1><br>
                        <section id="recipeGridContainer">
                            <a href="#" class="fourRecipeBlocks" title="Pulled Roadrunner BBQ"><img id="pulledBBQImage" src="/acme/images/recipes/bbqsand.jpg" alt="Pulled BBQ Image"/><figure><figcaption>Pulled Roadrunner BBQ</figcaption></figure></a>
                            <a href="#" class="fourRecipeBlocks" title="Roadrunner Pot Pie"><img id="potPieImage" src="/acme/images/recipes/potpie.jpg" alt="Roadrunner Pot Pie Image"/><figure><figcaption>Roadrunner Pot Pie</figcaption></figure></a>
                            <a href="#" class="fourRecipeBlocks" title="Roadrunner Soup"><img id="soupImage" src="/acme/images/recipes/soup.jpg" alt="Roadrunner Soup Image"/><figure><figcaption>Roadrunner Soup</figcaption></figure></a>
                            <a href="#" class="fourRecipeBlocks" title="Roadrunner Tacos"><img id="tacoImage" src="/acme/images/recipes/taco.jpg" alt="Roadrunner Tacos Image"/><figure><figcaption>Roadrunner Tacos</figcaption></figure></a>
                        </section>
                    </section>
                    <!--Child 2.3.3.2-->
                    <section id="main_section_testimonial_reviews">
                        <h1>Get Dinner Rocket Reviews</h1><br>
                        <ul>
                            <li>"I don't know how I ever caught roadrunners before this." (9/10)</li>
                            <li>"That thing was fast!" (8/10)</li>
                            <li>"Talk about fast delivery." (10/10)</li>
                            <li>"I didn't even have to pull the meat apart." (9/10)</li>
                            <li>"I'm on my thirtieth one. I love these things!" (10/10)</li>
                        </ul>
                    </section>
                </section>
            </main>
            <!--Child 2.4-->
            <footer id="article_footer">
                <hr>
                <ul>
                    <li><a href="#" title="Go to the Products Page">Products</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the Reviews Page">Reviews</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the Recipes Page">Recipes</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the Demos Page">Demos</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the First Aid Page">First Aid</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the Policy Page">Policy</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the About Page">About</a></li>
                    <li>|</li>
                    <li><a href="#" title="Go to the Contact Page">Contact</a></li>
                </ul>
                <p>&copy; ACME, All rights reserved.<br>
                    All images used are believed to be in "Fair Use". 
                    Please notify the author if any are not and they will be removed.</p>
            </footer>
        </section>
        <!--Child THREE - Right -->
        <aside id="body_aside_right">

        </aside>
    </body>
</html>