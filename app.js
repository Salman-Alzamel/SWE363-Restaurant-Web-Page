// index
// check if objects are not null
if (document.getElementsByClassName("meal") || document.getElementsByClassName("add-to-cart-btn-index") != null) {
    // add to cart button
    function addToCartIndex(id, event) {
        location.href = "php/cart.php?id=" + id;
        event.stopPropagation();
    }
    // blue box
    function goToDetail(id) {
        location.href = "detail.php?id=" + id;
    }
}
function reloadPage() {
    location.reload();
}
// deatil
// check if objects are not null
if (document.getElementById("item-counter") != null && document.getElementById("minus-btn") != null && document.getElementById("plus-btn") != null || document.getElementById("add-to-cart-btn-detail") != null || document.getElementById("add-rev-btn") != null) {
    // add to cart button
    function addToCart(id) {
        location.href = "php/cart.php?id=" + id;
    }

    // nav bar counter
    var counter = document.getElementById("item-counter").value;
    document.getElementById("minus-btn").onclick = decreaseCounter;
    document.getElementById("plus-btn").onclick = increaseCounter;

    function decreaseCounter() {
        if (counter == 1) {
            counter = 1;
        } else {
            counter--;
        }
        document.getElementById("item-counter").value = counter;
    }
    function increaseCounter() {
        counter++;
        document.getElementById("item-counter").value = counter;
    }

    // slide review form
    document.getElementById("add-rev-btn").onclick = slide;
    var reviewForm = document.getElementById("review-form");
    function slide() {
        if (reviewForm.style.display != "grid") {
            reviewForm.style.paddingLeft = "100vw";
            reviewForm.style.display = "grid";
            var id = null;
            var pos = 100;
            clearInterval(id);
            id = setInterval(frame, 1);
            function frame() {
                if (reviewForm.style.paddingLeft == "0vw") {
                    clearInterval(id);
                } else {
                    pos -= 1;
                    reviewForm.style.paddingLeft = pos + "vw";
                }
            }
        }
    }
    // count letters in text area
    var textArea = document.getElementById("text-area");
    textArea.oninput = count;
    function count() {
        document.getElementById("msg").innerHTML = '';
        var characters = textArea.value.length;
        var counter = document.getElementById("counter");
        counter.innerHTML = characters + "/500";
    }
    // validate the form
    function validation() {
        var name = document.getElementById("name-input").value;
        // check name
        if (name == '') {
            name = "Customer"
        }
        // check if text area is empty
        if (textArea.value == '') {
            document.getElementById("msg").innerHTML = "Please type your review"
            return false;
        }
        // add review
        var mealId = document.getElementById("meal-id").value;
        var img = document.getElementById("img-input").files[0].name;
        var rate = document.getElementById("tickmarks").value;
        var city = document.getElementById("city-input").value;
        addReview(mealId, img, rate, name, city, textArea.value);
    }

    function showReviews(id) {
        var xhttp = new XMLHttpRequest();
        var array;
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                if (xhttp.responseText != '[]') {
                    var reviews = '<h3>Users Reviews</h3>';
                    var buttons = '<div class="carousel-indicators">';
                    var contents = '<div class="carousel-inner">';
                    var array = JSON.parse(xhttp.responseText);
                    for (i = 0; i < array.length; i++) {
                        if (i == 0) {
                            buttons += `
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 0"
                            style="background-color: #ffdd00;"></button>`;

                            contents += `
                            <div class="carousel-item active">
                                <div class="row">
                                    <img class="col-6 img-fluid" src="projectImages/` + array[i][5] + `" alt="review-img" />
                                    <div class="col-6">
                                        <h4>` + array[i][1] + `</h4>
                                        <h5>`+ array[i][2] + ` - ` + array[i][3] + ` &#11088;`.repeat(Number(array[i][4])) + `</h5>
                                        <p>` + array[i][6] + `</p>
                                    </div>
                                </div>
                            </div>`;
                        }
                        else {
                            buttons += `
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="` + i + `"
                            aria-current="true" aria-label="Slide ` + i + `"
                            style="background-color: #ffdd00;"></button>`;

                            contents += `
                            <div class="carousel-item">
                                <div class="row">
                                    <img class="col-6 img-fluid" src="projectImages/` + array[i][5] + `" alt="review-img" />
                                    <div class="col-6">
                                        <h4>` + array[i][1] + `</h4>
                                        <h5>`+ array[i][2] + ` - ` + array[i][3] + ` &#11088;`.repeat(Number(array[i][4])) + `</h5>
                                        <p>` + array[i][6] + `</p>
                                    </div>
                                 </div>
                            </div>`;
                        }

                    }
                    buttons += '</div>';
                    contents += '</div>';
                    reviews = reviews + buttons + contents;
                    document.getElementById("carouselExampleIndicators").innerHTML = reviews;
                }
                else {
                    document.getElementById("carouselExampleIndicators").innerHTML = '<h3>No Reviews</h3>';
                }

            }
        }
        xhttp.open("GET", "php/review.php?id=" + id, true);
        xhttp.send();
    }
    function addReview(mealId, img, rate, name, city, review) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                showReviews(mealId);
                reviewForm.style.display = "none";
            }
        }
        xhttp.open("POST", "php/review.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var post = "meal_id=" + mealId + "&img=" + img + "&rate=" + rate + "&name=" + name + "&city=" + city + "&review=" + review;
        xhttp.send(post);
    }
}