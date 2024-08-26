<div class="modal fade" id="imageCropper">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="show-hub-modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal"><i class="fa fa-close"
                    aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img id="rawImage" src="" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="crop-btn" type="button" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentInputFile = null;
    let cropper = null;

    function cropImage(event) {
        // Save the reference to the current input file
        currentInputFile = $(event.target);

        // Show the modal
        $('#imageCropper').modal('show');

        // Read the selected file
        if (currentInputFile[0].files && currentInputFile[0].files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#rawImage').attr('src', e.target.result);
                setTimeout(initCropper, 1000);
            };
            reader.readAsDataURL(currentInputFile[0].files[0]);
        }
    }

    function initCropper() {
        const image = $('#rawImage')[0];
        const aspectRatio = currentInputFile.data('aspect-ratio') || 4 / 3; // Default aspect ratio if not provided

        // Destroy existing cropper if it exists
        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(image, {
            aspectRatio: aspectRatio,
            viewMode: 1, // Ensures that the crop box does not exceed the size of the canvas
            cropBoxResizable: true,
            cropBoxMovable: true,
            zoomable: true
        });

        // On crop button clicked
        $('#crop-btn').on('click', function() {
            const cropWidth = 300; // Desired width
            const cropHeight = 400; // Desired height

            // Get cropped canvas with fixed size
            const croppedCanvas = cropper.getCroppedCanvas({
                width: cropWidth,
                height: cropHeight
            });

            // Convert canvas to Data URL
            const imgurl = croppedCanvas.toDataURL();
            const croppedImage = dataURLToBlob(imgurl);

            // Create a new file object and set it to the input file
            const newFile = new File([croppedImage], currentInputFile[0].files[0].name, {
                type: currentInputFile[0].files[0].type,
                lastModified: Date.now()
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(newFile);

            // Update the input file
            currentInputFile[0].files = dataTransfer.files;

            // Close the modal
            $('#imageCropper').modal('hide');
        });
    }

    // Convert dataURL to Blob
    function dataURLToBlob(dataURL) {
        const [header, data] = dataURL.split(',');
        const mime = header.match(/:(.*?);/)[1];
        const binary = atob(data);
        const array = [];
        for (let i = 0; i < binary.length; i++) {
            array.push(binary.charCodeAt(i));
        }
        return new Blob([new Uint8Array(array)], { type: mime });
    }

    // Attach the cropImage function to all file inputs with a specific class
    $(document).ready(function() {
        $('.crop-input').on('change', cropImage);
    });
</script>
