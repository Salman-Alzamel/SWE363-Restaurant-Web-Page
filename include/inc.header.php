<header id="header">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
            <div class="container-fluid mt-4 aligment">
                <a class="navbar-brand" href="#"><img src="projectImages/logo-white.svg" alt="logo white" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php#header">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#menu">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#gallery">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#testimonials">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacts">Contact Us</a>
                        </li>
                        <li class="nav-item red-nav-item">
                            <a class="nav-link" href="#">Search</a>
                        </li>
                        <li class="nav-item red-nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                        <li class="nav-item red-nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">Cart <span id="cart-counter">
                            <?php
                            if (isset($_COOKIE['cart'])) {
                                $cookie = $_COOKIE['cart'];
                                $cookie = stripslashes($cookie);
                            $IDSArray = json_decode($cookie, true);
                            if (!empty($IDSArray)){
                                echo count($IDSArray);
                            }
                            else {
                                echo '0';
                            }
                            }
                            else {
                                echo '0';
                            }
                            ?>
                            </span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</header>
<form method="post" action="php/order.php">
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content container-fluid">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <table id="cart-table">
                    <tr>
                        <td>Item</td>
                        <td>Price</td>
                    </tr>
                    <?php
                    include 'php/meal.php';
                    $obj1 = new Meal();
                    $total = (float)0;
                    if (!empty($IDSArray)) {
                        for ($i = 0; $i < count($IDSArray); $i++){
                            $meals = $obj1->getMealById((int)$IDSArray[$i]-1);
                            echo '
                            <tr>
                                <input type="hidden" name="id[]" value="' . $meals["id"] . '" />
                                <td class="col-6">' . $meals["title"] . '</td>
                                <td class="col-6">' . $meals["price"] . ' SAR</td>
                            </tr>
                            ';
                            $total += (float)$meals["price"];
                        }
                    }
                    echo '
                    <tr>
                        <input type="hidden" name="total" value="' . $total . '" />
                        <td class="col-6">Total price</td>
                        <td class="col-6">' . $total . ' SAR</td>
                    </tr>
                    ';
                    ?>
                </table>
            </div>
            <div class="modal-footer">
                <input id="modal-close-btn" type="button" value="close" data-bs-dismiss="modal" />
                <input id="modal-order-btn" type="submit" value="Order Now" />
            </div>
        </div>
    </div>
</div>
</form>