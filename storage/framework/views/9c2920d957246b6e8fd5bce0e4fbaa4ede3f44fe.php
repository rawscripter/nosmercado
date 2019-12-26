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

            width: 70%;

        }


        .message-heading {

            font-size: 18px;

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
            padding: 13px;

            text-decoration: none;

            color: #fff;

        }


        .button {

            text-align: center;

            padding: 26px;

        }


        @media  only screen and (max-width: 600px) {

            .email-body {
                
                max-width: 90%;

                margin: 123px auto;
                
                /* border: 1px solid #ccc;*/

            }

        }

    </style>

</head>

<body style="background-color:#fff ">

<div class="email-body" style="background-color:#fff ; margin: 30px auto">


    <div class="email-post">
        <!--
        <div class="email-logo" style="text-align:center">
            <a href="https://www.nosmercado.com">
                <img style="width:50%;" src="<?php echo e(asset('images/logo.png')); ?>" alt="">
            </a>
        </div>

        <div class="message-heading">
            <p style="color:black">Pabien! Bo advertencia ta online.</p>
        </div>

        
        <h2><?php echo e($data->title); ?> (#<?php echo e($data->id); ?>)</h2>
        <div class="post-image">
        -->
        
        <img style="display:block;margin: 0 auto;max-width:100%;" src="<?php echo e($data->fistImage()); ?>" alt="">
        
        <!--
            </div>
        <div class="post-footer" style="padding: 20px">
            <p><?php echo e($data->description); ?></p>
            <h3>AWG <?php echo e($data->price); ?> | T: <?php echo e($data->phone); ?></h3>
        </div>
        -->
        

        <div style="width:100%;">
            <div class="button">
                <a style="color: #fff; background: #2b62d9; border-radius: 5px;"
                href="<?php echo e(route('post.update.email.url',$data->uuid)); ?>">Update
                    advertencia</a>
            </div>
        
            <div class="button">
                <a style="color: #fff;background: #f44336; border-radius: 5px;"
                href="<?php echo e(route('delete.user.post.from.email.url',$data->uuid)); ?>">Delete
                    advertencia</a>
            </div>
        </div>
        
        




    </div>
    <!--
    <div class="email-text">
        <h3>Pa promove advertencia</h3>
    </div>
    <div class="post-details">
        <p>Prijs : 12.50 AWG pa cada dia . <br>cuenta di banco CMB: 1234566. <br>description : #<?php echo e($data->id); ?></p>
    </div>
    -->

</div>


</body>

</html><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/layout/mail-to-post-author.blade.php ENDPATH**/ ?>