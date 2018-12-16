<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Download Form API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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
            .formDownload {
                padding: 80px;
            }
            #file {
                padding: 10px;
                line-height: 1.5rem;
                width: 300px;
            }
            h2 {
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <h2>You can download file as POST via current form:</h2>
        <div class="formDownload">
            <form action="/download" enctype="multipart/form-data" method="POST">
                <p>
                    <label for="file">
                        <input type="text" name="file" id="file" placeholder="type or paste here file URL">
                    </label>
                </p>
                <button>Download</button>
                {{ csrf_field() }}
            </form>
        </div>
        
    </body>
</html>
