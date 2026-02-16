<?php
// reports.php
require 'db.php';
require 'functions.php';
require 'auth.php';

if (!isManager()) {
    redirect('index.php');
}

$type = isset($_GET['type']) ? $_GET['type'] : 'summary';
$report_data = [];
$report_title = "Stock Summary Report";

if ($type == 'summary') {
    $stmt = $pdo->query("SELECT p.name, c.name as category, p.cost_price, p.selling_price, p.quantity, (p.quantity * p.cost_price) as stock_value 
                         FROM products p LEFT JOIN categories c ON p.category_id = c.id");
    $report_data = $stmt->fetchAll();
    $headers = ['Product', 'Category', 'Cost', 'Price', 'Qty', 'Stock Value'];
} elseif ($type == 'in_out') {
    $report_title = "Stock Movement Report (Last 30 Days)";
    $stmt = $pdo->query("SELECT sm.created_at, p.name, u.username, u.full_name, sm.type, sm.quantity, sm.reason 
                         FROM stock_movements sm 
                         JOIN products p ON sm.product_id = p.id 
                         LEFT JOIN users u ON sm.user_id = u.id 
                         WHERE sm.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                         ORDER BY sm.created_at DESC");
    $report_data = $stmt->fetchAll();
    $headers = ['Date', 'Product', 'User', 'Type', 'Qty', 'Reason'];
} elseif ($type == 'low_stock') {
    $report_title = "Low Stock Report";
    $stmt = $pdo->query("SELECT name, quantity, min_stock_level FROM products WHERE quantity <= min_stock_level");
    $report_data = $stmt->fetchAll();
    $headers = ['Product', 'Quantity', 'Min Level'];
}

include 'includes/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Inventory Reports</h1>
</div>

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link <?php echo $type == 'summary' ? 'active' : ''; ?>" href="?type=summary">Stock Summary</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $type == 'in_out' ? 'active' : ''; ?>" href="?type=in_out">Stock In/Out</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $type == 'low_stock' ? 'active' : ''; ?>" href="?type=low_stock">Low Stock</a>
    </li>
</ul>

<div class="glass-card animate-fade-in">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 1rem;">
        <div>
            <h3 style="margin-bottom: 0.5rem;"><?php echo $report_title; ?></h3>
            <small class="text-muted">Generated on: <?php echo date('Y-m-d H:i:s'); ?></small>
        </div>
        <div class="btn-group" style="display: flex; gap: 8px;">
            <button onclick="exportToExcel()" class="btn btn-primary" style="background: #2D6A4F; border: none;">
                <i class="fas fa-file-excel"></i> Excel
            </button>
            <button onclick="exportToPDF()" class="btn btn-primary" style="background: #D00000; border: none;">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
            <button onclick="window.print()" class="btn btn-outline-secondary" style="background: white; border: 1px solid #ddd; color: var(--text-light);">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>

    <!-- Custom Tabs (styled as buttons for now or we can implement real tabs in CSS) -->
    <div style="margin-bottom: 2rem; display: flex; gap: 10px;">
        <a href="?type=summary" class="btn <?php echo $type == 'summary' ? 'btn-primary' : 'btn-outline-secondary'; ?>" style="<?php echo $type != 'summary' ? 'background: white; border: 1px solid #ddd;' : ''; ?>">Stock Summary</a>
        <a href="?type=in_out" class="btn <?php echo $type == 'in_out' ? 'btn-primary' : 'btn-outline-secondary'; ?>" style="<?php echo $type != 'in_out' ? 'background: white; border: 1px solid #ddd;' : ''; ?>">Stock In/Out</a>
        <a href="?type=low_stock" class="btn <?php echo $type == 'low_stock' ? 'btn-primary' : 'btn-outline-secondary'; ?>" style="<?php echo $type != 'low_stock' ? 'background: white; border: 1px solid #ddd;' : ''; ?>">Low Stock</a>
    </div>

    <div class="table-container">
        <table id="reportTable">
            <thead>
                <tr>
                    <?php foreach ($headers as $h): ?>
                        <th><?php echo $h; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if ($type == 'summary'): ?>
                    <?php foreach ($report_data as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo formatPrice($row['cost_price']); ?></td>
                            <td><?php echo formatPrice($row['selling_price']); ?></td>
                            <td class="font-weight-bold"><?php echo $row['quantity']; ?></td>
                            <td><?php echo formatPrice($row['stock_value']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif ($type == 'in_out'): ?>
                    <?php foreach ($report_data as $row): ?>
                        <tr>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name'] ?? $row['username']); ?></td>
                            <td>
                                <?php echo $row['type'] == 'in' ? '<span class="badge badge-ok">IN</span>' : '<span class="badge badge-low">OUT</span>'; ?>
                            </td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo htmlspecialchars($row['reason']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif ($type == 'low_stock'): ?>
                    <?php foreach ($report_data as $row): ?>
                        <tr>
                            <td style="color: #e76f51; font-weight: 600;"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['min_stock_level']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (empty($report_data)): ?>
                    <tr><td colspan="<?php echo count($headers); ?>" class="text-center" style="padding: 2rem;">No data available for this report.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Export Libraries -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<script>
function exportToExcel() {
    const table = document.getElementById('reportTable');
    const title = "<?php echo $report_title; ?>";
    const filename = title.toLowerCase().replace(/ /g, '_') + '_' + new Date().toISOString().slice(0,10) + '.xlsx';
    
    const wb = XLSX.utils.table_to_book(table, { sheet: "Report" });
    XLSX.writeFile(wb, filename);
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4'); // landscape
    
    const title = "<?php echo $report_title; ?>";
    const date = "Generated on: <?php echo date('Y-m-d H:i:s'); ?>";
    
    doc.setFontSize(18);
    doc.text(title, 14, 15);
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text(date, 14, 22);
    
    doc.autoTable({
        html: '#reportTable',
        startY: 30,
        styles: { fontSize: 9, cellPadding: 3 },
        headStyles: { fillColor: [176, 137, 104], textColor: 255 },
        alternateRowStyles: { fillColor: [250, 245, 240] },
        didParseCell: function(data) {
            // Clean up currency formatting if needed (though it works fine as text)
        }
    });
    
    const filename = title.toLowerCase().replace(/ /g, '_') + '_' + new Date().toISOString().slice(0,10) + '.pdf';
    doc.save(filename);
}
</script>

<?php include 'includes/footer.php'; ?>
