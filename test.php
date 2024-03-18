<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="preview col-md-6">
                Scan Your QR
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                    data-bs-target="#scannerModal">
                    Open Scanner
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scannerModalLabel">QR Scanner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="preview">
                        <video id="modalPreview" width="100%"></video>
                    </div>
                    <input type="text" id="modalText" class="form-control mt-3" placeholder="Scan result">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper and Bootstrap JS -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- QR Scanner -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
    let modalScanner = new Instascan.Scanner({
        video: document.getElementById('modalPreview')
    });

    function startModalScanner() {
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                modalScanner.start(cameras[0]);
            } else {
                alert("No Cameras found");
            }
        }).catch(function(e) {
            console.error(e);
        });
    }

    modalScanner.addListener('scan', function(content) {
        document.getElementById('modalText').value = content;
    });

    document.getElementById('scannerModal').addEventListener('shown.bs.modal', function() {
        startModalScanner();
    });

    document.getElementById('scannerModal').addEventListener('hidden.bs.modal', function() {
        modalScanner.stop();
    });
    </script>
</body>

</html>