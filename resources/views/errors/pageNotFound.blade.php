<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seo_title }}</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .error-page {
            padding: 0 20px;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .error-page img {
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }

        .error-page h1 {
            color:#6c757d; 
            margin-bottom: 10px;
            text-align: center;
        }

        .error-page p {
            font-size: 22px;
            color:#6c757d;
            margin: 0;
        }

        a {
            padding: 0.375rem 0.75rem;
            border: 1px solid #409EFF;
            border-radius: 0.375rem;
            background-color: transparent;
            color: #409EFF;
            font-size: 1rem;
            line-height: 1.5;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }

        a:hover {
            background-color: #409EFF;
            color: #fff;
            border-color: #409EFF;
        }
        
    </style>
</head>
<body>
    <section class="error-page">
        <img src="{{ asset('assets/svg/pageNotFound.svg') }}" alt="page not found">
        <h1>{{ $message }}</h1>
        <a href="/">Voltar ao início</a>
    </section>
</body>
</html>
