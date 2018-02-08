<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
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
                <?php echo $navList; ?>
            </nav>
            <!--Child 2.3-->
            <main id="article_main">
                <!--Child 2.3.1-->
                <section id="main_section_heading">

                </section>
                <!--Child 2.3.2-->
                <section id="main_section_hero">               
                    <?php
                    if (isset($message)) {
                        echo "<br>" . $message . "<br>";
                    }
                    ?>
                    <h1>Product Management</h1>
                    <p>Welcome to the product management page. Please choose an option below:</p><br>
                    <ul id="prod-mgmt-ul">
                        <li><a href="/acme/products/?action=new-cat-page" title="Go to the New Category Page">Add a New Category</a></li>
                        <li><a href="/acme/products/?action=new-prod-page" title="Go to the New Product Page">Add a New Product</a></li><br><br>
                    </ul>
                    <?php
                    if (isset($prodList)) {
                        echo $prodList;
                    }
                    ?>
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
        <!--Child THREE - Right -->
        <aside id="body_aside_right">

        </aside>
    </body>
</html>
<?php unset($_SESSION['message']); ?>