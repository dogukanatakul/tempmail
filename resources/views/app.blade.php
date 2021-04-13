<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@lang("mail.title")</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@lang("mail.description")"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset("template/img/favicon.ico") }}" type="image/x-icon"/>
    <meta name="description" content="">
    <meta http-equiv="Content-Language" content="{{ implode(locales(true),',') }}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{ asset("template/dist/font-awesome/css/font-awesome.min.css") }}"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset("template/css/main.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("template/css/style.css") }}">
    <!--[if IE]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
    <![endif]-->
</head>
<body>
<div class="loader"></div>
<header id="header">
    <div class="collapse" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4>@lang('mail.about_title')</h4>
                    <p class="text-muted">
                        @lang('mail.about')
                    </p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4" id="contact-info">
                    <h4><i class="fa fa-language" aria-hidden="true"></i></h4>
                    <ul class="list-unstyled">
                        @foreach(locales() as $key => $locale)
                            <li>
                                <a href="javascript:" title="{{ $locale }}">
                                    {{ $locale }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-light box-shadow">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="#" id="header-logo">
                MailCreate.space
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-language" aria-hidden="true" style="color: black"></i>
                <span class="navbar-toggler-icon" style="display: none"></span>
            </button>
        </div>
    </div>
</header>
<main id="main" role="main">
    <section class="jumbotron text-center" id="mainBanner">
        <div class="container">
            <h1 class="jumbotron-heading">{{ session()->get('email') }}@mailcreate.space</h1>
            <p class="lead text-muted">@lang("mail.description")</p>
            <p>
                <a href="javascript:" onclick="copyToClipboard('{{ session()->get("email") }}@mailcreate.space')" class="btn btn-primary my-2">@lang("mail.click_to_copy")</a>
                <a href="{{ route("new_mail") }}" class="btn btn-secondary my-2">@lang("mail.create")</a>
            </p>
        </div>
    </section>
    @yield('content')
    <a href="#" class="btn btn-primary scrollUp">
        <i class="fa fa-arrow-circle-o-up"></i>
    </a>
</main>
<!-- Footer -->
<footer id="footer">
    <p class="copyright">Software
        <i class="fa fa-heart"></i> By
        <a target="_blank" title="Doğukan Atakul" href="https://www.dogukanatakul.com">Doğukan Atakul</a>
        <span id="currentYear"></span> All Rights Reserved.
    </p>
    <div class="social">
        <a traget="_blank" href="https://facebook.com/dogukanatakul" title="facebook">
            <i class="fa fa-facebook"></i>
        </a>
        <a traget="_blank" href="https://twitter.com/dogukanatakul" title="twitter">
            <i class="fa fa-twitter"></i>
        </a>
        <a traget="_blank" href="https://github.com/dogukanatakul" title="github" target="_blank">
            <i class="fa fa-github"></i>
        </a>
    </div>
</footer>
<!-- jQuery first, then Bootstrap JS. -->
<script src="{{ asset("template/dist/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("template/dist/popper/popper.min.js") }}" integrity=""></script>
<script src="{{ asset("template/dist/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("template/js/main.min.js") }}"></script>
<script>
    var refreshURL = "{{ route('refreshStatus') }}";
</script>
<script src="{{ asset("template/js/script.js") }}"></script>
@yield('script')
</body>
</html>
