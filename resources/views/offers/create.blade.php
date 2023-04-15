<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .error {
            color: #ae1c17;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>


<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Add your offer

        </div>
       
        

        <br>
        <form method="POST" action="{{route('offers.store')}}">
            <div class="form-group">
                @csrf
                {{-- <input type="_token" value="{{csrf_token()}}" style="display: hidden"> --}}
              <label for="exampleInputEmail1">Offer Name</label>
              <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter Offer Name">
              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Offer Price</label>
              <input type="text" class="form-control" name="price" placeholder="Enter Offer Price">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Offer Details</label>
                <input type="text" class="form-control" name="details" placeholder="Enter Offer Details">
              </div>
            {{-- <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
            <button type="submit" class="btn btn-primary">Save Offer</button>
          </form>


    </div>
</div>
</body>
</html>