@extends('front.layout.app')
@section('custom_css')

@endsection

{{-- @section('header-carousel')
<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn">LAYANAN KLINIK PUSAT</h1>
        </div>
    </div>
</div>

@endsection --}}
@section('btn-register')
<a href="{{ url('register/zero-service') }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnew.png') }}" style="width: 120px;" ></a>
@endsection
@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top:10px">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Blog list Start -->
            <div class="col-lg-8" >
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 rounded mb-5" src="{{ asset($read->path . $read->gambar) }}" alt="">
                    {!! $read->konten !!}
                </div>
                <!-- Blog Detail End -->
            </div>
            <!-- Blog list End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                {{-- <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword" id="pencarian">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div> --}}
                <!-- Search Form End -->

                <!-- Recent Post Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Recent Post Artikel</h3>
                    </div>
                    <div id="recent">
                    
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                {{-- <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div> --}}
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Press Release</h3>
                    </div>
                    <div class="row" id="press">
                        
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div class="wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Artikel Kami</h3>
                    </div>
                    <div class="bg-light text-justify" style="padding: 30px;">
                        {!! $plain->konten !!}
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    $(window).on('load', function() {
        recent();
        press();
    });

    function recent() {
        var need = 4;

        $.ajax({
            url: "{{ url('/recent-blog') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                need : need,
            },

            success: function(response){
                $('#recent').html(response);
            }
        });
    }

    function press() {
        var need = 8;

        $.ajax({
            url: "{{ url('/press-release') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                need : need,
            },

            success: function(response){
                $('#press').html(response);
            }
        });
    }

    $("#pencarian").on('keyup', function() {
        var term = $(this).val().toLowerCase();
        console.log(term);
        if (term != '') {
            $('.v_cari').each(function(){
                if ($(this).filter('[data-filter-name *= ' + term + ']').length > 0 || term.length < 1) {
                    console.log('muncul');
                    $(this).show(500);
                } else {
                    console.log('hilang');
                    $(this).hide(500);
                }
            });                    
        } else {
            $('.v_cari').each(function(){
                    console.log('muncul');
                    $(this).show(500);
            });
        }


        $('body,html').animate({
            scrollTop: 0
        }, 100);
    });
</script>
@endsection
