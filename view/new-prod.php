<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

$categories = getCategories();
// Build a select list using the $categories array
$catList = '<select name="catNameOption" id="catType">';
$catList .= "<option value='selectOption'>Choose a category</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if (isset($catNameOption)) {
        if ($category['categoryId'] === $catNameOption) {
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
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
                    <h1>Add Product</h1>
                    <p>Add a new product below. All fields are required.</p>
                    <form method="post" action="/acme/products/index.php">
                        <fieldset>
                            <label>Category</label>
                            <?php echo $catList; ?><br><br>

                            <label>Product Name</label>
                            <input type="text" name="invName" <?php if (isset($invName)) {
                                echo "value='$invName'";
                            } ?> required><br><br>

                            <label>Product Description</label>
                            <input type="text" name="invDescription" <?php if (isset($invDescription)) {
                                echo "value='$invDescription'";
                            } ?> required><br><br>

                            <!--http://localhost/acme/images/no-image.png-->
                            <label>Product Image (path to image)</label>
                            <input type="text" name="invImage" <?php if (isset($invImage)) {
                                echo "value='$invImage'";
                            } ?> required><br><br>

                            <label>Product Thumbnail (path to thumbnail)</label>
                            <input type="text" name="invThumbnail" <?php if (isset($invThumbnail)) {
                                echo "value='$invThumbnail'";
                            } ?> required><br><br>

                            <label>Product Price</label>
                            <input type="text" name="invPrice" <?php if (isset($invPrice)) {
                                echo "value='$invPrice'";
                            } ?> required pattern="\d+(\.\d{2})?"><br><br>

                            <label># in Stock</label>
                            <input type="text" name="invStock" <?php if (isset($invStock)) {
                                echo "value='$invStock'";
                            } ?> required><br><br>

                            <label>Shipping Size (W x H x L in inches)</label>
                            <input type="text" name="invSize" <?php if (isset($invSize)) {
                                echo "value='$invSize'";
                            } ?> required><br><br>

                            <label>Weight (lbs.)</label>
                            <input type="text" name="invWeight" <?php if (isset($invWeight)) {
                                echo "value='$invWeight'";
                            } ?> required><br><br>

                            <label>Location (city name)</label>
                            <input type="text" name="invLocation" <?php if (isset($invLocation)) {
                                echo "value='$invLocation'";
                            } ?> required><br><br>

                            <label>Vendor Name</label>
                            <input type="text" name="invVendor" <?php if (isset($invVendor)) {
                                echo "value='$invVendor'";
                            } ?> required><br><br>

                            <label>Primary Material</label>
                            <input type="text" name="invStyle" <?php if (isset($invStyle)) {
                                echo "value='$invStyle'";
                            } ?> required><br><br>


                            <!--<label>&nbsp;</label><br>-->
                            <input type="submit" class="submitButton" value="Add Product"><br><br>
                            <!--DONT FORGET THIS PART BELOW:-->
                            <input type="hidden" name="action" value="new-prod">
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