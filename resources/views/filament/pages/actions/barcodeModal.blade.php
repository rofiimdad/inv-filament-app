        <div class=" p-8 rounded-lg shadow-lg">
            <div class="bg-white basis-1/2">

                @php
                $dns2d = app(DNS2D::class);
                $qrCode = $dns2d->getBarcodeHTML('4445645656', 'QRCODE');
                echo $qrCode;
                @endphp
            </div>
            <div class="basis-1/2">
                <h2 class="text-xl mb-4">This is a modal</h2>
                <p>Content of the modal...</p>
            </div>
        </div>





