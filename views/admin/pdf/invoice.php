<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-header {
            padding: 20px;
            background-color: #f8f8f8;
            border-bottom: 2px solid #ccc;
        }

        .invoice-header img {
            height: 50px;
        }

        .invoice-header div {
            text-align: right;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #f1f1f1;
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .total-section table {
            width: 40%;
            border-collapse: collapse;
        }

        .total-section td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .total-section .total {
            background-color: #007bff;
            color: #fff;
        }

        .payment-details {
            margin-top: 30px;
        }

        .payment-details h3 {
            margin-bottom: 10px;
            color: #007bff;
        }

        .notes {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <?php if ($data['company']->logo_path != null) : ?>
            <img src="<?= htmlspecialchars($data['company']->logo_path) ?>" alt="Company Logo" />
        <?php else : ?>
            <img src="<?= $_ENV['APP_URL'] . '/novena/images/logo.png' ?>" alt="Company Logo" />
        <?php endif; ?>
        <div style="text-align: right;">
            <p>Date: <?= htmlspecialchars($data['payment']->date) ?></p>
            <p>Invoice #: F-0001</p>
        </div>
    </div>
    <table class="info" style="width: 100%;">
        <thead>
            <tr>
                <th>
                    <h3 style="text-align:left;margin-top:8px;margin-bottom:4px;">
                        <?= htmlspecialchars($data['company']->name) ?>
                    </h3>
                </th>
                <th>
                    <h3 style="text-align:left;margin-top:8px;margin-bottom:4px;">
                        <?= htmlspecialchars($data['payment']->customer->name . ' ' . $data['payment']->customer->lastname) ?>
                    </h3>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span>RUC: <?= htmlspecialchars($data['company']->ruc) ?></span></td>
                <td>
                    <span>
                        <?php if ($data['payment']->customer->document_type == 1) : ?>
                            DNI: <?= htmlspecialchars($data['payment']->customer->document_number) ?>
                        <?php endif; ?>
                        <?php if ($data['payment']->customer->document_type == 4) : ?>
                            FOREIGNER CARD: <?= htmlspecialchars($data['payment']->customer->document_number) ?>
                        <?php endif; ?>
                        <?php if ($data['payment']->customer->document_type == 6) : ?>
                            RUC: <?= htmlspecialchars($data['payment']->customer->document_number) ?>
                        <?php endif; ?>
                        <?php if ($data['payment']->customer->document_type == 7) : ?>
                            PASSPORT: <?= htmlspecialchars($data['payment']->customer->document_number) ?>
                        <?php endif; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td><span><?= htmlspecialchars($data['company']->tax_domicile) ?></span></td>
                <td><span><?= htmlspecialchars($data['payment']->customer->address) ?></span></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product details</th>
                <th>Qty.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= htmlspecialchars($data['payment']->plan->name) ?></td>
                <td>1</td>
                <td>S/.<?= htmlspecialchars($data['payment']->plan->price) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <table>
            <tr class="total">
                <td>Total:</td>
                <td style="text-align: right;">S/.<?= htmlspecialchars($data['payment']->plan->price) ?></td>
            </tr>
        </table>
    </div>

    <div class="payment-details">
        <h3>PAYMENT DETAILS</h3>
        <p>Bank of Banks</p>
        <p>Bank/Sort Code: 1234567</p>
        <p>Account Number: 123456678</p>
        <p>Payment Reference: BRA-00335</p>
    </div>

    <div class="notes">
        <p><strong>Notes:</strong> Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
    </div>
</body>
</html>
