<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- CSS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/home.css">

    <title>Panduan Pengguna</title>
</head>

<body>
    <a href="/" class="back"><i class="bx bx-arrow-back"></i></a>
    <div class="panduan-user">
        <h3>PANDUAN PENGGUNA</h3>
        <div class="background">
            <div class="isi">
                <div class="qr">
                    <img src="/img/qr_code.jpg">
                    <h1>SCAN ME</h1>
                </div>
                <!-- <iframe src="https://drive.google.com/file/d/1sGTp057uSzV6yXiGt1-Dh0nNq8gbXNY2/preview" width="1000" height="1500" allow="autoplay"></iframe> -->
                <!-- <iframe src="/docs/guide-book-spp.pdf" width="1000" height="1500" allow="autoplay"></iframe> -->
                <div class="api" id="adobe-dc-view"></div>
                <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
                <script type="text/javascript">
                    document.addEventListener("adobe_dc_view_sdk.ready", function() {
                        var adobeDCView = new AdobeDC.View({
                            clientId: "a85ddb4d9ad244bc8e0af97b5be3dade",
                            divId: "adobe-dc-view"
                        });
                        adobeDCView.previewFile({
                            content: {
                                location: {
                                    url: "/docs/guide-book-spp.pdf"
                                }
                            },
                            metaData: {
                                fileName: "Manual Book.pdf"
                            }
                        }, {
                            embedMode: "SIZED_CONTAINER"
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>