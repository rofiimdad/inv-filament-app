<div>
<title>Label A4</title>
    <style>
        @page {
            size: A3; /* Ukuran kertas */
            margin: 8mm; /* Margin pada kertas */
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .label {
                page-break-inside: avoid;
            }
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
            margin: 3px; /* Jarak antar label */
            border: 2px solid #000;
            padding: 10px;
            box-sizing: border-box;
            height: 180px; /* Tinggi tetap untuk semua label */
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
        }

        .qr-container {
            text-align: center;
        }

        .qr-code {
            width: 60px;
            height: 60px;
            display: inline-block;
        }

        .footer {
            font-size: 8px;
            margin-top: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Label 1 -->
        @foreach ($records as $item)
        <div class="label">
            <div class="header">PT. BUMI PEMBANGUNAN PERTIWI</div>
            <table>
                <tr>
                    <td>Ref.Id: </td>
                    <td>{{$item->barcode_number}}</td>
                    <td rowspan="4" class="qr-container">
                        <!-- QR Code Section -->
                        <div class="qr-code" id={{url('scan/'.$item->barcode_number)}}></div>
                    </td>
                </tr>
                <tr>
                    <td>No. Asset:</td>
                    <td>{{$item->assets->asset_number}}</td>
                </tr>
                <tr>
                    <td>Type :</td>
                    <td>{{$item->assets->asset_type}}</td>
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
        @endforeach
    </div>

    <!-- Include QR Code Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>

        // JavaScript untuk menghasilkan QR Code berdasarkan elemen dengan class `qr`
        document.addEventListener("DOMContentLoaded", function () {
            // Cari semua elemen dengan class 'qr'
            const qrElements = document.querySelectorAll(".qr-code");


            qrElements.forEach(function (qrElement) {
                const qrId = qrElement.id; // Baca ID elemen


                // Generate QR Code
                new QRCode(document.getElementById(qrId), {
                    text:  qrId, // Gunakan ID sebagai teks QR Code
                    width: 60,
                    height: 60,
                });

            });

        });

        window.onload = function() {
            window.open();
            window.print();
        };

    </script>
</div>
