<?php
include 'meal_db.php';
$obj = new Meal_db;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    echo $obj->getMealReviews($id);


}

else {
    $obj->addMealReview($_POST['meal_id'], $_POST['img'], $_POST['rate'], $_POST['name'], $_POST['city'], $_POST['review']);
}
?>