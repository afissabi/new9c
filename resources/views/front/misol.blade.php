@extends('front.layout.app')
@section('custom_css')
<style>
    .get-blog h3 {
        font-size: 10px;
    }

    .get-blog h1 {
        font-size: 10px;
    }

    .get-blog h2 {
        font-size: 10px;
    }

    /* Start Gallery CSS */
    .thumb {
        margin-bottom: 15px;
    }
    .thumb:last-child {
        margin-bottom: 0;
    }
    /* CSS Image Hover Effects: https://www.nxworld.net/tips/css-image-hover-effects.html */
    .thumb 
    figure img {
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
    -webkit-transition: .3s ease-in-out;
    transition: .3s ease-in-out;
    }
    .thumb 
    figure:hover img {
    -webkit-filter: grayscale(0);
    filter: grayscale(0);
    }
</style>
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
<a href="{{ url('register/zero-service/' . encrypt(0)) }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnew.png') }}" style="width: 120px;" ></a>
@endsection
@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top:10px">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Misi Sosial</h5>
            <p>Sebagai sebuah bentuk rasa peduli dan tanggung jawab kami, Klinik 9COrthodontics banyak melakukan yang bersifat sosial</p>
        </div>
        <div class="row g-5">
            <!-- Blog list Start -->
            <div class="col-lg-8">
                <div class="row g-5" id="blog">
                    {{-- <div class="col-12 wow slideInUp" data-wow-delay="0.1s">
                        <nav aria-label="Page navigation">
                          <ul class="pagination pagination-lg m-0">
                            <li class="page-item disabled">
                              <a class="page-link rounded-0" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link rounded-0" href="#" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
            <!-- Blog list End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword" id="pencarian">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Recent Post Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Recent Post</h3>
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
                {{-- <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Tag Cloud</h3>
                    </div>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-light m-1">Klinik Gigi</a>
                        <a href="" class="btn btn-light m-1">Development</a>
                        <a href="" class="btn btn-light m-1">Marketing</a>
                        <a href="" class="btn btn-light m-1">SEO</a>
                        <a href="" class="btn btn-light m-1">Writing</a>
                        <a href="" class="btn btn-light m-1">Consulting</a>
                        <a href="" class="btn btn-light m-1">Design</a>
                        <a href="" class="btn btn-light m-1">Development</a>
                        <a href="" class="btn btn-light m-1">Marketing</a>
                        <a href="" class="btn btn-light m-1">SEO</a>
                        <a href="" class="btn btn-light m-1">Writing</a>
                        <a href="" class="btn btn-light m-1">Consulting</a>
                    </div>
                </div> --}}
                <!-- Tags End -->

                <!-- Plain Text Start -->
                {{-- <div class="wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Artikel Kami</h3>
                    </div>
                    <div class="bg-light text-justify" style="padding: 30px;">
                        {!! $plain->konten !!}
                    </div>
                </div> --}}
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Galeri Misi Sosial</h5>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp gallery" data-wow-delay="0.6s" id="testimoni">
            @foreach ($galeri as $item)
            <a href="{{ $item->link }}" target="_blank" style="text-decoration: auto;">
                <div class="testimonial-item bg-light my-4" >
                    <div class="d-flex align-items-center thumb" >
                        <figure><img class="img-fluid img-thumbnail" src="{{ asset($item->path . $item->gambar) }}" alt="Random Image"></figure>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    $(document).ready(function() {
        $(".gallery").magnificPopup({
            delegate: "a",
            type: "image",
            tLoading: "Loading image #%curr%...",
            mainClass: "mfp-img-mobile",
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    });
</script>
<script>
    $(window).on('load', function() {
        blog();
        recent();
    });

    function blog() {
        var need = 8;

        $.ajax({
            url: "{{ url('/all-misol') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                need : need,
            },

            success: function(response){
                $('#blog').html(response);
            }
        });
    }

    function recent() {
        var need = 8;

        $.ajax({
            url: "{{ url('/recent-misol') }}",
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
