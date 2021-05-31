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
<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-1.jpg') }}) center / cover no-repeat;">
        <div class="intro-body">
            <div class="container animate__animated animate animate__fadeInDown">
                <div class="row justify-content-center">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="brand-heading" style="font-size: 56px;font-family: 'Titillium Web', sans-serif;letter-spacing: 0px;line-height: 60px;">Probleme de informatică(C/C++)</h1>
                        <a class="btn btn-link btn-circle" role="button" href="#probleme"><i class="fa fa-angle-double-down animated"></i></a>
                    </div>
                </div>
            </div>
        </div>
</header>

<section class="text-center content-section" id="probleme" style="overflow-x: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                <main>
                <div class="list" id="list"></div>
                <div class="pagenumbers" id="pagination"></div>
                </main>
                </div>
        </div>
    </div>
</section>
<script type="text/javascript">const list_items = [
        @foreach($detalii as $key=>$obiect)
                "<div class=\"problema\"><div class=\"clearfix\"><a class=\"float-left\" href=\"{{route('problema', ['id'=>$obiect->id])}}\">{{$obiect->nume}}</a> <div class=\"float-right\">@php $c=0 @endphp @foreach($detalii_sol as $k => $obj) @if($obiect->id == $obj->id_problema && $obj->punctaj==3 && $c!=1)<i class=\"fa fa-check\" aria-hidden=\"true\" style=\"color: green; font-size: 20px;\"></i> @php $c=1 @endphp @endif @endforeach</div></div><div class=\"dropdown-divider\"></div>{{$obiect->descriere}}</div> ",
            @endforeach
        ];
        const list_element = document.getElementById('list');
        const pagination_element = document.getElementById('pagination');
        let current_page = 1;
        let rows = 3;
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
        </script>
@endsection