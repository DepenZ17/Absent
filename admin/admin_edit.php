<?php 
// Include database connection
include '../koneksi.php';

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the user data based on the ID
    $sql = "SELECT * FROM tb_admin WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    
    // Check if the user data exists
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}

// Handle form submission to update user data
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    
    // Cek apakah password baru diisi
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $user['password']; // Jika password tidak diisi, gunakan password yang ada

    // Update the user data in the database
    $sql_update = "UPDATE tb_admin SET username = '$username', password = '$password' WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: ../datauser.php"); // Redirect to the list page
        exit;
    } else {
        echo "Error updating user: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="icon" href="../img/Absensi.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="id">User ID</label>
                <input type="text" class="form-control" id="id" value="<?php echo $user['id']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (leave blank to keep current)">
            </div>

            <button type="submit" class="btn btn-primary" name="update">Ubah Data</button>
            <a href="../datauser.php" class="btn btn-danger">Batal</a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
