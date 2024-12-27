<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label A4</title>
    <style>
        @page {
            size: A4; /* Ukuran kertas */
            margin: 10mm; /* Margin pada kertas */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0;
        }

        .label {
            width: calc(25% - 10px); /* 3 kolom per baris, dengan jarak kecil antar label */
            margin: 5px; /* Jarak antar label */
            border: 2px solid #000;
            padding: 5px;
            box-sizing: border-box;
            height: 160px; /* Tinggi tetap untuk semua label */
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 2px;
            font-size: 10px;
        }

        .qr-container {
            text-align: center;
        }

        .qr-code {
            width: 95px;
            height: 95px;
            display: inline-block;
        }

        .footer {
            font-size: 8px;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Label 1 -->
        <div class="label">
            <div class="header">PT. BUMI PEMBANGUNAN PERTIWI</div>
            <table>
                <tr>
                    <td>Ref.Id: </td>
                    <td>SDKFHSKDHFKSJ</td>
                    <td rowspan="4" class="qr-container">
                        <!-- QR Code Section -->
                        <div class="qr-code" id="qrcode1"></div>
                    </td>
                </tr>
                <tr>
                    <td>No. Asset:</td>
                    <td>100.00</td>
                </tr>
                <tr>
                    <td>Type :</td>
                    <td> 04/09/2020</td>
                </tr>
                <tr>
                    <td>Based :</td>
                    <td>IT - Hardware</td>
                </tr>
            </table>
            <div class="footer">
                Developed By IT-Succes jaya<br>
                Copyright-24, Head Office, Madiun<br>
            </div>
        </div>
    </div>

    <!-- Include QR Code Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>

        // JavaScript untuk menghasilkan QR Code berdasarkan elemen dengan class `qr`
        document.addEventListener("DOMContentLoaded", function () {
            // Cari semua elemen dengan class 'qr'
            const qrElements = document.querySelectorAll(".qr-code");
            console.log(qrElements);

            qrElements.forEach(function (qrElement) {
                const qrId = qrElement.id; // Baca ID elemen

                console.log(qrId);
                // Generate QR Code
                new QRCode(document.getElementById(qrId), {
                    text: qrId + "wjsdkjhdkahs", // Gunakan ID sebagai teks QR Code
                    width: 95,
                    height: 95,
                });
            });
        });
    </script>

</body>
</html>
