<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Coaching Management System" name="description">
    <meta content="Bootlab" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <link href="https://appstack.bootlab.io/dashboard-saas.html" rel="canonical"/>
    <link href="img/favicon.ico" rel="shortcut icon">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/skins/content/dark/content.min.css" rel="stylesheet">

    <link class="js-stylesheet" href="/themes/exam/light.css" rel="stylesheet">
    <link class="js-stylesheet" href="{{ mix('/css/exam/style.css') }}" rel="stylesheet">

    @yield('css')
</head>