<?php
// users.php
require 'db.php';
require 'functions.php';
require 'auth.php';

if (!isAdmin()) {
    redirect('index.php');
}

$message = '';
$error = '';

// Add User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = sanitize($_POST['username']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Check if exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $error = "Username already exists.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $hash, $role])) {
            $message = "User added successfully.";
            logAction($pdo, 'Add User', "Created user: $username ($role)");
        } else {
            $error = "Failed to add user.";
        }
    }
}

// Delete User
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($id != $_SESSION['user_id']) { // Cannot delete self
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $message = "User deleted.";
        logAction($pdo, 'Delete User', "Deleted user ID: $id");
    } else {
        $error = "You cannot delete your own account.";
    }
}

$users = $pdo->query("SELECT * FROM users ORDER BY role ASC, username ASC")->fetchAll();

include 'includes/header.php';
?>

<div class="row">
    <!-- User List -->
    <div class="col-md-8 mb-4">
        <div class="glass-card h-100">
            <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-users" style="color: var(--primary-color);"></i> Existing Users</h3>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?php echo $u['id']; ?></td>
                            <td><span style="font-weight: 500; font-family: var(--font-heading);"><?php echo htmlspecialchars($u['full_name'] ?? '-'); ?></span></td>
                            <td><?php echo htmlspecialchars($u['username']); ?></td>
                            <td>
                                <span class="badge" style="<?php echo $u['role'] == 'admin' ? 'background:#FAD2E1; color:#ae2012' : ($u['role'] == 'manager' ? 'background:#FFE5D9; color:#9d0208' : 'background:#E8E8E4; color:#333'); ?>">
                                    <?php echo ucfirst($u['role']); ?>
                                </span>
                            </td>
                            <td><?php echo date('Y-m-d', strtotime($u['created_at'])); ?></td>
                            <td>
                                <?php if ($u['id'] != $_SESSION['user_id']): ?>
                                    <a href="?delete=<?php echo $u['id']; ?>" class="btn" style="color: #e76f51; padding: 5px;" onclick="return confirm('Delete this user?')"><i class="fas fa-trash"></i></a>
                                <?php else: ?>
                                    <span class="text-muted" style="font-size: 0.85rem;">Current User</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add User Form -->
    <div class="col-md-4 mb-4">
        <div class="glass-card h-100">
            <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-user-plus" style="color: var(--text-light);"></i> Add New User</h3>
            
            <form method="POST">
                <input type="hidden" name="add_user" value="1">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Username</label>
                    <input type="text" name="username" class="form-control" required style="padding: 0.8rem; border-radius: 8px;">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Role</label>
                    <select name="role" class="form-select" style="padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="staff">Staff</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Password</label>
                    <input type="password" name="password" class="form-control" required style="padding: 0.8rem; border-radius: 8px;">
                </div>
                <button type="submit" class="btn btn-primary w-100" style="padding: 10px;">Create User</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
