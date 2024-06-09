<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
</head>

<body>

    <!-- Vertically centered modal -->
    <div class="modal" tabindex="-1" id="userErrorModel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger border-2">
                <div class="modal-header bg-black">
                    <h5 class="modal-title text-white">Error: Oops! Something went wrong. &nbsp;&nbsp;&nbsp;<span class="text-warning"> :( </span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
                </div>
                <div class="modal-body bg-dark text-warning border-0">
                    <p>We apologize for the inconvenience, but it seems that an error has occurred while loading this web page.</p>
                </div>
                <div class="modal-footer bg-black">
                    <button type="button" class="btn btn-primary" onclick="window.location.reload();">Re-try</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap/bootstrap.bundle.js"></script>
    <script src="../js/other/userError.js"></script>

</body>

</html>