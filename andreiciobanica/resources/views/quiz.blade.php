@extends('layouts.app')

@section('content')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Work+Sans:300,600);
        body {
            text-align: center;
        }
        .question {
            font-size: 20px;
            margin: 10px;
        }
        .answers {
            margin: 10px;
            text-align: left;
            display: inline-block;
        }
        .answers label {
            display: block;
            margin: 5px;
        }
        .btn-z {
            font-family: Montserrat;
            font-size: 22px;
            background: rgb(33, 141, 253);
            background: -moz-linear-gradient(19deg, rgba(33, 141, 253, 1) 0%, rgba(245, 33, 255, 1) 100%);
            background: -webkit-linear-gradient(19deg, rgba(33, 141, 253, 1) 0%, rgba(245, 33, 255, 1) 100%);
            background: linear-gradient(19deg, rgba(33, 141, 253, 1) 0%, rgba(245, 33, 255, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#218dfd", endColorstr="#f521ff", GradientType=1);
            color: #fff;
            border: 0px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #38a;
        }
        #previous {
            margin: 3px;
        }
        #next {
            margin: 3px;
        }
        #submit {
            margin: 3px;
        }
        .slide {
            width: 100%;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.5s;
        }
        .active-slide {
            opacity: 1;
            z-index: 2;
        }
        .quiz-container {
            position: relative;
        }
    </style>
    <style>
        .fh2 {
            height: 100vh;
            width: 50%;
            max-width: 50vw;
        }
        .fh {
            height: 100vh;
            width: 100%;
            max-width: 100vw;
        }
        .valid-feedback {
            font-family: Montserrat;
            color: #64d81b;
        }
        .invalid-feedback {
            font-family: Montserrat;
            color: #d82f2f;
        }
        #menu ul {
            margin: 0;
            padding: 0;
            display: flex;
        }
        #menu {
            background: rgb(33, 141, 253);
            background: -moz-linear-gradient(19deg, rgba(33, 141, 253, 1) 0%, rgba(245, 33, 255, 1) 100%);
            background: -webkit-linear-gradient(19deg, rgba(33, 141, 253, 1) 0%, rgba(245, 33, 255, 1) 100%);
            background: linear-gradient(19deg, rgba(33, 141, 253, 1) 0%, rgba(245, 33, 255, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#218dfd", endColorstr="#f521ff", GradientType=1);
        }
        #menu .row {
            display: table;
        }
        #menu .row li {
            list-style: none;
        }
        #menu .row li a {
            display: block;
            position: relative;
            text-decoration: none;
            padding: 5px;
            font-size: 24px;
            font-family: Montserrat;
            color: #fff;
            text-transform: uppercase;
            transition: 0.5s;
        }
        #menu .row:hover li a {
            transform: scale(1.5);
            opacity: 0.2;
            filter: blur(5px);
        }
        #menu .row li a:hover {
            transform: scale(2);
            opacity: 1;
            filter: blur(0);
        }
        #menu .row li a:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(33, 159, 253);
            background: -moz-linear-gradient(-161deg, rgba(33, 159, 253, 1) 0%, rgba(238, 33, 255, 1) 100%);
            background: -webkit-linear-gradient(-161deg, rgba(33, 159, 253, 1) 0%, rgba(238, 33, 255, 1) 100%);
            background: linear-gradient(-161deg, rgba(33, 159, 253, 1) 0%, rgba(238, 33, 255, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#219ffd", endColorstr="#ee21ff", GradientType=1);
            border-radius: 30px;
            transition: 0.5s;
            transform-origin: right;
            transform: scaleX(0);
            z-index: -1;
        }
        #menu .row li a:hover:before {
            transition: transform 0.5s;
            transform-origin: left;
            transform: scaleX(1);
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        main .list {
            width: 100%;
            max-width: 768px;
            background-color: #FFF;
            border-radius: 20px;
            margin-top: 25px;
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
        .item {
            border: 1px solid #CCC;
            border-radius: 10px;
            margin: 10px;
        }
    </style>
<section class="text-center content-section h-100 w-100" id="rezultate_quiz" style="overflow-x: hidden; background: url({{ asset('img/bg-3.jpg') }}) center / cover no-repeat;">
<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto text-dark">
            <div class="card">
                    <div class="card-body">
                    <div id="quiz"></div>
                    <form action="{{route('rquiz', [$id_curs, $id_capitol, $id_lectie])}}" method="post" name="rezultat"
                        id="rezultat">
                        @csrf
                        <input type="text" id="results" name="results" hidden/>
                    </form>
                    <button id="previous" class="btn text-light btn-dark">Întrebarea precedentă</button>
                    <button id="next" class="btn text-light btn-dark">Întrebarea următoare</button>
                    <button id="submit" form="rezultat" class="btn text-light btn-dark">Verifică!</button>
                    </div>
            </div>
        </div>
    </div>
</div>
</section>

    @php
        $raspunsuri = explode('~', $detalii->raspunsuri);
        foreach($raspunsuri as $index => $item){
        $raspunsuri[$index] = explode('|', $item);
    }
        $raspunscorect = explode('~', $detalii->raspunscorect);
        $intrebari = explode('~', $detalii->intrebari);
    @endphp
    <script type="text/javascript">(function () {
            function buildQuiz() {
                const output = [];
                myQuestions.forEach(
                    (currentQuestion, questionNumber) => {
                        const answers = [];
                        for (letter in currentQuestion.answers) {
                            answers.push(
                                `<label>
              <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
                            );
                        }
                        if (questionNumber + 1 < myQuestions.length) {
                            output.push(
                                `<div class="slide" style="position:relative;">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
                            );
                        } else {
                            output.push(
                                `<div class="slide" style="position:relative;">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
                            );
                        }
                    }
                );
                quizContainer.innerHTML = output.join('');
            }
            function showResults() {
                const answerContainers = quizContainer.querySelectorAll('.answers');
                let numCorrect = 0;
                myQuestions.forEach((currentQuestion, questionNumber) => {
                    const answerContainer = answerContainers[questionNumber];
                    const selector = `input[name=question${questionNumber}]:checked`;
                    const userAnswer = (answerContainer.querySelector(selector) || {}).value;
                    if (userAnswer === currentQuestion.correctAnswer) {
                        numCorrect++;
                        answerContainers[questionNumber].style.color = 'lightgreen';
                    } else {
                        answerContainers[questionNumber].style.color = 'red';
                    }
                });
                document.getElementById('results').value = numCorrect;
            }
            function showSlide(n) {
                slides[currentSlide].classList.remove('active-slide');
                slides[n].classList.add('active-slide');
                currentSlide = n;
                if (currentSlide === 0) {
                    previousButton.style.display = 'none';
                } else {
                    previousButton.style.display = 'inline-block';
                }
                if (currentSlide === slides.length - 1) {
                    nextButton.style.display = 'none';
                    submitButton.style.display = 'inline-block';
                } else {
                    nextButton.style.display = 'inline-block';
                    submitButton.style.display = 'none';
                }
            }
            function showNextSlide() {
                showSlide(currentSlide + 1);
            }
            function showPreviousSlide() {
                showSlide(currentSlide - 1);
            }
            // Variables
            const quizContainer = document.getElementById('quiz');
            const submitButton = document.getElementById('submit');
            const myQuestions = [
                    @foreach($intrebari as $contor => $intrebare)
                {
                    @php $litera = chr(97); $i=0; @endphp
                    question: {!! json_encode($intrebare) !!},
                    answers: {
                    @foreach($raspunsuri[$contor] as $contor1 => $raspuns)
                    @if($i===array_key_last($raspunsuri[$contor]))
                    {{$litera}}:{!! json_encode($raspuns) !!}
                    @else
                    {{$litera}}:{!! json_encode($raspuns)!!},
                    @endif
                    @if($i===array_key_last($raspunsuri[$contor]))
                },
                @endif
                    @php $literaASCII = ord($litera)+1;
            $litera = chr($literaASCII);
            $i++;
                    @endphp
                    @endforeach
                    correctAnswer
        : {!! json_encode($raspunscorect[$contor]) !!}
        },
            @endforeach
        ]
            ;
            buildQuiz();
            const previousButton = document.getElementById("previous");
            const nextButton = document.getElementById("next");
            const slides = document.querySelectorAll(".slide");
            let currentSlide = 0;
            showSlide(currentSlide);
            document.getElementById('rezultat').addEventListener("submit", showResults);
            previousButton.addEventListener("click", showPreviousSlide);
            nextButton.addEventListener("click", showNextSlide);
        })();
    </script>
@endsection