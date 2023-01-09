<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>detail.php</title>
</head>

<body>
    <?php include 'include/inc.header.php'; ?>
    <main id="gallery-detail" class="aligment">
        <section id="meal-info" class="container-fluid">
            <div class="row">
                <?php
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                    $obj = new Meal;
                    $meal = $obj->getMealById($id);
                    include 'php/meal_db.php';
                    $obj1 = new Meal_db();
                    echo  $obj1->getMealById($id);
                ?>
            </div>
        </section>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#description-info" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#reviews"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="showReviews(<?php echo $id; ?>)">Reviews</button>
            </li>
        </ul>
    </main>

    <div class="tab-content" id="pills-tabContent">
        <section class="tab-pane fade show active aligment" id="description-info" role="tabpanel">
            <h3>description</h3>
            <p><?php echo $meal["description"]; ?></p>
            <h4>nutrition facts</h4>
            <table id="nutrition-table">
                <tr>
                    <td colspan="3"><strong>Supplement Facts</strong></td>
                </tr>
                <?php
                    echo '
                        <tr>
                            <td colspan="3"><strong>Serving Size:</strong> ' . $meal["nutrition"]["serving_size"] . '</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Serving Per Container:</strong> ' . $meal["nutrition"]["serving_per_container"] . '</td>
                        </tr>';
                ?>
                <tr>
                    <td></td>
                    <td><strong>Amount Per Serving</strong></td>
                    <td><strong>%Daily Value*</strong></td>
                </tr>
                <?php
                for ($i = 0; $i < count($meal); $i++) {
                    echo '
                    <tr>
                    <td>' . $meal["nutrition"]["facts"][$i]["item"] . '</td>
                    <td>' . $meal["nutrition"]["facts"][$i]["amount_per_serving"] . ' ' . $meal["nutrition"]["facts"][$i]["unit"] . '</td>
                    <td>' . $meal["nutrition"]["facts"][$i]["daily_value"] . '</td>
                </tr>
                    ';
                }
                ?>
                <tr>
                    <td colspan="3">* Percent Daily Values are based on a 2,000 calorie dite. Your daily values may
                        be
                        higher or loewr depending on your calorie needs</td>
                </tr>
            </table>
        </section>
        <section class="tab-pane fade aligment" id="reviews" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container-fluid">
                <section id="reviews-container" class="row">
                    <section id="container-fulid">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

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
                    <input id="add-rev-btn" type="button" value="Add Your Review">
                </section>
                <form id="review-form">
                    <input id="meal-id" type="hidden" name="meal_id" value="<?php echo $id; ?>" />
                    <label for="img">Image</label>
                    <input id="img-input" name="img" type="file" accept="image/*">
                    <label>Rate the Food</label>
                    <input id="tickmarks" name="rate" type="range" list="tickmarks-list" min="0" max="5" step="1">
                    <datalist id="tickmarks-list">
                        <option value="0"></option>
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                        <option value="4"></option>
                        <option value="5"></option>
                    </datalist>
                    <label for="name-input">Name</label>
                    <input id="name-input" type="text" name="fname&lname" placeholder="First and Last name">
                    <label for="city-input">City</label>
                    <input id="city-input" type="text" name="city" placeholder="City">
                    <label for="text-area">Review</label>
                    <p id="msg"></p>
                    <textarea id="text-area" name="textarea" rows="15" cols="50"
                        placeholder="Type your review max 500 characters" maxlength="500"></textarea>
                    <p id="counter">0 / 500</p>
                    <input id="sumbit-btn" type="button" value="Submit" onclick="validation()">
                </form>
            </div>
        </section>
    </div>      
    <?php include 'include/inc.footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="app.js"></script>
</body>

</html>