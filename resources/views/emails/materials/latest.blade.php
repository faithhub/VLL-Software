<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Latest Material from Virtual Law Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #1d3557 !important;
            font-size: 24px !important;
            margin-bottom: 1.5rem !important;
            font-weight: bold;
            margin-top: 0;
        }

        .ebook {
            margin-bottom: 20px;
        }

        .ebook-image {
            border-radius: 5px;
            width: 90%;
            height: auto;
            margin-bottom: 10px;
        }

        .ebook-title {
            margin-bottom: 0px;
        }

        .ebook-title a {
            color: #1d3557;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
        }

        .ebook-description {
            color: #000;
            text-align: justify;
        }

        .ebook-link {
            color: #1d3557;
            text-decoration: none;
        }

        .ebook-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Latest Material from Virtual Law Library</h1>
        @foreach ($materials as $material)
            <div class="ebook">
                <img src="{{ url($material->cover->url ?? '') }}" alt="Ebook 1" class="ebook-image">
                <h2 class="ebook-title"><a href="{{ route('login') }}">{{ $material->title }}</a></h2>
                <p class="ebook-description">{{ $material->material_desc }}</p>
            </div>
        @endforeach

    </div>
</body>

</html>
