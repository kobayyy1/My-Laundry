@extends('pages.layouts.panel')

@section('head')
<title>laundryku - About Me Pages</title>
@endsection
<div class="container py-5">
    <h2 class="fw-bold text-primary mb-4">
        <i class="fas fa-question-circle me-2"></i>FAQ (Pertanyaan Umum)
    </h2>

    <div class="accordion" id="faqAccordion">
        <!-- Pertanyaan 1 -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-clock me-2 text-primary"></i> Berapa lama proses cuci?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#faqAccordion">
                <div class="accordion-body text-secondary">
                    Proses cuci standar memakan waktu 2–3 hari. Kami juga menyediakan layanan express 1 hari untuk kebutuhan mendesak.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 2 -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-map-marker-alt me-2 text-primary"></i> Apakah tersedia layanan antar-jemput?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#faqAccordion">
                <div class="accordion-body text-secondary">
                    Maaf, saat ini kami belum menyediakan layanan antar-jemput. Silakan kunjungi langsung outlet kami.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 3 -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i class="fas fa-money-bill-wave me-2 text-primary"></i> Metode pembayaran apa saja yang tersedia?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#faqAccordion">
                <div class="accordion-body text-secondary">
                    Kami menerima pembayaran tunai dan transfer bank. Detail akan diinformasikan oleh staf kami saat transaksi.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 4 -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <i class="fas fa-tshirt me-2 text-primary"></i> Apakah semua jenis pakaian bisa dicuci?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#faqAccordion">
                <div class="accordion-body text-secondary">
                    Kami mencuci berbagai jenis pakaian harian dan kain rumah tangga. Untuk bahan khusus seperti sutra atau jas, silakan konsultasikan terlebih dahulu dengan staf kami.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 5 -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <i class="fas fa-store me-2 text-primary"></i> Jam operasional laundry Anda?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                data-bs-parent="#faqAccordion">
                <div class="accordion-body text-secondary">
                    Kami buka setiap hari dari pukul 08.00 hingga 20.00, termasuk hari libur nasional.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 6 -->
        <div class="accordion-item border-0 mb-3 shadow-sm rounded">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <i class="fas fa-exclamation-triangle me-2 text-primary"></i> Bagaimana jika pakaian saya rusak atau hilang?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                data-bs-parent="#faqAccordion">
                <div class="accordion-body text-secondary">
                    Kami memiliki standar penanganan yang ketat. Namun jika terjadi kerusakan atau kehilangan, kami akan bertanggung jawab sesuai dengan ketentuan yang berlaku.
                </div>
            </div>
        </div>
    </div>
</div>




@section('script')
   
@endsection
