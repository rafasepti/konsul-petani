@extends('layouts.petani.app')
@section('style')
<style>
    /* Custom styles for Botman Widget */
    .botman-widget {
        background-color: #f0f0f0; /* Change background color */
    }
    .botman-widget-header {
        background-color: #4CAF50; /* Change header background color */
        color: white; /* Change header text color */
    }
</style>
@endsection
@section('header')
    <header class="header-2">
        <div class="page-header min-vh-75 relative"
            style="background-image: url('{{ asset('petani/assets') }}/img/bg6.jpg')">
            <span class="mask bg-gradient-secondary opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-3">Selamat Datang</h1>
                        <p class="lead text-white mt-1">Website ini membantu petani dalam mengelola dan mengoptimalkan hasil pertanian mereka. Konsultasikan dengan chatbot untuk mendapatkan saran dan solusi pertanian yang tepat.</p>
                        <div class="buttons">
                            <a href="" id="open-botman-widget" class="btn btn-white mt-4">Chat Dengan Bot <i class="material-icons text-3xl">arrow_forward</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <section class="my-5 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                        <div
                            class="card card-rotate card-background card-background-mask-success shadow-success mt-md-0 mt-5">
                            <div class="front front-background"
                                style="background-image: url(https://images.unsplash.com/photo-1569683795645-b62e50fbf103?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80); background-size: cover;">
                                <div class="card-body py-7 text-center">
                                    <h3 class="text-white">Tata Cara <br />Bertani</h3>
                                    <p class="text-white opacity-8">Dapatkan tips dan panduan bertani yang efektif dan praktis untuk hasil panen yang optimal.</p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-6 ms-auto">
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-success text-3xl">sentiment_dissatisfied</i>
                                <h5 class="font-weight-bolder mt-3">Perasaan Sedih</h5>
                                <p class="pe-5">Perasaan sedih atau cemas yang berlangsung lama</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-success text-3xl">mood_bad</i>
                                <h5 class="font-weight-bolder mt-3">Kehilangan Minat</h5>
                                <p class="pe-3">Kehilangan minat pada aktivitas yang disukai</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <i class="material-icons text-gradient text-success text-3xl">emoji_people</i>
                            <h5 class="font-weight-bolder mt-3">Perubahan pada tubuh</h5>
                            <p class="pe-5">Perubahan berat badan atau nafsu makan</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-success text-3xl">hotel</i>
                                <h5 class="font-weight-bolder mt-3">Kesulitan tidur</h5>
                                <p class="pe-3">Kesulitan tidur atau tidur berlebihan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    document.getElementById('open-botman-widget').addEventListener('click', function(event) {
        event.preventDefault();
        window.botmanChatWidget.open();
    });
</script>
@endsection