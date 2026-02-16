<?php
// profile.php
require 'db.php';
require 'functions.php';
require 'auth.php';

// Ensure user is logged in
if (!isLoggedIn()) {
    redirect('login.php');
}

$message = '';
$error = '';

// Get current user info
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    // Should not happen if logged in
    session_destroy();
    redirect('login.php');
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $update_fields = [];
    $params = [];

    // Update Full Name
    if ($full_name !== $user['full_name']) {
        $update_fields[] = "full_name = ?";
        $params[] = $full_name;
    }

    // Update Password if provided
    if (!empty($new_password)) {
        if ($new_password === $confirm_password) {
            $update_fields[] = "password = ?";
            $params[] = password_hash($new_password, PASSWORD_DEFAULT);
        } else {
            $error = "Passwords do not match.";
        }
    }

    if (empty($error) && !empty($update_fields)) {
        $sql = "UPDATE users SET " . implode(", ", $update_fields) . " WHERE id = ?";
        $params[] = $user_id;
        
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($params)) {
             // Update session immediately
             if (isset($full_name)) {
                $_SESSION['full_name'] = $full_name;
             }
             $message = "Profile updated successfully.";
             
             // Refresh user data
             $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
             $stmt->execute([$user_id]);
             $user = $stmt->fetch();
             
             logAction($pdo, 'Update Profile', "User updated profile: " . $user['username']);
        } else {
            $error = "Failed to update profile.";
        }
    } elseif (empty($error) && empty($update_fields)) {
        $message = "No changes made.";
    }
}

$page_title = 'My Profile';
include 'includes/header.php';
?>

<div class="row">
    <!-- Profile Overview Sidebar -->
    <div class="col-lg-4 mb-4">
        <div class="glass-card text-center animate-slide-up h-100">
            <div class="profile-header mb-4">
                <div class="user-avatar-large mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--accent-rose)); color: white; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; box-shadow: 0 10px 20px rgba(176,137,104,0.2);">
                    <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
                </div>
                <h3 class="mb-1" style="font-family: var(--font-serif);"><?php echo htmlspecialchars($user['full_name'] ?? $user['username']); ?></h3>
                <p class="text-muted mb-3">@<?php echo htmlspecialchars($user['username']); ?></p>
                <div class="badge-role mb-3">
                    <span class="badge" style="background: var(--primary-light); color: var(--primary-dark); font-size: 0.75rem; padding: 0.5rem 1.2rem;"><?php echo strtoupper($user['role']); ?></span>
                </div>
            </div>
            
            <hr style="opacity: 0.1; margin: 2rem 0;">
            
            <div class="account-stats d-flex justify-content-around">
                <div class="text-center">
                    <div style="font-weight: 700; font-size: 1.2rem; color: var(--primary-color);">Member</div>
                    <div style="font-size: 0.8rem; color: var(--text-light);"><?php echo date('M Y', strtotime($user['created_at'] ?? 'now')); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Settings -->
    <div class="col-lg-8 mb-4">
        <div class="glass-card animate-slide-up delay-1 h-100">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-cog" style="font-size: 1.5rem; color: var(--primary-color); margin-right: 1rem;"></i>
                <h4 class="mb-0">Account Settings</h4>
            </div>

            <?php if ($message): ?>
                <div class="alert alert-success animate-fade-in"><i class="fas fa-check-circle"></i> <?php echo $message; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger animate-fade-in"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="font-weight: 600;">System ID (Username)</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" disabled style="background: rgba(0,0,0,0.03); cursor: not-allowed;">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="font-weight: 600;">Display Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="mt-4 mb-4">
                    <button type="button" class="btn" id="togglePasswordBtn" style="background: rgba(0,0,0,0.05); color: var(--text-light); font-size: 0.9rem;">
                        <i class="fas fa-key"></i> Change Password
                        <i class="fas fa-chevron-down ms-2" id="toggleIcon"></i>
                    </button>
                </div>

                <div id="passwordSection" style="display: none; height: 0; overflow: hidden; transition: all 0.4s ease; opacity: 0;">
                    <div class="p-3 border rounded-3 mb-4" style="background: rgba(176,137,104,0.05); border-color: rgba(176,137,104,0.1) !important;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" style="font-weight: 600;">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" style="font-weight: 600;">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Repeat new password">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center gap-3 mt-5">
                    <a href="index.php" class="btn" style="color: var(--text-light);">Back to Dashboard</a>
                    <button type="submit" class="btn btn-primary" style="padding: 10px 40px; border-radius: 50px;">
                        <i class="fas fa-save me-2"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordSection = document.getElementById('passwordSection');
    const toggleIcon = document.getElementById('toggleIcon');
    let isOpen = false;

    toggleBtn.addEventListener('click', function() {
        isOpen = !isOpen;
        if (isOpen) {
            passwordSection.style.display = 'block';
            setTimeout(() => {
                passwordSection.style.height = 'auto';
                passwordSection.style.opacity = '1';
                passwordSection.classList.add('animate-fade-in');
            }, 10);
            toggleIcon.className = 'fas fa-chevron-up ms-2';
            toggleBtn.style.background = 'rgba(176,137,104,0.1)';
            toggleBtn.style.color = 'var(--primary-dark)';
        } else {
            passwordSection.style.opacity = '0';
            passwordSection.style.height = '0';
            setTimeout(() => {
                passwordSection.style.display = 'none';
            }, 400);
            toggleIcon.className = 'fas fa-chevron-down ms-2';
            toggleBtn.style.background = 'rgba(0,0,0,0.05)';
            toggleBtn.style.color = 'var(--text-light)';
        }
    });
});
</script>

<style>
.delay-1 {
    animation-delay: 0.1s;
}
.profile-header h3 {
    letter-spacing: -0.5px;
}
.account-stats div {
    padding: 0 1rem;
}
</style>

<?php include 'includes/footer.php'; ?>
