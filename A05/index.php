<?php
include 'connect.php';

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

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-kQv/Rz2ntXW/zSwkkd2MqlvYYHaaIh3im/a4q9nAoY4tsj90ppw+G4H+RtMGN4lY" crossorigin="anonymous"></script>
</body>
</html>
