<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    
</head>
<body class="p-5">

    <form action="{{route("upload.store")}}" class="dropzone"  id="mydropzone">
        <input type="file" name="file" style="display: none">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
          Dropzone.autoDiscover = false;
          let myDropzone = new Dropzone("#mydropzone", {
            url:"{{route("upload.store")}}",
            paramName: "file", // The name that will be used to transfer the file
            chunking: true,
            method: "POST",
            maxFilesize: 40000000000,
            chunkSize: 1000000,
            parallelChunkUploads: true,
            addRemoveLinks: true,
            removedfile:function(file,formData){
                let name=file.upload.filename
                $.ajax(
                    {
                        url: "{{route("upload.delete")}}",
                        type: 'POST',
                        data: {
                            "file":name,
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(response){
                            console.log(response);
                        }
                    });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
          });

         

        myDropzone.on('sending', function (file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
        })

        myDropzone.on("success",function(file,response){
            console.log(response);
        })
        myDropzone.on("removedfile",function(response){
            console.log(response);
            
        })
    </script>
</body>
</html>