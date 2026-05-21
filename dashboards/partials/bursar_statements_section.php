<?php
/**
 * Bursar statements UI partial
 * Expects: $statement_accounts (array), optional $stmt_search, $stmt_search_by
 */
$stmt_search = $stmt_search ?? '';
$stmt_search_by = $stmt_search_by ?? 'all';
$statement_accounts = $statement_accounts ?? [];
$statements_section_hidden = $statements_section_hidden ?? false;
?>
<section id="statements" class="content-section"<?php echo $statements_section_hidden ? ' style="display:none;"' : ''; ?>>
    <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h2 class="section-title mb-0"><i class="fas fa-file-invoice-dollar me-2"></i>Fee Statements</h2>
        <div class="d-flex gap-2 flex-wrap">
            <a href="bursar_statement_export.php?all=1" class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> Export All (Excel)
            </a>
        </div>
    </div>

    <p class="text-muted mb-3">Generate professional fee statements with school logo — print, save as PDF, or download Excel.</p>

    <form method="get" class="row g-2 mb-4 align-items-end">
        <input type="hidden" name="open" value="statements">
        <div class="col-md-5">
            <label class="form-label small fw-semibold">Search student</label>
            <input type="text" name="stmt_search" class="form-control" placeholder="Name, admission number, or phone"
                   value="<?php echo htmlspecialchars($stmt_search); ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label small fw-semibold">Search by</label>
            <select name="stmt_search_by" class="form-select">
                <option value="all" <?php echo $stmt_search_by === 'all' ? 'selected' : ''; ?>>All fields</option>
                <option value="name" <?php echo $stmt_search_by === 'name' ? 'selected' : ''; ?>>Name</option>
                <option value="admission" <?php echo $stmt_search_by === 'admission' ? 'selected' : ''; ?>>Admission number</option>
                <option value="phone" <?php echo $stmt_search_by === 'phone' ? 'selected' : ''; ?>>Phone</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
        </div>
        <div class="col-md-2">
            <a href="?#statements" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Admission No.</th>
                    <th>Student Name</th>
                    <th>Phone</th>
                    <th>Program</th>
                    <th class="text-end">Total</th>
                    <th class="text-end">Paid</th>
                    <th class="text-end">Balance</th>
                    <th>Status</th>
                    <th class="text-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($statement_accounts)): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">No student accounts found. Try another search.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($statement_accounts as $acc):
                    $sid = $acc['student_id'] ?? '';
                    $sname = trim(($acc['first_name'] ?? '') . ' ' . ($acc['surname'] ?? ''));
                    if ($sname === '' && !empty($acc['full_name'])) {
                        $sname = $acc['full_name'];
                    }
                    $total = (float) ($acc['total_fees'] ?? 0);
                    $paid = (float) ($acc['amount_paid'] ?? 0);
                    $bal = (float) ($acc['balance'] ?? max(0, $total - $paid));
                ?>
                <tr>
                    <td><code><?php echo htmlspecialchars($sid); ?></code></td>
                    <td><?php echo htmlspecialchars($sname); ?></td>
                    <td><?php echo htmlspecialchars($acc['phone'] ?? '—'); ?></td>
                    <td><?php echo htmlspecialchars($acc['program'] ?? '—'); ?></td>
                    <td class="text-end"><?php echo number_format($total); ?></td>
                    <td class="text-end text-success"><?php echo number_format($paid); ?></td>
                    <td class="text-end text-danger fw-semibold"><?php echo number_format($bal); ?></td>
                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($acc['status'] ?? '—'); ?></span></td>
                    <td>
                        <div class="btn-group btn-group-sm flex-wrap" role="group">
                            <a href="bursar_statement.php?student_id=<?php echo urlencode($sid); ?>" class="btn btn-outline-primary" target="_blank" title="View statement">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="bursar_statement.php?student_id=<?php echo urlencode($sid); ?>&amp;autoprint=1" class="btn btn-outline-dark" target="_blank" title="Print">
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="bursar_statement.php?student_id=<?php echo urlencode($sid); ?>" class="btn btn-outline-danger" target="_blank" title="Save as PDF (Print dialog)">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <a href="bursar_statement_export.php?student_id=<?php echo urlencode($sid); ?>&amp;format=excel" class="btn btn-outline-success" title="Download Excel">
                                <i class="fas fa-file-excel"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
(function() {
    if (window.location.search.includes('open=statements') || window.location.hash === '#statements') {
        document.addEventListener('DOMContentLoaded', function() {
            var link = document.querySelector('.nav-link[href="#statements"]');
            if (link) link.click();
        });
    }
})();
</script>
