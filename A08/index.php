<?php
include("connect.php");


$creditCardFilter = isset($_GET['creditCardType']) ? $_GET['creditCardType'] : '';
$aircraftTypeFilter = isset($_GET['aircraftType']) ? $_GET['aircraftType'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';


$airportQuery = "SELECT * FROM flightlogs WHERE 1=1";

if ($creditCardFilter != '') {
    $airportQuery .= " AND creditCardType ='$creditCardFilter'";
}

if ($aircraftTypeFilter != '') {
    $airportQuery .= " AND aircraftType = '$aircraftTypeFilter'";
}

if ($sort != '') {
    $airportQuery = $airportQuery . " ORDER BY $sort";

    if ($order != '') {
        $airportQuery = $airportQuery . " $order";
    }
}

$result = executeQuery($airportQuery);

$creditCardQuery = "SELECT DISTINCT(creditCardType) FROM flightlogs";
$creditCardResults = executeQuery($creditCardQuery);

$aircraftTypeQuery = "SELECT DISTINCT(aircraftType) FROM flightlogs";
$aircraftTypeResults = executeQuery($aircraftTypeQuery);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flights</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col">

                <form method="GET">

                    <div class="card p-4 rounded-5">
                        <div class="h6">
                            Filter
                        </div>
                        <div class="d-flex flex-column flex-md-row align-items-center my-2">

                        <!-- Credit Card Type Filter -->
                        <label for="creditCardType" class="ms-2">Credit Card Type</label>
                        <select id="creditCardType" name="creditCardType" class="form-control ms-2"
                            style="width: fit-content">
                            <option value="">Default</option>
                            <?php
                            if (mysqli_num_rows($creditCardResults) > 0) {
                                while ($creditCardRow = mysqli_fetch_assoc($creditCardResults)) {
                                    $selected = ($creditCardFilter == $creditCardRow['creditCardType']) ? "selected" : "";
                                    echo "<option value='{$creditCardRow['creditCardType']}' $selected>{$creditCardRow['creditCardType']}</option>";
                                }
                            }
                            ?>
                        </select>

                         <!-- Aircraft Type Filter -->
                         <label for="aircraftType" class="ms-2">Aircraft Type</label>
                        <select id="aircraftType" name="aircraftType" class="form-control ms-2"
                            style="width: fit-content">
                            <option value="">Default</option>
                            <?php
                            if (mysqli_num_rows($aircraftTypeResults) > 0) {
                                while ($aircraftTypeRow = mysqli_fetch_assoc($aircraftTypeResults)) {
                                    $selected = ($aircraftTypeFilter == $aircraftTypeRow['aircraftType']) ? "selected" : "";
                                    echo "<option value='{$aircraftTypeRow['aircraftType']}' $selected>{$aircraftTypeRow['aircraftType']}</option>";
                                }
                            }
                            ?>
                        </select>


                        <!-- sort by -->
                        <label for="sort" class="ms-2">Sort By</label>
                        <select id="sort" name="sort" class="ms-2 form-control" style="width: fit-content">
                            <option value="">Default</option>

                            <option <?php if ($sort == "flightNumber") {
                                echo "selected";
                            } ?> value="flightNumber">Flight Number
                            </option>

                            <option <?php if ($sort == "departureAirportCode") {
                                echo "selected";
                            } ?>   value="departureAirportCode">Departure Airport Code
                            </option>

                            <option <?php if ($sort == "arrivalAirportCode") {
                                echo "selected";
                            } ?>   value="arrivalAirportCode">Arrival Airport Code
                            </option>

                            <option <?php if ($sort == "departureDatetime") {
                                echo "selected";
                            } ?>  value="departureDatetime">Departure Date time
                            </option>

                            <option <?php if ($sort == "arrivalDatetime") {
                                echo "selected";
                            } ?> value="arrivalDatetime">
                                Arrival Date time
                            </option>

                            <option <?php if ($sort == "flightDurationMinutes") {
                                echo "selected";
                            } ?>   value="flightDurationMinutes">Flight Duration
                            </option>

                            <option <?php if ($sort == "airlineName") {
                                echo "selected";
                            } ?> value="airlineName">Airline
                                Name
                            </option>

                            <option <?php if ($sort == "aircraftType") {
                                echo "selected";
                            } ?> value="aircraftType">
                                Aircraft Type
                            </option>

                            <option <?php if ($sort == "passengerCount") {
                                echo "selected";
                            } ?> value="passengerCount">
                                Passenger Count
                            </option>

                            <option <?php if ($sort == "ticketPrice") {
                                echo "selected";
                            } ?> value="ticketPrice">Ticket
                                Price</option>

                            <option <?php if ($sort == "creditCardNumber") {
                                echo "selected";
                            } ?>     value="creditCardNumber">Credit Card Number
                            </option>

                            <option <?php if ($sort == "creditCardType") {
                                echo "selected";
                            } ?> value="creditCardType">
                                Credit Card Type
                            </option>

                            <option <?php if ($sort == "pilotName") {
                                echo "selected";
                            } ?> value="pilotName">Pilot Name
                            </option>
                        </select>

                        <!-- order by -->
                        <label for="order" class="ms-2">Order</label>
                        <select id="order" name="order" class="ms-2 form-control" style="width: fit-content">
                            <option value="">Default</option>

                            <option <?php if ($order == "ASC") {
                                echo "selected";
                            } ?> value="ASC">Ascending</option>

                            <option <?php if ($order == "DESC") {
                                echo "selected";
                            } ?> value="DESC">Descending</option>
                        </select>
                    </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary ms-2 mt-4" style="width: fit-content">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col">
                <div class="card p-4 rounded-5">
                    <div class="table-responsive">
                    <table class="table text-center align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Flight Number</th>
                                <th scope="col">Departure Airport Code</th>
                                <th scope="col">Arrival Airport Code</th>
                                <th scope="col">Departure Date Time</th>
                                <th scope="col">Arrival Date Time</th>
                                <th scope="col">Flight Duration Minutes</th>
                                <th scope="col">Airline Name</th>
                                <th scope="col">Aircraft Type</th>
                                <th scope="col">Passenger Count</th>
                                <th scope="col">Ticket Price</th>
                                <th scope="col">Credit Card Number</th>
                                <th scope="col">Credit Card Type</th>
                                <th scope="col">Pilot Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($airportRow = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $airportRow['flightNumber'] ?></th>
                                        <td><?php echo $airportRow['departureAirportCode'] ?></td>
                                        <td><?php echo $airportRow['arrivalAirportCode'] ?></td>
                                        <td><?php echo $airportRow['departureDatetime'] ?></td>
                                        <td><?php echo $airportRow['arrivalDatetime'] ?></td>
                                        <td><?php echo $airportRow['flightDurationMinutes'] ?></td>
                                        <td><?php echo $airportRow['airlineName'] ?></td>
                                        <td><?php echo $airportRow['aircraftType'] ?></td>
                                        <td><?php echo $airportRow['passengerCount'] ?></td>
                                        <td><?php echo $airportRow['ticketPrice'] ?></td>
                                        <td><?php echo $airportRow['creditCardNumber'] ?></td>
                                        <td><?php echo $airportRow['creditCardType'] ?></td>
                                        <td><?php echo $airportRow['pilotName'] ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>