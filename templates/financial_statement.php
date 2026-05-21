<?php
/**
 * Professional financial statement template
 * @var array $statement
 * @var string $logoUrl
 * @var bool $forPrint
 */
$forPrint = $forPrint ?? false;
$logoUrl = $logoUrl ?? '../images/school-logo.png';
$s = $statement;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Statement — <?php echo htmlspecialchars($s['student_id']); ?> | ISNM</title>
    <link rel="icon" href="<?php echo htmlspecialchars($logoUrl); ?>" type="image/png">
    <style>
        :root {
            --isnm-navy: #1a237e;
            --isnm-gold: #c9a227;
            --isnm-cream: #faf8f3;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Georgia, 'Times New Roman', serif;
            background: #eef1f8;
            color: var(--text);
            line-height: 1.5;
            padding: 24px;
        }
        .statement-page {
            max-width: 820px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid var(--border);
            box-shadow: 0 12px 40px rgba(26, 35, 126, 0.12);
        }
        .stmt-header {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: 20px;
            align-items: center;
            padding: 28px 32px 22px;
            background: linear-gradient(135deg, var(--isnm-navy) 0%, #283593 55%, #3949ab 100%);
            color: #fff;
            border-bottom: 4px solid var(--isnm-gold);
        }
        .logo-wrap {
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 50%;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
            border: 3px solid var(--isnm-gold);
        }
        .logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }
        .school-block h1 {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            line-height: 1.35;
            margin-bottom: 6px;
        }
        .school-block .tagline {
            font-size: 0.8rem;
            opacity: 0.92;
            margin-bottom: 12px;
        }
        .school-block .contact {
            font-size: 0.72rem;
            opacity: 0.85;
            line-height: 1.6;
        }
        .stmt-title-bar {
            background: var(--isnm-cream);
            padding: 14px 32px;
            border-bottom: 2px solid var(--isnm-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .stmt-title-bar h2 {
            font-size: 1.25rem;
            color: var(--isnm-navy);
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .stmt-ref {
            font-size: 0.8rem;
            color: var(--muted);
            font-family: 'Consolas', monospace;
        }
        .stmt-body { padding: 28px 32px 32px; }
        .student-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
            margin-bottom: 28px;
            padding: 18px 20px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid var(--isnm-navy);
        }
        .field label {
            display: block;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 4px;
        }
        .field span {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text);
        }
        .summary-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }
        .summary-box {
            text-align: center;
            padding: 16px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }
        .summary-box.total { background: #eff6ff; border-color: #93c5fd; }
        .summary-box.paid { background: #ecfdf5; border-color: #6ee7b7; }
        .summary-box.balance { background: #fef2f2; border-color: #fca5a5; }
        .summary-box .label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .summary-box .amount {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--isnm-navy);
        }
        .summary-box.balance .amount { color: #b91c1c; }
        .summary-box.paid .amount { color: #047857; }
        table.tx-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            margin-bottom: 24px;
        }
        .tx-table thead {
            background: var(--isnm-navy);
            color: #fff;
        }
        .tx-table th {
            padding: 11px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .tx-table td {
            padding: 10px 12px;
            border-bottom: 1px solid var(--border);
        }
        .tx-table tbody tr:nth-child(even) { background: #f8fafc; }
        .tx-table .num { text-align: right; font-weight: 600; font-variant-numeric: tabular-nums; }
        .stmt-footer {
            margin-top: 32px;
            padding-top: 20px;
            border-top: 2px solid var(--border);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        .sig-line {
            border-top: 1px solid #334155;
            margin-top: 48px;
            padding-top: 8px;
            font-size: 0.8rem;
            color: var(--muted);
        }
        .footer-note {
            grid-column: 1 / -1;
            font-size: 0.72rem;
            color: var(--muted);
            text-align: center;
            margin-top: 16px;
            padding: 12px;
            background: var(--isnm-cream);
            border-radius: 6px;
        }
        .toolbar {
            max-width: 820px;
            margin: 0 auto 16px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .toolbar button, .toolbar a {
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-print { background: var(--isnm-navy); color: #fff; }
        .btn-pdf { background: #b91c1c; color: #fff; }
        .btn-back { background: #64748b; color: #fff; }
        .btn-excel { background: #047857; color: #fff; }
        @media print {
            body { background: #fff; padding: 0; }
            .toolbar { display: none !important; }
            .statement-page {
                box-shadow: none;
                border: none;
                max-width: 100%;
            }
            .stmt-header { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .tx-table thead { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
        @media (max-width: 600px) {
            .stmt-header { grid-template-columns: 1fr; text-align: center; }
            .logo-wrap { margin: 0 auto; }
            .student-grid, .summary-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <?php if (!$forPrint): ?>
    <div class="toolbar">
        <button type="button" class="btn-print" onclick="window.print()">🖨️ Print</button>
        <button type="button" class="btn-pdf" onclick="window.print()">📄 Save as PDF</button>
        <a class="btn-excel" href="bursar_statement_export.php?student_id=<?php echo urlencode($s['student_id']); ?>&amp;format=excel">📊 Excel</a>
        <a class="btn-back" href="javascript:history.back()">← Back</a>
    </div>
    <?php endif; ?>

    <div class="statement-page" id="statementDocument">
        <header class="stmt-header">
            <div class="logo-wrap">
                <img src="<?php echo htmlspecialchars($logoUrl); ?>" alt="ISNM Logo" onerror="this.style.display='none'">
            </div>
            <div class="school-block">
                <h1>Iganga School of Nursing and Midwifery</h1>
                <p class="tagline">(ISNM) — Office of the Bursar</p>
                <p class="contact">
                    P.O. Box 418, Iganga · Along Jinja–Iganga Highway<br>
                    Tel: 0782 990 403 · Email: iganganursingschool@gmail.com
                </p>
            </div>
        </header>

        <div class="stmt-title-bar">
            <h2>Student Fee Statement</h2>
            <span class="stmt-ref">Ref: <?php echo htmlspecialchars($s['statement_ref']); ?></span>
        </div>

        <div class="stmt-body">
            <div class="student-grid">
                <div class="field">
                    <label>Student Name</label>
                    <span><?php echo htmlspecialchars($s['student_name']); ?></span>
                </div>
                <div class="field">
                    <label>Admission / Index No.</label>
                    <span><?php echo htmlspecialchars($s['student_id']); ?></span>
                </div>
                <div class="field">
                    <label>Program</label>
                    <span><?php echo htmlspecialchars($s['program']); ?></span>
                </div>
                <div class="field">
                    <label>Academic Year</label>
                    <span><?php echo htmlspecialchars($s['academic_year']); ?></span>
                </div>
                <div class="field">
                    <label>Phone</label>
                    <span><?php echo htmlspecialchars($s['phone'] ?: '—'); ?></span>
                </div>
                <div class="field">
                    <label>Account Status</label>
                    <span><?php echo htmlspecialchars($s['status']); ?></span>
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-box total">
                    <div class="label">Total Fees</div>
                    <div class="amount"><?php echo bursarFormatUgx($s['total_fees']); ?></div>
                </div>
                <div class="summary-box paid">
                    <div class="label">Amount Paid</div>
                    <div class="amount"><?php echo bursarFormatUgx($s['amount_paid']); ?></div>
                </div>
                <div class="summary-box balance">
                    <div class="label">Outstanding Balance</div>
                    <div class="amount"><?php echo bursarFormatUgx($s['balance']); ?></div>
                </div>
            </div>

            <h3 style="font-size:0.95rem;color:var(--isnm-navy);margin-bottom:12px;text-transform:uppercase;letter-spacing:0.5px;">Payment History</h3>
            <table class="tx-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Receipt No.</th>
                        <th>Method</th>
                        <th>Reference</th>
                        <th class="num">Amount (UGX)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($s['payments'])): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No payment records on file.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($s['payments'] as $p): ?>
                    <tr>
                        <td><?php echo $p['payment_date'] ? date('d M Y', strtotime($p['payment_date'])) : '—'; ?></td>
                        <td><?php echo htmlspecialchars($p['receipt_number'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $p['payment_method'] ?? '—'))); ?></td>
                        <td><?php echo htmlspecialchars($p['payment_reference'] ?? ($p['bank_name'] ?? '—')); ?></td>
                        <td class="num"><?php echo number_format((float) ($p['amount_paid'] ?? $p['amount'] ?? 0), 0); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($p['status'] ?? 'verified')); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <footer class="stmt-footer">
                <div>
                    <p style="font-size:0.8rem;color:var(--muted);margin-bottom:4px;">Prepared by Bursar's Office</p>
                    <div class="sig-line">Authorized Signature &amp; Stamp</div>
                </div>
                <div style="text-align:right;">
                    <p style="font-size:0.8rem;color:var(--muted);">Generated</p>
                    <p style="font-weight:600;"><?php echo htmlspecialchars($s['generated_at']); ?></p>
                </div>
                <p class="footer-note">
                    This is an official fee statement from Iganga School of Nursing and Midwifery.
                    For enquiries contact the Bursar's office. Computer-generated document — valid without signature if electronically issued.
                </p>
            </footer>
        </div>
    </div>
    <?php if (!empty($_GET['autoprint'])): ?>
    <script>window.onload = function() { window.print(); };</script>
    <?php endif; ?>
</body>
</html>
