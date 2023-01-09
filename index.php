<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>index.php</title>
</head>

<body>
    <?php include 'include/inc.header.php';?>
    <main id="party-time">
        <div id="party-time-container" class="d-flex flex-column aligment">
            <h1>Party Time</h1>
            <div id=shape1 class="mt-auto">
                <h3>Buy any 2 burgers and get 1.5L Pepsi Free</h3>
            </div>
            <button class="mt-auto">Order Now</button>
        </div>
    </main>
        <?php
        if (isset($_COOKIE['recent-bought'])) { ?>
        <section id="recent-bought" class="aligment">
            <h2>Your Recent Bought Products</h2>
            <div class="container">
                <div id="meals-container" class="row">
            <?php
            $cookie1 = $_COOKIE['recent-bought'];
            include 'php/meal.php';
            $obj2 = new Meal;
            $meals2 = $obj2->getAllMeals();
            $recentBought = null;
            $cookie1 = stripslashes($cookie1);
            $IDSArray1 = json_decode($cookie1, true);
            $unique = array_unique($IDSArray1);
            for ($i = 0; $i < count($unique); $i++) {
                echo '
                <div class="card col-sm-12 col-md-4 col-lg-3 meal" onclick="goToDetail(' . $meals2[$unique[$i]-1]["id"] .')">
                    <img src="projectImages/' . $meals2[$unique[$i]-1]["image"] . '" class="card-img-top" alt="meal ' . $num = $unique[$i]-1+1 .'">
                    <div class="card-body">
                        <p class="card-text"><a href="#" class="rating">&#11088;' . $meals2[$unique[$i]-1]["rating"] . ' Rating</a></p>
                        <h5 class="card-title"><a href="" class="sandwich" class="meal-name">' . $meals2[$unique[$i]-1]["title"] . '</a></h5>
                        <p class="card-text"><a href="" class="description">Some description</a></p>
                        <div>
                        <input class="add-to-cart-btn-index" type="button" value="Buy Again" onclick="addToCartIndex(' . $meals2[$unique[$i]-1]["id"] . ', event)" />
                            <a class="price" href="">' . $meals2[$unique[$i]-1]["price"] . ' SAR</a>
                        </div>
                    </div>
                </div>';
            }
            
        }
        ?>
        </div>
        </div>
        </section>
    <section id="menu">
        <h2 class="aligment">Want To Eat</h2>
        <p class="aligment">Try our most delicious food and usually take minnutes to deliver</p>
        <div id="menu-container" class="aligment">
            <a href="#">pizza</a>
            <a href="#">fast food</a>
            <a href="#">cupcake</a>
            <a href="#">sandwich</a>
            <a href="#">spaghetti</a>
            <a href="#">burger</a>
        </div>
        <div id="menu-background" class="container-fluid">
            <div class="row">
                <img class="col-md-12 col-lg-6 img-fluid" src="projectImages/delivery.png" alt="delivery" />
                <div class="col-md-12 col-lg-6">
                    <div id="shape2">
                        <h2>We guarantee 30 minutes delivery</h2>
                    </div>
                    <p>If you are having a meeting, working late at night and need an extra push</p>
                </div>
            </div>
        </div>
    </section>
    <section id="gallery" class="aligment">
        <h2>Our Most Popular Recipes</h2>
        <section id="blue-box" class="container">
            <p>Try our most delicious food and usually take minutes to deliver</p>
            <div id="meals-container" class="row">
            <?php
            include 'php/meal_db.php';
            $obj = new Meal_db;
            echo  $obj->getAllMeals();
    ?>
            </div>
        </section>
    </section>
    <section id="testimonials" class="aligment">
        <h2>Clients Testimonials</h2>
        <section id="container-fulid">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"
                        style="background-color: #ffdd00;"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2" style="background-color: #ffdd00;"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3" style="background-color: #ffdd00;"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <div class="row">
                            <img class="col-md-12 col-lg-6 img-fluid" src="projectImages/man-eating-burger.png"
                                class="d-block w-100" alt="man eating burger">
                            <p class="col-md-12 col-lg-6 m-auto">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Neque
                                ullam deserunt laborum, laboriosam
                                veritatis
                                quibusdam blanditiis dolor exercitationem velit commodi quae assumenda incidunt
                                voluptas. Corporis ex
                                nulla
                                repellendus ullam nihi..!</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <div class="row">
                            <img class="col-md-12 col-lg-6 img-fluid" src="projectImages/man-eating-burger.png"
                                class="d-block w-100" alt="man eating burger">
                            <p class="col-md-12 col-lg-6 m-auto">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Neque
                                ullam deserunt laborum, laboriosam
                                veritatis
                                quibusdam blanditiis dolor exercitationem velit commodi quae assumenda incidunt
                                voluptas. Corporis ex
                                nulla
                                repellendus ullam nihi..!</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <img class="col-md-12 col-lg-6 img-fluid" src="projectImages/man-eating-burger.png"
                                class="d-block w-100" alt="man eating burger">
                            <p class="col-md-12 col-lg-6 m-auto">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Neque
                                ullam deserunt laborum, laboriosam
                                veritatis
                                quibusdam blanditiis dolor exercitationem velit commodi quae assumenda incidunt
                                voluptas. Corporis ex
                                nulla
                                repellendus ullam nihi..!</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
    </section>
    <?php include 'include/inc.footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="app.js"></script>
</body>

</html>