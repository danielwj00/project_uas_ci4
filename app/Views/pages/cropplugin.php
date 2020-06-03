<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        jasdasdd
    </title>

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link href="assets/css/fineCrop.css" rel="stylesheet" />
    <link href="assets/css/layout.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/fineCrop.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="assets/js/plugins/chart.js"></script>
    <script src="https://kit.fontawesome.com/2ae0411939.js" crossorigin="anonymous"></script>


</head>

<body>


    <input type="file" id="upphoto" style="display:none;">
    <label for="upphoto">
        <div class="inputLabel">
            click here to upload an image
        </div>
    </label>

    <img id="croppedImg" style="border:10px solid #000; margin:auto;">
    <div class="cropHolder">
        <div id="cropWrapper">
            <img id="inputImage" src="assets/images/face.jpg">
        </div>
        <div class="cropInputs">
            <div class="inputtools">
                <p>
                    <span>
                        <img src="assets/images/horizontal.png">
                    </span>
                    <span>horizontal movement</span>
                </p>
                <input type="range" class="cropRange" name="xmove" id="xmove" min="0" value="0">
            </div>
            <div class="inputtools">
                <p>
                    <span>
                        <img src="assets/images/vertical.png">
                    </span>
                    <span>vertical movement</span>
                </p>
                <input type="range" class="cropRange" name="ymove" id="ymove" min="0" value="0">
            </div>
            <br>
            <button class="cropButtons" id="zplus">
                <img src="assets/images/add.png">
            </button>
            <button class="cropButtons" id="zminus">
                <img src="assets/images/minus.png">
            </button>
            <br>
            <button id="cropSubmit">submit</button>
            <button id="closeCrop">Close</button>
        </div>
    </div>
    <script>
        $("#upphoto").finecrop({
            viewHeight: 500,
            cropWidth: 200,
            cropHeight: 200,
            cropInput: 'inputImage',
            cropOutput: 'croppedImg',
            zoomValue: 50
        });
    </script>
</body>


</html>