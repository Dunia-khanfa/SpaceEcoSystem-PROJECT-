<?php
// 1. Database Connection Credentials
$servername = "localhost";
$username = "duniakh_space_eco"; 
$password = "212610471@qq";
$dbname = "duniakh_spaceeco";

// 2. Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->error);
}

// 4. Fetch all data from the database
$sql = "SELECT * FROM waste_log ORDER BY waste_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaceEco - Waste Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="tracking-page">

    <header>
        <div class="logo">
            <i class="fas fa-recycle"></i>
            <span>SpaceEco System</span>
        </div>
        <div class="user-info">
            Welcome, <span id="currentUser">Guest</span> <i class="fas fa-user-astronaut"></i>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="Tips & Info.html">Tips & Info</a></li>
            <li><a href="Waste managment.html">Waste Management</a></li>
            <li><a href="Log Waste.html">Log Waste</a></li>
            <li><a href="tracking.php" class="active">Tracking</a></li>
        </ul>
    </nav>

    <div class="page-layout">

        <main class="main-content">
            <section class="content-header">
                <h2 class="section-title">Waste Tracking Dashboard</h2>
                <p>Real-time data monitoring of station waste levels.</p>
            </section>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Current Waste Levels</h5>
                    
                    <a href="clear-db.php" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete ALL records from the database?');">
                        <i class="fas fa-trash"></i> Clear History
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Weight (kg)</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="wasteTableBody">
                                <?php
                                // 5. Display the Data in the Table
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row["waste_date"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["waste_type"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["weight_kg"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["notes"]) . "</td>";
                                        
                                        // Generate an action button based on waste type
                                        if ($row["waste_type"] == "Plastic" || $row["waste_type"] == "Paper") {
                                            echo "<td><button class='btn btn-sm btn-outline-primary'>Compress</button></td>";
                                        } else if ($row["waste_type"] == "Organic") {
                                            echo "<td><button class='btn btn-sm btn-outline-success'>Process</button></td>";
                                        } else {
                                            echo "<td><button class='btn btn-sm btn-outline-warning'>Recycle</button></td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    // If the database is empty
                                    echo "<tr><td colspan='5' class='text-center text-muted py-4'><i class='fas fa-box-open fa-2x mb-2'></i><br>No waste logged yet.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <aside>
            <h3>Bin Capacity</h3>
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="small text-muted">Dry Compactor</label>
                    <small class="text-success">45%</small>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 45%;"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="small text-muted">Wet Trash (K-BAR)</label>
                    <small class="text-warning">78%</small>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 78%;"></div>
                </div>
            </div>

            <hr class="divider">

            <h3>Weekly Stats</h3>
            <ul class="list-unstyled small">
                <li class="d-flex justify-content-between py-1 border-bottom">
                    <span>Total Mass:</span> <strong>124.5 kg</strong>
                </li>
                <li class="d-flex justify-content-between py-1 border-bottom">
                    <span>Recycling Rate:</span> <strong class="text-success">92%</strong>
                </li>
            </ul>
        </aside>

    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 SpaceEco - Created by Roie, Reut & Dunia</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/main.js"></script>
    </body>
</html>