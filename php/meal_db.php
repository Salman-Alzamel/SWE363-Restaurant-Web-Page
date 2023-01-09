<?php
class Meal_db {
    private $connection;
    public $mealRating = 0;
    
    function __construct() {
        $this-> connection = mysqli_connect("localhost", "root", "Na0535398335@", "meals");
        $error = mysqli_connect_error();
        if ($error != null) {
            $output = "<p> Unable to connect to database</p>" . $error;
            exit($output);
        }
    }

    function getAllMeals() {
        $sql ="SELECT * FROM meal";
        $result = mysqli_query($this->connection, $sql);
        $allMeals = '';
       while ($meals = mysqli_fetch_array($result)) {
        $this->avrageRating($meals['id']);
        $allMeals .= '
        <div class="card col-sm-12 col-md-4 col-lg-3 meal" onclick="goToDetail(' . $meals['id'] .')">
            <img src="projectImages/' . $meals['image'] . '" class="card-img-top" alt="meal ' . $meals['id'] .'">
            <div class="card-body">
                <p class="card-text"><a href="#" class="rating">&#11088; ' . $this->mealRating . ' Rating</a></p>
                <h5 class="card-title"><a href="" class="sandwich" class="meal-name">' . $meals['title'] . '</a></h5>
                <p class="card-text"><a href="" class="description">Some description</a></p>
                <div>
                <input class="add-to-cart-btn-index" type="button" value="add to cart" onclick="addToCartIndex(' . $meals['id'] . ', event)" />
                    <a class="price" href="">' . $meals['price'] . ' SAR</a>
                </div>
            </div>
        </div>';
        $this->mealRating = 0;
    }
    mysqli_free_result($result);
    $this->closeCon();
    return $allMeals;
    }

    function closeCon() {
        mysqli_close($this-> connection);
    }
    function getMealById($id) {
        $this->avrageRating($id);

        $sql = "SELECT * FROM meal WHERE id=" . $id ;
        $result = mysqli_query($this->connection, $sql);
        $oneMeal = '';
        while ($meal = mysqli_fetch_array($result)) {
            $oneMeal .= '
            <img class="col-md-12 col-lg-6 img-fluid" src="projectImages/' . $meal['image'] . '" alt="meal' . $meal['id'] . '" />
            <div class="col-md-12 col-lg-6">
                <h1>' . $meal['title']  . '</h1>
                <p>' . $meal['price'] . ' SAR</p>
                <p> &#11088;' . $this->mealRating . ' Rating</p>
                <p>' . $meal['description'] . '</p>
                <section id="buttons-container">
                    <section>
                        <input id="minus-btn" type="button" value="-" />
                        <input id="item-counter" type="button" value="1" />
                        <input id="plus-btn" type="button" value="+" />
                    </section>
                    <input id="add-to-cart-btn-detail" type="button" value="add to cart" onclick="addToCart(' . $meal['id'] . ')" />
                </section>
            </div>';
        }
        mysqli_free_result($result);
        $this->closeCon();
        return $oneMeal;
    }

    function getMealReviews($id) {
        $sql ="SELECT * FROM reviews WHERE meal_id = " . $id;
        $result = mysqli_query($this->connection, $sql);
        $jsonArr = [];
        while ($meal = mysqli_fetch_array($result)) {
            $jsonArr[] = $meal;
        }
        $jsonArr = json_encode($jsonArr);

        mysqli_free_result($result);
        $this->closeCon();

        return $jsonArr;
    }

    function addMealReview($meal_id, $img, $rate, $name, $city, $textarea) {
        $sql = "INSERT INTO reviews(reviewer_name, city, rating, image, review, meal_id) VALUES
        ('" . $name . "', '" . $city . "', '" . $rate . "', '" . $img . "', '" . $textarea . "', '" . $meal_id . "')";
        
        if (mysqli_query($this->connection, $sql)) {
            echo "Records inserted successfully.";
        } else {
            echo "error";
        }

    }

    function avrageRating($id) {
        $sql ="SELECT * FROM reviews WHERE meal_id = " . $id;
        $result = mysqli_query($this->connection, $sql);
        $cont = 0;
        $mRate = 0;
        while ($meal = mysqli_fetch_array($result)) {
                    $cont++;
                    $mRate+=$meal['rating'];
        }
        if($cont != 0) {
            $this->mealRating = $mRate/$cont;
        }
        
    }

}
?>