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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .txt {
            font-weight: bold;
            font-size: 32px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="txt">addresses</div>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Address ID</th>
                    <th>User Info ID</th>
                    <th>City ID</th>
                    <th>Province ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()): ?>
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
        <p>No data available in the database.</p>
    <?php endif; ?>

</div>

</body>
</html>
