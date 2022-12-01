<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .image {
            width: 150px;
            display: inline-block;
        }
    </style>
</head>
<body>
<form id="image_form" method="post" enctype="multipart/form-data">
    <input multiple name="files[]" type="file">
    <button id="send_file">Отправить</button>

</form>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="assets/js/libs/jquery-3.6.1.js"></script>
<script>
    $(document).ready(function() {
        $("#send_file").click(function (event) {
            event.preventDefault()
            console.log('click')
            const form = $('#image_form')[0];

            const formData = new FormData(form)

            // const form = document.querySelector('#image_form')

            $.ajax({
                type: "POST",
                url: "api/Config/FileManager.php",
                data: formData,
                processData: false,
                contentType: false,

                // xhr: function() {
                //     const xhr = new window.XMLHttpRequest()
                //
                //     xhr.upload.addEventListener('progress', function(event) {
                //         if (event.lengthComputable) {
                //             const percentComplete = event.loaded / event.total
                //             console.log(percentComplete)
                //         }
                //     }, false)
                //
                //     xhr.addEventListener('progress', function(event) {
                //         if (event.lengthComputable) {
                //             const percentComplete = event.loaded / event.total
                //             console.log(percentComplete)
                //         }
                //     })
                // },
                // success: function(data) {
                //     console.log(data)
                // }
            })

        })

        function buildImage(data) {
            const el = document.createElement('div')
            el.classList.add('image')
            el.innerHTML = `
                <img class="img-thumbnail" src="${data.path}" alt="${data.name}">
                <div class="image__name">${data.name}</div>
            `;

            return el;
        }
        $.ajax({
            method: "GET",
            url: "api/Config/FileManager.php",
            success($data) {
                const response = JSON.parse($data);

                if (response.length > 0) {
                    response.forEach(item => {
                        const image = buildImage(item)
                        document.body.appendChild(image)
                    })


                }
            }
        })
    })


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>