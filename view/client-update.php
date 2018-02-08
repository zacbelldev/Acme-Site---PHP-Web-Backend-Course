<?php
if (!$_SESSION['loggedin']) {
    header('location: /acme/');
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
                        echo $message;
                    }
                    ?>
                    <h1>Update Account</h1>
                    <p>Use this form to update your account information.</p>
                    <form method="post" action="/acme/accounts/index.php">
                        <fieldset> 
                            
                            <label>First Name:</label>
                            <input type="text" name="UpdateFirstname" <?php
                            if (isset($firstname)) {
                                echo "value='$firstname'";
                            } elseif (isset($UpdateFirstname)) {
                                echo "value='$UpdateFirstname'";
                            }
                            ?> required><br><br>

                            <label>Last Name:</label>
                            <input type="text" name="UpdateLastname" <?php
                            if (isset($lastname)) {
                                echo "value='$lastname'";
                            } elseif (isset($UpdateLastname)) {
                                echo "value='$UpdateLastname'";
                            }
                            ?> required><br><br>

                            <label>Email:</label>
                            <input type="text" name="UpdateEmail" <?php
                            if (isset($email)) {
                                echo "value='$email'";
                            } elseif (isset($UpdateEmail)) {
                                echo "value='$UpdateEmail'";
                            }
                            ?> required><br><br>

                            <input type="submit" name="submit" class='submitButton' value="Update Account"><br><br>
                            <input type="hidden" name="action" value="accountUpdate">
                            <input type="hidden" name="clientId" value="<?php
//                                   if (isset($clientData['clientId'])) {
//                                       echo $clientData['clientId'];
//                                   } else
                                       if (isset($clientId)) {
                                       echo $clientId;
                                   }
                            ?>">
                        </fieldset>
                    </form>                           
                    <h1>Password Change</h1>
                    <p>Use this form to change your password.</p>
                    <form method="post" action="/acme/accounts/index.php">
                        <fieldset>                           
                            <label for="password">New Password:</label>
                            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                            <input type="password" name="changePassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                            
                            <input type="submit" name="submit" class='submitButton' value="Change Password"><br><br>
                            <input type="hidden" name="action" value="changePassword">
                            <input type="hidden" name="clientId" value="<?php
                                   if (isset($clientData['clientId'])) {
                                       echo $clientData['clientId'];
                                   } elseif (isset($clientId)) {
                                       echo $clientId;
                                   }
                            ?>">
                        </fieldset>
                    </form>   
                    
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