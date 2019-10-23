<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .email-body {
            max-width: 60%;
            margin: 123px auto;
            /*//   border: 1px solid #ccc;*/
        }

        .email-logo {
            text-align: center;
        }

        .email-logo img {
            width: 80%;
        }

        .message-heading {
            font-size: 20px;
            text-align: center;
            padding: 0 20px 0 20px;
            /*border-bottom: 1px solid #ccc;*/
        }

        .email-post {
            /*border-bottom: 1px solid #ccc;*/
        }

        .email-post > h2 {
            text-align: center;
        }


        .post-footer {
            text-align: center;
        }

        .post-footer h3 {
            text-align: center;
        }

        .post-footer p {
            font-size: 20px;
            font-family: tahoma;
        }

        .post-footer h3 {
            font-size: 23px;
            font-family: tahoma;
            font-weight: normal;
        }

        .email-text {
            text-align: center;
            font-family: tahoma;
        }

        .email-text h2 {
            font-size: 22px;
        }

        .post-details {
            text-align: center;
        }

        .button a {
            background: green;
            padding: 13px;
            text-decoration: none;
            color: #fff;
        }

        .button {
            text-align: center;
            padding: 26px;
        }

        @media only screen and (max-width: 600px) {
            .email-body {
                max-width: 90%;
                margin: 123px auto;
                border: 1px solid #ccc;
            }
        }
    </style>
</head>
<body style="background-color:#eaeaea ">
<div class="email-body" style="background-color:#fff ; margin: 30px auto">
    <div class="email-logo" style="text-align: center">
        <img src="{{asset('images/logo.png')}}" alt="">
    </div>
    <div class="message-heading">
        <p>Pabien ! bo advertencia ta online.</p>
    </div>
    <div class="email-post">
        <h2>{{$data->title}} (#{{$data->id}})</h2>
        <div class="post-image">
            <img style="display:block;margin: 0 auto"  src="{{$data->fistImage()}}"
                 alt="">
        </div>
        <div class="post-footer" style="padding: 20px">
            <p>{{$data->description}}</p>
            <h3>AWG {{$data->price}} | T: {{$data->phone}}</h3>
        </div>
    </div>
    <br><br>
    <div class="email-text">
        <h3>Pa promove advertencia</h3>
    </div>
    <div class="post-details">
        <p>Prijis : 12.50 AWG pa cada dia . <br>cuenta di banco CMB: 1234566. <br>description : #{{$data->id}}</p>
    </div>
    @php
        $url = '/destroy/';
        $url .= base64_encode($data->id) . '/';
        $url .= base64_encode($data->title) . '/';
        $url .= base64_encode($data->email) . '/';
        $url .= base64_encode($data->expire_date);
        $link = url($url);
    @endphp
    <div class="button">
        <a href="{{$link}}">Delete Advertencia</a>
    </div>
</div>

</body>
</html>