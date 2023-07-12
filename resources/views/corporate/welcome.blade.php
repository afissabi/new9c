@extends('corporate.app')

@section('custom_css')
    <style>
        .btn-icon{
            background: #ffffff;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            margin-top: -45px;
            margin-left: -30px;
            box-shadow: 0px 2px 2px 3px #b5b5b5d4;
        }

        @media (max-width: 991.98px){
            .header-tablet-and-mobile-fixed.toolbar-tablet-and-mobile-fixed .wrapper {
                padding-top: calc(0px + var(--kt-toolbar-height-tablet-and-mobile));
            }
        }
        
        #picture__input {
            display: none; 
        }
    
        .picture {
            width: 300px;
            aspect-ratio: 16/9;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            border: 2px dashed currentcolor;
            cursor: pointer;
            font-family: sans-serif;
            transition: color 300ms ease-in-out, background 300ms ease-in-out;
            outline: none;
            overflow: hidden;
        }
    
        .picture:hover {
            color: #777;
            background: #ccc;
        }
    
        .picture:active {
            border-color: turquoise;
            color: turquoise;
            background: #eee;
        }
    
        .picture:focus {
            color: #777;
            background: #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    
        .picture__img {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            
        </div>
    </div>
</div>
{{-- Modal Loading --}}
<div class="modal fade" tabindex="-1" id="loading" style="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 85%;background-color: rgba(0,0,0,.0001) !important;box-shadow: none;">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-spin" style="font-size: 85px;color: cadetblue;"></i>
                    <br><br>
                    <h3 style="color: #ffffff;background: cadetblue;">Proses menyimpan data...</h3>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script type="text/javascript">
    $(function(){
        $('input.price').keyup(function(event) {
            //$(this).val(formatNumber($(this).val()));
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            });
        })
    })
</script>
@endsection
