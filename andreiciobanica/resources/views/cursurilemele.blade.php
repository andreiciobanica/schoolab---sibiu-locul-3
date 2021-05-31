@extends('layouts.app')

@section('content')

<style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        main .list .item {
            padding: 15px;
        }
        main .list .item:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        .pagenumbers {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .pagenumbers button {
            width: 50px;
            height: 50px;
            appearance: none;
            border: none;
            outline: none;
            cursor: pointer;
            background: rgb(48, 217, 90);
            margin: 5px;
            transition: 0.4s;
            color: #FFF;
            font-size: 18px;
            text-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
        }
        .pagenumbers button:hover {
            background: rgb(0,0,0);
            color: #fff;
        }
        .pagenumbers button.active {
            background: rgb(255,255,255);
            color: #000;
            box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.2);
        }
        .item{
            border: 1px solid #CCC;
            border-radius: 10px;
            margin: 10px;
        }
        .curs{margin-top: 10px;}
    </style>
<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-4.jpg') }}) center / cover no-repeat;">
        <div class="intro-body">
            <div class="container animate__animated animate animate__fadeInDown">
                <div class="row justify-content-center">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="brand-heading" style="font-size: 56px;font-family: 'Titillium Web', sans-serif;letter-spacing: 0px;line-height: 60px;">Cursurile la care v-ați înscris!</h1>
                        <a class="btn btn-link btn-circle" role="button" href="#cursuri"><i class="fa fa-angle-double-down animated"></i></a>
                    </div>
                </div>
            </div>
        </div>
</header>

<section class="text-center content-section" id="cursuri" style="overflow-x: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                @if(empty($cursuri))<h3>În momentul de față nu sunteți înscris la niciun curs!</h3> @endif
                <main>
                <div class="list" id="list"></div>
                <div class="pagenumbers" id="pagination"></div>
                </main>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
@if(!empty($cursuri))
const list_items = [
            @foreach($cursuri as $key => $curs)
                "<div class=\"curs\"><div class=\"row d-flex justify-content-center align-items-center\"><div class=\"col-md-5 text-center\"><img src=\"{{$curs->pathavatar}}\" class=\"img-fluid avatar\" ></div><div class=\"col-md-7\"><a href=\"{{route('cm', ['id' => $curs->id])}}\">{{$curs->nume}}</a><br>{{str_limit($curs->descriere, 130, ' (...)')}}</div></div></div>",
            @endforeach
        ];
        const list_element = document.getElementById('list');
        const pagination_element = document.getElementById('pagination');
        let current_page = 1;
        let rows = 5;
        function DisplayList (items, wrapper, rows_per_page, page) {
            wrapper.innerHTML = "";
            page--;
            let start = rows_per_page * page;
            let end = start + rows_per_page;
            let paginatedItems = items.slice(start, end);
            for (let i = 0; i < paginatedItems.length; i++) {
                let item = paginatedItems[i];
                let item_element = document.createElement('div');
                item_element.classList.add('item');
                item_element.id = i;
                wrapper.appendChild(item_element);
                document.getElementById(i).innerHTML = item;
            }
        }
        function SetupPagination (items, wrapper, rows_per_page) {
            wrapper.innerHTML = "";
            let page_count = Math.ceil(items.length / rows_per_page);
            for (let i = 1; i < page_count + 1; i++) {
                let btn = PaginationButton(i, items);
                wrapper.appendChild(btn);
            }
        }
        function PaginationButton (page, items) {
            let button = document.createElement('button');
            button.innerText = page;
            if (current_page == page) button.classList.add('active');
            button.addEventListener('click', function () {
                current_page = page;
                DisplayList(items, list_element, rows, current_page);
                let current_btn = document.querySelector('.pagenumbers button.active');
                current_btn.classList.remove('active');
                button.classList.add('active');
            });
            return button;
        }
        DisplayList(list_items, list_element, rows, current_page);
        SetupPagination(list_items, pagination_element, rows);
@endif    
</script>
@endsection