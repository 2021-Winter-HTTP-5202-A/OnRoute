<?php
    use ONROUTE\models\{Database,Flight};
    require_once 'vendor/autoload.php';
    require_once 'library/functions.php';
    $css = array("styles/flightBooking.css");//Add unqiue css files here
    require_once 'views/header.php';

    //Initialize variables for toggling display information
    $redirect = "";
    $hideTable = "";
    $hideBtn = "";
    $messageStatus = "<h3>Please verify the flight details are correct before completing booking confirmation.</h3>";

    //Instantiate database connection
    $db = Database::getDb();
    
    //Checks if $_POST value exist to see if user accessed page through flights.php search redirect
    if (empty($_POST)) {
        $hideTable = "style='display:none;'";
        $redirect = "style='display:block;'";
    }
    else{
        $redirect = "style='display:none;'";
        $flightId = $_POST['flightId'];
    
    //If flight number exisit (from flights.php page), utilize getFlightById to get the flight details
    $flightController = new Flight($db);

    //send flightId to controller 
    $response = $flightController->getFlightById($flightId);
    }

    //Executes if "Book Flight" button is clicked
    if (isset($_POST['confirmFlight'])){
        $finalFlightId = $_POST['flightId'];//Saves flightId as a POST data

        //When flight number submitted, instantiate db connection, utilize getFlightById
        $flightController = new Flight($db);

        //Adds flight to flightbooking and associates it with logged in user
        $addBooking = $flightController->addFlightBooking($_SESSION['userID'], $finalFlightId);
        $hideBtn = "style='display:none;'";
        $messageStatus = "<h3>Your flight has successfully been booked! Thank you for choosing OnRoute!</h3>";
    }

    //Checks if page is refreshed to prevent continuous updates to database. Redirects user back to flights if page is refreshed to start search again.

?>

<div class = "flightSelected">
    <h2 class="emptyMsg" <?= $redirect ?>> Looking to book a flight? </br> Click <a href="./flights.php">Here</a></h3> 
    <h2 <?= $hideTable ?> >Flight Details </h2>
    <div class="flightSelected__details" <?= $hideTable ?> >
        <ul>
            <?php 
                if (isset($response)){
            ?>
                <li><span class="listTitle">Depature Airport: </span> <?=  $response->departureairport; ?></li>
                <li><span class="listTitle">Arrival Airport: </span><?=  $response->arrivalairport; ?></li>
                <li><span class="listTitle">Depature Date: </span><?=  $response->departuredate; ?></li>
                <li><span class="listTitle">Depature Date: </span><?=  $response->arrivaldate; ?></li>
                <li><span class="listTitle">Airlines:</span> <?=  $response->airline; ?></li>
        </ul>
        <?= $messageStatus ?>
        <div class="flightSelected__details_btns" <?= $hideBtn ?>>
            <a href="./flights.php" class="bookBtn">Cancel<a>
            <form action="" method="POST">
                    <input type="hidden" name="flightId" value=" <?= $response->id; ?>"/>
                    <button type="submit" class="bookBtn" name="confirmFlight">Book Flight</button>
            </form>
        </div>
        <?php 
            } 
            ?>
    </div>
</div>

<?php
require_once 'views/footer.php';
?>