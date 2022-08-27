<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSpotter</title>
    <link rel="stylesheet" href="{{ url('assets/style/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('assets//images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/382f336cbc.js"></script>
</head>

<body style="background:white;overflow-x:hidden">
    <div class="header">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <div class="headerlogo">
                    <a href="index.html"><img class="img-fluid" src="/assets/images/headerLogo.png" alt=""></a>
                    <h5>Issue No# 00{{ $issue->id }}</h5>
                    <div class="text-muted">We appreciated you for giving time to us to make our system bug free
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title container">
        <div class="float-left mr-5">
            <h5>Status: <span style="color: red">
                    {{ Str::upper($issue->status) }}</span>
            </h5>
        </div>
        <div class="float-right ">
            <h5>Created Date : <span style="color: red"> 
                    {{ Str::upper($issue->created_at->toFormattedDateString()) }}</span>
            </h5>
        </div>
    </div>
    <div class="container mt-5 mb-5" style="position: absolute;left:0;right:0">


        <div class="d-flex justify-content-center" style="width: 100%">
            <form class="w-100 justify-content-center" method="post" action="{{ url('storeIssue') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Name</label>
                        <input readonly type="text" name="name" value="{{ $issue->name }}" class="form-control"
                            id="name" placeholder="Name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Email</label>
                        <input readonly type="email" name="email" value="{{ $issue->email }}" class="form-control"
                            id="inputEmail4" placeholder="Email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputState">Bug Type</label>
                        <select disabled id="inputState" name="type" class="form-control">
                            <option selected>{{ $issue->type }}</option>

                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputState">Issue</label>
                        <textarea readonly class="form-control" name="description" id="issue" cols="30"
                            rows="5">{{ $issue->description }}</textarea>
                    </div>
                </div>
                {{-- <div class="w-100 d-flex justify-content-center mt-3 mb-5" style="width: 100%">
                    <button type="submit" class="text-center upcoming" style="">Send</button>
                </div> --}}
            </form>
        </div>
    </div>
    <script src="https://use.fontawesome.com/382f336cbc.js"></script>
    <script>
        setTimeout(() => {
            var element = document.getElementById("alertID");
            element.classList.add("d-none");

        }, 3000);
    </script>
</body>

</html>
