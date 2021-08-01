<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>File encryption</title>
    <style>
        table{
            width: 500px !important;
            margin: auto;
            text-align: center;
            border: 1px solid;
        }
    </style>
</head>
<body>
<h1 class="text-center mt-4 mb-3">File Details</h1>
<div class="text-center mb-4">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Copy to disk
    </button>
    <form action="{{url('file/download')}}" method="post" class="d-inline">
        @csrf
        <input type="hidden" value="{{$fileData['path']}}" name="path">
        <input type="submit" value="Download" class="btn btn-primary">
    </form>
</div>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Size</th>
        <th scope="col">Extension</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$fileData['name'] ?? ''}}</td>
            <td>{{$fileData['size'] . 'KB' ?? ''}}</td>
            <td>{{$fileData['exe'] ?? ''}}</td>
        </tr>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('file/copy')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <input type="text" placeholder="name" class="form-control" name="name">
                    </div>
                    <div class="form-group mb-4">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <input type="hidden" name="file" value="{{$fileData['path'] ?? ''}}">
                    <input type="submit" value="Download" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
