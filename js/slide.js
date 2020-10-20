$(function () {
    //객체참조변수선언
    var container = $(".slideshow");
    var slideGroup = container.find(".slideshow_slides");
    var slides = slideGroup.find("a"); //배열길이 4개[a] - slideshow_slides
    var nav = container.find(".slideshow_nav");
    var prev = nav.find(".prev");
    var next = nav.find(".next");
    var indicator = container.find(".slideshow_indicator");
    var aIndicator = indicator.find("a"); //배열길이 4개[a] - slideshow_indicator

    var currentIndex = -1;
    var intervalObject;

    //1. 슬라이드를 자동으로 움직이는 기능을 구현하겠다.
    //1.1 이미지를 가로로 배치시켜야한다.
    // for(var index = 0; index < slides.length; index++){
    //     var indexLeft = index*100 + "%";
    //     slides.eq(index).css("left", indexLeft); // slides[index] == slides.eq(index)
    // }
    //1.1 위와 같다.
    slides.each(function (i) {
        var newLeft = i * 100 + "%";
        $(this).css({ left: newLeft });
    });

    //1.2 자동으로 애니메이션으로 보이는 방법구현
    function gotoSlide(index) {
        //애니메이션주는방법 객체.animate(구현내용, 걸리는 시간, 보여주는 방법)
        //구현내용: left값을 0%, -100%, -200%, -300%로 구현
        //걸리는시간: 1초
        //보여주는방법: 1칸씩 움직이는데 절도있는 방식 
        slideGroup.animate({ left: -100 * index + '%' }, 500, 'swing');
        indexDisplay(index);
    }

    function indexDisplay(index) {
        //index: 0일때 왼쪽버튼은 안보이고 오른쪽버튼은 보이고
        //index: 3일때 왼쪽버튼은 보이고 오른쪽버튼은 안보이고
        switch (index) {
            case 0:
                prev.hide();
                next.show();
                break;
            case 1:
            case 2:
                prev.show();
                next.show();
                break;
            case 3:
                prev.show();
                next.hide();
                break;
            default:
                break;
        }
        //slideshow_indicator 배경화면을 셋팅한다.
        aIndicator.removeClass('active');
        aIndicator.eq(index).addClass('active');
    }

    function startTimer() {
        intervalObject = setInterval(function () {
            var nextIndex = (currentIndex + 1) % slides.length;
            currentIndex = nextIndex;
            gotoSlide(nextIndex);
        }, 3500);
    }

    function stopTimer() {
        clearInterval(intervalObject);
    }

    //마우스를 영역에 올렸을때 이벤트
    container.mouseenter(function () {
        stopTimer();
    });

    //마우스가 영역에서 나왔을때 이벤트
    container.mouseleave(function () {
        startTimer();
    });

    //이전버튼을 눌렀을때 이벤트
    prev.on("click", function (e) {
        // e.preventDefault(); // 원래 anker 기능을 하지못하도록 막는다. (#으로해서 안해도됨.)
        if (currentIndex !== 0) {
            currentIndex -= 1;
        } else {
            currentIndex = 0;
        }
        gotoSlide(currentIndex);
    });

    //다음버튼을 눌렀을때 이벤트
    next.on("click", function (e) {
        // e.preventDefault(); // 원래 anker 기능을 하지못하도록 막는다. (#으로해서 안해도됨.)
        if (currentIndex !== slides.length - 1) {
            currentIndex += 1;
        } else {
            currentIndex = slides.length - 1;
        }
        gotoSlide(currentIndex);
    });

    //slideshow_indicator a 눌렀을때 이벤트
    aIndicator.on("click", function(e){
        // e.preventDefault(); // 원래 anker 기능을 하지못하도록 막는다. (#으로해서 안해도됨.)
        var index = $(this).index();
        gotoSlide(index);
    });

    //맨처음 진행시 초기화
    indexDisplay(0);

    startTimer();
});