@extends('layouts.app')
@section('title',"Login Page")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')

 <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        .card-signin {
            border: 0;
            border-radius: 0rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .card-signin .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
        }

        .card-signin .card-body {
            /* padding: 2rem; */
            margin: auto;
        }

        .form-signin {
            width: 100%;
            text-align: center;
            align-items: center;
            padding: 2px;
        }

        .form-signin .btn {
            font-size: 75%;
            border-radius: 0rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
            margin: 8px;

        }

          .form-signin .socialbtn {
       
            margin: 8px;

        }



        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input {
            height: auto;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }


        .form-control:focus {
            box-shadow: 10px 0px 0px 0px #ffffff !important;
        }

        .btn-google {
            color: white;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white;
            background-color: #3b5998;
        }
        .space{
            margin-right: 10px;
                font-size: 16px;

        }
    </style>


@endsection

<!-- ................Add css link................. -->

@push('style')

  
@endpush

@section('content')
<div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <div class="form-signin m-auto d-block d-lg-inline-flex">
                           {{--  --}}
                            <a href="{{ route('social.oauth', 'facebook') }}"  class="socialbtn"><button class="btn btn-lg btn-facebook btn-block text-uppercase mx-1" type="submit"><i
                                    class="fab fa-facebook-f space fs-6"> </i> Sign in with Facebook</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

<!-- ................push new js link................. -->

@push('js')


@endpush
