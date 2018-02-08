<?php
if (!($_SESSION['clientData']['clientLevel'] > 1)) {
    header('location: /acme/');
    exit;
}

$categories = getCategories();

// Build the categories option list
$catList = '<select name="catType" id="catType">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if (isset($catType)) {
        if ($category['categoryId'] === $catType) {
            $catList .= ' selected ';
        }
    } elseif (isset($prodInfo['categoryId'])) {
        if ($category['categoryId'] === $prodInfo['categoryId']) {
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
        <title>
            <?php
            if (isset($prodInfo['invName'])) {
                echo "Modify $prodInfo[invName] ";
            } elseif (isset($prodName)) {
                echo $prodName;
            }
            ?> | Acme, Inc</title>
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
                    <h1>
                        <?php
                        if (isset($prodInfo['invName'])) {
                            echo "Modify $prodInfo[invName] ";
                        } elseif (isset($prodName)) {
                            echo $prodName;
                        }
                        ?>
                    </h1>
                    <form method="post" action="/acme/products/index.php">
                        <fieldset>
                            <label>Category</label>
                            <?php echo $catList; ?><br><br>

                            <label>Product Name</label>
                            <input type="text" name="prodName" <?php
                            if (isset($prodName)) {
                                echo "value='$prodName'";
                            } elseif (isset($prodInfo['invName'])) {
                                echo "value='$prodInfo[invName]'";
                            }
                            ?> required><br><br>

<!--                            <label>Product Description</label>
                            <textarea name="prodDesc" id="prodDesc" required>-->
                                <?php // if (isset($prodDesc)) {
//                                       echo $prodDesc;
//                                   } elseif (isset($prodInfo['invDescription'])) {
//                                       echo $prodInfo['invDescription'];
//                                   } ?>
                            <!--</textarea><br><br>-->
                            <label>Product Description</label>
                            <input type="text" name="prodDesc" <?php
                            if (isset($prodDesc)) {
                               echo "value='$prodDesc'";
                            } elseif (isset($prodInfo['invDescription'])) {
                                echo "value='$prodInfo[invDescription]'";
                            }
                            ?> required><br><br>

                            <!--http://localhost/acme/images/no-image.png-->
                            <label>Product Image (path to image)</label>
                            <input type="text" name="prodImg" <?php
                                if (isset($prodImg)) {
                                    echo "value='$prodImg'";
                                } elseif (isset($prodInfo['invImage'])) {
                                    echo "value='$prodInfo[invImage]'";
                                }
                            ?> required><br><br>

                            <label>Product Thumbnail (path to thumbnail)</label>
                            <input type="text" name="prodThumb" <?php
                            if (isset($prodThumb)) {
                                echo "value='$prodThumb'";
                            } elseif (isset($prodInfo['invThumbnail'])) {
                                echo "value='$prodInfo[invThumbnail]'";
                            }
                                   ?> required><br><br>

                            <label>Product Price</label>
                            <input type="text" name="prodPrice" <?php
                            if (isset($prodPrice)) {
                                echo "value='$prodPrice'";
                            } elseif (isset($prodInfo['invPrice'])) {
                                echo "value='$prodInfo[invPrice]'";
                            }
                                   ?> required pattern="\d+(\.\d{2})?"><br><br>

                            <label># in Stock</label>
                            <input type="text" name="prodStock" <?php
                            if (isset($prodStock)) {
                                echo "value='$prodStock'";
                            } elseif (isset($prodInfo['invStock'])) {
                                echo "value='$prodInfo[invStock]'";
                            }
                                   ?> required><br><br>

                            <label>Shipping Size (W x H x L in inches)</label>
                            <input type="text" name="prodSize" <?php
                            if (isset($prodSize)) {
                                echo "value='$prodSize'";
                            } elseif (isset($prodInfo['invSize'])) {
                                echo "value='$prodInfo[invSize]'";
                            }
                            ?> required><br><br>

                            <label>Weight (lbs.)</label>
                            <input type="text" name="prodWeight" <?php
                            if (isset($prodWeight)) {
                                echo "value='$prodWeight'";
                            } elseif (isset($prodInfo['invWeight'])) {
                                echo "value='$prodInfo[invWeight]'";
                            }
                            ?> required><br><br>

                            <label>Location (city name)</label>
                            <input type="text" name="prodLocation" <?php
                            if (isset($prodLocation)) {
                                echo "value='$prodLocation'";
                            } elseif (isset($prodInfo['invLocation'])) {
                                echo "value='$prodInfo[invLocation]'";
                            }
                            ?> required><br><br>

                            <label>Vendor Name</label>
                            <input type="text" name="prodVendor" <?php
                            if (isset($prodVendor)) {
                                echo "value='$prodVendor'";
                            } elseif (isset($prodInfo['invVendor'])) {
                                echo "value='$prodInfo[invVendor]'";
                            }
                            ?> required><br><br>

                            <label>Primary Material</label>
                            <input type="text" name="prodStyle" <?php
                            if (isset($prodStyle)) {
                                echo "value='$prodStyle'";
                            } elseif (isset($prodInfo['invStyle'])) {
                                echo "value='$prodInfo[invStyle]'";
                            }
                            ?> required><br><br>

                            <!--<label>&nbsp;</label><br>-->
                            <input type="submit" class="submitButton" value="Update Product"><br><br>
                            <!--DONT FORGET THIS PART BELOW:-->
                            <input type="hidden" name="action" value="updateProd">
                            <input type="hidden" name="prodId" value="<?php
                                   if (isset($prodInfo['invId'])) {
                                       echo $prodInfo['invId'];
                                   } else
                                       if (isset($prodId)) {
                                       echo $prodId;
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