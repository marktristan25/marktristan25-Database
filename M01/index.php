<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userInfoID']) && isset($_POST['cityID']) && isset($_POST['provinceID'])) {
    $userInfoID = $_POST['userInfoID'];
    $cityID = $_POST['cityID'];
    $provinceID = $_POST['provinceID'];

    $insertQuery = "INSERT INTO addresses (userInfoID, cityID, provinceID)
                    VALUES ('$userInfoID', '$cityID', '$provinceID')";

    if ($conn->query($insertQuery) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}

$sql = "SELECT * FROM addresses"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container">
    <span class="fw-bolder navbar-brand mb-0 h1 text-white">ADDRESS</span>
  </div>
</nav>

<div class="container my-5">
    <div class="txt text-center fw-bolder display-6 mb-4">ADDRESS IDs</div>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Address ID</th>
                    <th>User Info ID</th>
                    <th>City ID</th>
                    <th>Province ID</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['addressID']); ?></td>
                        <td><?php echo htmlspecialchars($row['userInfoID']); ?></td>
                        <td><?php echo htmlspecialchars($row['cityID']); ?></td>
                        <td><?php echo htmlspecialchars($row['provinceID']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center">No data available in the database.</div>
    <?php endif; ?>

    <form method="post" class="mt-5 d-flex flex-column align-items-center">
    <div class="mb-3 w-50">
        <label for="userInfoID" class="form-label fw-bolder">User Info ID</label>
        <input type="text" class="form-control" id="userInfoID" name="userInfoID" required>
    </div>
    <div class="mb-3 w-50">
        <label for="cityID" class="form-label fw-bolder">City ID</label>
        <input type="text" class="form-control" id="cityID" name="cityID" required>
    </div>
    <div class="mb-3 w-50">
        <label for="provinceID" class="form-label fw-bolder">Province ID</label>
        <input type="text" class="form-control" id="provinceID" name="provinceID" required>
    </div>
    <div class="d-flex justify-content-center w-50">
        <button type="submit" class="btn btn-primary">SUBMIT</button>
    </div>
    </form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-kQv/Rz2ntXW/zSwkkd2MqlvYYHaaIh3im/a4q9nAoY4tsj90ppw+G4H+RtMGN4lY" crossorigin="anonymous"></script>
</body>
</html>
