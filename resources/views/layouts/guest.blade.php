<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.1
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Grabbit">
    <meta name="author" content="Unknown">
    <meta name="keyword" content="RABBIT, rabbit, rabit, grab it">
    <title>Grabbit</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/logo.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/logo.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/logo.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/logo.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/logo.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/logo.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo.png">
    <link rel="manifest" href="/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="/css/examples.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body>

@include('sweetalert::alert')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        @yield('content')
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
    </script>

  </body>
</html>
