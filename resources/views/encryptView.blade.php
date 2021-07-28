<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>File encryption</title>
    <style>
        #form{
            width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1 class="text-center mt-4 mb-4">Upload file</h1>
    <form method="post" id="form" action="file/do-operation" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4">
            <input type="file" class="form-control" name="file" id="file">
        </div>
        <div class="form-group mb-4">
           <select name="type" class="form-control">
               <option value="1">Encrypt</option>
               <option value="2">Decrypt</option>
           </select>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
</body>
</html>
