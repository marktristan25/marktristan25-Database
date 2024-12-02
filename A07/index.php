<?php
include 'connect.php';



if (isset($_POST['btnSubmit'])) {

    $userInfoID = $_POST['userInfoID'];
    $cityID = $_POST['cityID'];
    $provinceID = $_POST['provinceID'];

    $insertQuery = "INSERT INTO addresses (userInfoID, cityID, provinceID)
                        VALUES ('$userInfoID', '$cityID', '$provinceID')";
    executeQuery($insertQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

} else if (isset($_POST['btnEdit'])) {

    $addressID = $_POST['addressID'];
    $userInfoID = $_POST['userInfoID'];
    $cityID = $_POST['cityID'];
    $provinceID = $_POST['provinceID'];

    $editQuery = "UPDATE addresses 
                      SET userInfoID = '$userInfoID', cityID = '$cityID', provinceID = '$provinceID'
                      WHERE addressID = '$addressID'";
    executeQuery($editQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if (isset($_GET['editAddressID'])) {
    $editID = $_GET['editAddressID'];
    $editQuery = "SELECT * FROM addresses WHERE addressID = '$editID'";
    executeQuery($editQuery);


} else {
    $editData = null;
}

if (isset($_POST['deleteAddressID'])) {
    $deleteID = $_POST['deleteAddressID'];
    $deleteQuery = "DELETE FROM addresses WHERE addressID = '$deleteID'";
    executeQuery($deleteQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$query = "SELECT * FROM addresses";
$result = executeQuery($query);
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

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Address ID</th>
                        <th>User Info ID</th>
                        <th>City ID</th>
                        <th>Province ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['addressID']); ?></td>
                            <td><?php echo htmlspecialchars($row['userInfoID']); ?></td>
                            <td><?php echo htmlspecialchars($row['cityID']); ?></td>
                            <td><?php echo htmlspecialchars($row['provinceID']); ?></td>
                            <td>
                                <div class="d-flex justify-content-evenly align-items-center">
                                    <a href="?editAddressID=<?php echo $row['addressID']; ?>"
                                        class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form method="post">
                                        <input type="hidden" name="deleteAddressID" value="<?php echo $row['addressID']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No data available in the database.</div>
        <?php endif; ?>

        <form method="post" class="mt-5 d-flex flex-column align-items-center">
            <input type="hidden" name="addressID"
                value="<?php echo $editData ? htmlspecialchars($editData['addressID']) : ''; ?>">
            <div class="mb-3 w-50">
                <label for="userInfoID" class="form-label fw-bolder">User Info ID</label>
                <input type="text" class="form-control" id="userInfoID" name="userInfoID"
                    value="<?php echo $editData ? htmlspecialchars($editData['userInfoID']) : ''; ?>" required>
            </div>
            <div class="mb-3 w-50">
                <label for="cityID" class="form-label fw-bolder">City ID</label>
                <input type="text" class="form-control" id="cityID" name="cityID"
                    value="<?php echo $editData ? htmlspecialchars($editData['cityID']) : ''; ?>" required>
            </div>
            <div class="mb-3 w-50">
                <label for="provinceID" class="form-label fw-bolder">Province ID</label>
                <input type="text" class="form-control" id="provinceID" name="provinceID"
                    value="<?php echo $editData ? htmlspecialchars($editData['provinceID']) : ''; ?>" required>
            </div>
            <div class="d-flex justify-content-center w-50">
                <button type="submit" name="<?php echo $editData ? 'btnEdit' : 'btnSubmit'; ?>"
                    class="btn btn-<?php echo $editData ? 'success' : 'primary'; ?>">
                    <?php echo $editData ? 'Update' : 'Submit'; ?>
                </button>
            </div>
        </form>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kQv/Rz2ntXW/zSwkkd2MqlvYYHaaIh3im/a4q9nAoY4tsj90ppw+G4H+RtMGN4lY"
            crossorigin="anonymous"></script>
</body>

</html>