@extends('layouts.petani.app')
@section('style')
    <style>
        /* Custom styles for Botman Widget */
        .botman-widget {
            background-color: #f0f0f0;
            /* Change background color */
        }

        .botman-widget-header {
            background-color: #4CAF50;
            /* Change header background color */
            color: white;
            /* Change header text color */
        }
    </style>
@endsection
@section('header')
    <header class="header-2">
        <div class="page-header min-vh-75 relative" style="background-image: url('{{ asset('petani/assets') }}/img/bg6.jpg')">
            <span class="mask bg-gradient-secondary opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-3">Selamat Datang</h1>
                        <p class="lead text-white mt-1">Website ini membantu petani dalam mengelola dan mengoptimalkan hasil
                            pertanian mereka. Konsultasikan dengan chatbot untuk mendapatkan saran dan solusi pertanian yang
                            tepat.</p>
                        <div class="buttons">
                            <a href="" id="open-botman-widget" class="btn btn-white mt-4">Chat Dengan Bot <i
                                    class="material-icons text-3xl">arrow_forward</i></a>
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
                    <div class="card card-rotate card-background card-background-mask-success shadow-success mt-md-0 mt-5">
                        <div class="front front-background"
                            style="background-image: url(https://images.unsplash.com/photo-1569683795645-b62e50fbf103?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80); background-size: cover;">
                            <div class="card-body py-7 text-center">
                                <h3 class="text-white">Tata Cara <br />Bertani</h3>
                                <p class="text-white opacity-8">Dapatkan tips dan panduan bertani yang efektif dan praktis
                                    untuk hasil panen yang optimal.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0">
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape  bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Pilih lahan yang subur dan sesuai untuk jenis tanaman yang akan ditanam. <br> 
                                Bersihkan lahan dari gulma, batu, dan sisa tanaman, lalu lakukan pengolahan tanah (membajak atau mencangkul).</p>
                        </div>
                    </div>

                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape  bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Pilih benih berkualitas yang sesuai dengan kondisi iklim dan jenis tanah. <br>
                                Tanam benih atau bibit dengan jarak dan kedalaman yang sesuai.</p>
                        </div>
                    </div>
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape  bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Lakukan penyiraman secara rutin.<br> 
                                Berikan pupuk sesuai kebutuhan tanaman. <br>
                                Kendalikan hama dan penyakit secara efektif.
                            </p>
                        </div>
                    </div>
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape  bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Pantau pertumbuhan tanaman dan segera tangani jika ada tanda serangan hama atau penyakit.<br> 
                                Lakukan penyiangan untuk mengendalikan gulma yang mengganggu.
                            </p>
                        </div>
                    </div>
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape  bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Panen tanaman pada waktu yang tepat untuk hasil optimal. <br>
                                Bersihkan hasil panen dan simpan atau olah dengan cara yang tepat sebelum pemasaran.
                            </p>
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
