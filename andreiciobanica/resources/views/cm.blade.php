@extends('layouts.app')

@section('content')
<style>
                    .main-content .description-title {
                        font-size: 20px;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#219ffd",endColorstr="#ee21ff",GradientType=1);
                        color: black;
                        padding-left: 10px;
                        line-height: 55px;
                        border-radius: 10px;
                        transition: 0.3s;
                        margin-top: 2px;
                        margin-bottom: 2px;
                    }
                    .main-content .description-title:hover {
                        cursor: pointer;
                    }
                    .main-content .expand-collapse {
                        float: right;
                        margin-right: 8px;
                    }
                    .main-content .description {
                        font-size: 18px;
                        color: #35353f;
                        max-height: 0;
                        overflow: hidden;
                        margin-left: 0px;
                        padding-left: 10px;
                        transition: max-height 0.2s ease-out;
                    }
                    .main-content .description p {
                        margin-top: 4px;
                    }
                </style>
                
                <header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-4.jpg') }}) center / cover no-repeat;">
    <div class="intro-body text-start">
        <div class="container-fluid d-flex justify-content-center align-items-center p-4">
            <div class="col-sm-12" data-aos="fade-down">
                <div class="card">
                    <div class="card-header bg-dark text-center text-light">{{$curs->nume}}</div>
                        <div class="card-body text-dark">
                            <div class="menu">
                                <div class="row">
                </div>

                <div class="dropdown-divider p-0 m-0"></div>
                <div>
                    <div class="fm mt-1 text-start">
                        <p class="subtitlu">{{$curs->descriere}}</p>
                    </div>
                </div>
                <div class="dropdown-divider p-0 m-0"></div>
            <div class="col-md-7 p-2 m-2">
                <h4>Capitole</h4>
                <div class="main-content">
                @foreach($capitole as $key => $capitol)
                        <dt class="description-title">{{$capitol->nume}} <span class="expand-collapse"><i class="fa fa-caret-down"></i></span> @if($capitol->id < $detalii_curs->id_capitol)<i class="fa fa-check" aria-hidden="true" style="color: #00eb00; font-size: 20px;"></i>@endif</dt>
                        <dd class="description d-flex">
                            <ul class="text-light">
                                @foreach($lectii as $k => $lectie)
                                    @if($lectie->id_capitol==$key+1)<li><a href="{{route('lectie', ['id_curs'=>$detalii_curs->id_curs, 'id_capitol'=>$lectie->id_capitol, 'id_lectie'=>$lectie->id])}}">{{$lectie->titlu}}</a></li>@if(($capitol->id < $detalii_curs->id_capitol) || ($lectie->id < $detalii_curs->pg_ramas))<i class="fa fa-check" aria-hidden="true" style="color: #00eb00; font-size: 15px;"></i>@endif @endif
                                @endforeach
                            </ul>
                        </dd>
                    @endforeach

                    <a role="button" class="btn btn-dark" href="{{route('lectie', ['id_curs'=>$detalii_curs->id_curs, 'id_capitol'=>$detalii_curs->id_capitol, 'id_lectie'=>$detalii_curs->pg_ramas])}}" style="margin-top: 20px;">Continuați de unde ați rămas!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
                <script type="text/javascript">
                    if (document.readyState !== 'loading') {
                        //console.log("ready!");
                        ready();
                    } else {
                        document.addEventListener('DOMContentLoaded', ready);
                    }
                    function ready() {
                        var accordion = document.getElementsByTagName("dt");
                        for (var i = 0; i<accordion.length; i++){
                            accordion[i].addEventListener('click', function(){
                                accordionClick(event);
                            });
                        }
                    }
                    var accordionClick = (eventHappened) => {
                        //console.log(eventHappened);
                        var targetClicked =event.target;
                        //console.log(targetClicked);
                        var classClicked = targetClicked.classList;
                        //console.log("target clicked: " + targetClicked);
                        //console.log(classClicked[0]);
                        while ((classClicked[0] !="description-title")){
                            //console.log("parent element: " + targetClicked.parentElement);
                            targetClicked = targetClicked.parentElement;
                            classClicked = targetClicked.classList;
                            //console.log("target clicked while in loop:" + targetClicked);
                            //console.log("class clicked while in loop: " + classClicked);
                        }
                        var description = targetClicked.nextElementSibling;
                        //console.log(description);
                        var expander = targetClicked.children[0];
                        if (description.style.maxHeight){
                            description.style.maxHeight = null;
                            expander.innerHTML = "<i class=\"fa fa-caret-down\"></i>"
                        }
                        else {
                            var allDescriptions = document.getElementsByTagName("dd");
                            for (var i = 0; i < allDescriptions.length; i++){
                                //console.log("current description: " + allDescriptions[i]);
                                if (allDescriptions[i].style.maxHeight){
                                    //console.log("there is a description already open");
                                    allDescriptions[i].style.maxHeight = null;
                                    allDescriptions[i].previousElementSibling.children[0].innerHTML = "<i class=\"fa fa-caret-down\"></i>"
                                }
                            }
                            description.style.maxHeight = description.scrollHeight + "px";
                            expander.innerHTML = "<i class=\"fa fa-caret-up\"></i>";
                        }
                    }
                </script>
            </div>
    </div>
@endsection