@extends('layouts.app')

@section('content')
<style>
#parent {
    width: 100%;
    height: 100vh;
    display:inline-block;
    position:relative;
}
#editor {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
        pre {
            font-size: .7rem;
            margin: 0;
            background-color: #e8e8e8;
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            font-family: Montserrat;
        }
        .fm{
            font-family: Montserrat;
        }
        .ct{
            color: #f8fafc;
            font-size: 12px;
            padding-left: 20px;
            margin: 5px;
        }
        .subtitlu{
            font-size: 16px;
            padding-left: 15px;
            margin: 5px;
        }
        .titlu{
            font-size: 24px;
            padding-left: 10px;
            margin: 5px;
        }
        .nume{
            font-size: 36px;
            font-weight: bold;
        }
        .subm button {
            outline: none !important;
            border: none;
            background: rgb(33,141,253);
            background: -moz-linear-gradient(19deg, rgba(33,141,253,1) 0%, rgba(245,33,255,1) 100%);
            background: -webkit-linear-gradient(19deg, rgba(33,141,253,1) 0%, rgba(245,33,255,1) 100%);
            background: linear-gradient(19deg, rgba(33,141,253,1) 0%, rgba(245,33,255,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#218dfd",endColorstr="#f521ff",GradientType=1);
            width: 100%;
            height: 70px;
            font-family: Montserrat;
            font-size: 18px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;
        }
        .subm button:hover {
            cursor: pointer;
        }
</style>

<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-4.jpg') }}) center / cover no-repeat;">
        <div class="intro-body">
            <div class="container animate__animated animate animate__fadeInDown">
                <div class="row justify-content-center">
                    <div class="col-lg-8 mx-auto">
                    <div class="text-center m-1 p-1 nume text-light">{{$nume}}</div>
            <div class="text-center m-0 p-0 text-light">- problema numărul {{$id_problema}} -</div>
            <div class="dropdown-divider p-0 m-0"></div>
            <div>
                <p class="text-light titlu">Cerință</p>
                <div class="fm">
                    <p class="text-light subtitlu">{{$cerinta}}</p>
                </div>
                </div>
                <div class="dropdown-divider p-0 m-0"></div>
                <p class="text-light titlu">Date</p>
                <div><div class="fm">
                        <p class="text-light subtitlu">Date de intrare</p>
                        <p class="text-light ct">{{$din}}</p>
                    </div>
                    <div class="fm">
                        <p class="text-light subtitlu">Date de ieșire</p>
                        <p class="text-light ct">{{$dout}}</p>
                    </div>
                </div>

                <div class="dropdown-divider p-0 m-0"></div>
                <div>
                    <p class="text-light titlu">Exemplu</p>
                    <div class="fm">
                        <p class="text-light subtitlu">Date de intrare</p>
                        <pre>{{$exin}}</pre>
                    </div>
                    <div class="fm">
                        <p class="text-light subtitlu">Date de ieșire</p>
                        <pre>{{$exout}}</pre>
                    </div>
                </div>

                <div class="dropdown-divider p-0 m-0"></div>
                <div class="subm" style="text-align:center;">
                    <button onsubmit="" form="cod" style="margin-top: 20px;">Trimite rezolvarea!</button>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
</header>

<section id="problema_textarea" style="overflow-x: hidden;">
        <div class="" id="parent">
        <form action="{{route('compileAPI', ['id' => $id_problema])}}" method="POST" name="cod" id="cod">
        @csrf
        <div id="editor"></div>
        <textarea id="codproblema" name="codproblema" hidden></textarea>
        </form>
    </div>
</section>
@endsection