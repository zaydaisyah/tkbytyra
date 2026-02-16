<?php
// audit.php
require 'db.php';
require 'functions.php';
require 'auth.php';

if (!isAdmin()) {
    redirect('index.php');
}

$stmt = $pdo->query("SELECT a.*, u.username, u.full_name FROM audit_logs a LEFT JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC LIMIT 100");
$logs = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="glass-card animate-fade-in">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="color: var(--text-main);"><i class="fas fa-history" style="color: var(--accent-dark);"></i> Audit Log</h3>
        <div class="btn-group" style="display: flex; gap: 8px; align-items: center;">
            <button onclick="exportAuditToExcel()" class="btn btn-sm" style="background: #2D6A4F; color: white; border-radius: 8px; padding: 5px 12px; font-size: 0.85rem;">
                <i class="fas fa-file-excel"></i> Excel
            </button>
            <button onclick="exportAuditToPDF()" class="btn btn-sm" style="background: #D00000; color: white; border-radius: 8px; padding: 5px 12px; font-size: 0.85rem;">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
            <span class="badge" style="background: var(--secondary-color); color: var(--text-main); font-size: 0.9rem; margin-left: 10px;">Last 100 Events</span>
        </div>
    </div>

    <div class="table-container">
        <table id="auditTable">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td style="color: var(--text-light); font-size: 0.9em;"><?php echo htmlspecialchars($log['created_at']); ?></td>
                        <td>
                            <strong style="font-family: var(--font-heading);"><?php echo htmlspecialchars($log['full_name'] ?? $log['username'] ?? 'System/Unknown'); ?></strong>
                            <br>
                            <small class="text-muted">@<?php echo htmlspecialchars($log['username'] ?? 'unknown'); ?></small>
                        </td>
                        <td><span class="badge" style="background: rgba(212, 163, 115, 0.2); color: var(--primary-color);"><?php echo htmlspecialchars($log['action']); ?></span></td>
                        <td style="color: var(--text-main);"><?php echo htmlspecialchars($log['details']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Export Libraries -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<script>
function exportAuditToExcel() {
    const table = document.getElementById('auditTable');
    const filename = 'audit_log_' + new Date().toISOString().slice(0,10) + '.xlsx';
    const wb = XLSX.utils.table_to_book(table, { sheet: "Audit Log" });
    XLSX.writeFile(wb, filename);
}

function exportAuditToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4');
    
    doc.setFontSize(18);
    doc.text("Audit Log Report", 14, 15);
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text("Generated on: " + new Date().toLocaleString(), 14, 22);
    
    doc.autoTable({
        html: '#auditTable',
        startY: 30,
        styles: { fontSize: 8, cellPadding: 2 },
        headStyles: { fillColor: [176, 137, 104], textColor: 255 },
        columnStyles: {
            0: { cellWidth: 40 },
            1: { cellWidth: 50 },
            2: { cellWidth: 40 },
            3: { cellWidth: 'auto' }
        },
        didParseCell: function(data) {
            // Optional: improve text cleanup for user column if needed
        }
    });
    
    doc.save('audit_log_' + new Date().toISOString().slice(0,10) + '.pdf');
}
</script>

<?php include 'includes/footer.php'; ?>
