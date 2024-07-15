@extends('layouts.petani.app')
@section('style')
    <style>
        .card-background-mask-success {
            cursor: pointer;
        }

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
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-4 p-lg-4 mt-lg-0 mt-4 text-center">
                    <div class="card card-rotate card-background card-background-mask-success shadow-success mt-md-0 mt-5">
                        <div class="front front-background"
                            style="background-image: url(https://images.unsplash.com/photo-1569683795645-b62e50fbf103?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80); background-size: cover;">
                            <div class="card-body py-7 text-center">
                                <h3 class="text-white">Panduan Pertanian</h3>
                                <p class="text-white opacity-8">Pilih topik untuk mendapatkan tips dan panduan.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-success mt-3" onclick="toggleTips('tips1')">Tata Cara
                                            Bertani</button>
                                        <button class="btn btn-success mt-3" onclick="toggleTips('tips2')">Cara Menanam</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success mt-3" onclick="toggleTips('tips3')">Perawatan
                                            Tanaman</button>
                                        <button class="btn btn-success mt-3" onclick="toggleTips('tips4')">Panen dan Pasca
                                            Panen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0" id="tips1" style="display: none;">
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Pilih lahan yang subur dan sesuai untuk jenis tanaman yang akan ditanam. <br>
                                Bersihkan lahan dari gulma, batu, dan sisa tanaman, lalu lakukan pengolahan tanah (membajak
                                atau mencangkul).</p>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak informasi di sini jika diperlukan -->
                </div>

                <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0" id="tips2" style="display: none;">
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Pilih benih berkualitas yang sesuai dengan kondisi iklim dan jenis tanah. <br>
                                Tanam benih atau bibit dengan jarak dan kedalaman yang sesuai.</p>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak informasi di sini jika diperlukan -->
                </div>

                <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0" id="tips3" style="display: none;">
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Lakukan penyiraman secara rutin.<br>
                                Berikan pupuk sesuai kebutuhan tanaman. <br>
                                Kendalikan hama dan penyakit secara efektif.</p>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak informasi di sini jika diperlukan -->
                </div>

                <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0" id="tips4" style="display: none;">
                    <div class="p-3 info-horizontal">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center">
                            <i class="fas fa-seedling opacity-10"></i>
                        </div>
                        <div class="description ps-3">
                            <p class="mb-0">Panen tanaman pada waktu yang tepat untuk hasil optimal. <br>
                                Bersihkan hasil panen dan simpan atau olah dengan cara yang tepat sebelum pemasaran.</p>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak informasi di sini jika diperlukan -->
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

        function toggleTips(tipsId) {
            var tipsSections = ['tips1', 'tips2', 'tips3', 'tips4'];

            tipsSections.forEach(function(section) {
                var element = document.getElementById(section);
                if (section === tipsId) {
                    element.style.display = (element.style.display === "none" || element.style.display === "") ?
                        "block" : "none";
                } else {
                    element.style.display = "none";
                }
            });
        }
    </script>
@endsection
