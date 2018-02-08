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
        <!--Child ONE - Left------------------------------------------------ -->
        <aside id="body_aside_left">

        </aside>
        <!--Child TWO - Middle---------------------------------------------- -->
        <section id="body_article">
            <!--Child 2.1-->
            <header id="article_header">
                <img id="logoImage" src="/acme/images/logo.gif" alt="Logo Image"/>
                <section id="article_header_nav">
                    <ul>
                        <li>
                            <img id="helpImage" src="/acme/images/help.gif" alt="Help Question Mark Image"/>
                            <a href="#" class="menu-right" title="Need Help?">Help</a>
                        </li>
                        <li>
                            <img id="accountImage" src="/acme/images/account.gif" alt="Account Folder Image"/>
                            <a href=".?action=signin" class="menu-right" title="Go to your account">My Account</a>
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

                </section>
                <!--Child 2.3.2-->
                <section id="main_section_hero">
                    <br>
                    <h1>Server Error</h1>
                    <p>Sorry, the server experienced a problem.</p>
                </section>
                <!--Child 2.3.3-->                
                <section id="main_section_testimonial">

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
        <!--Child THREE - Right--------------------------------------------- -->
        <aside id="body_aside_right">

        </aside>
    </body>
</html>