//로딩 애니메이션 구현하는 jQuery
$( function () {
    // 함수 호출(실행)
    imagesProgress();
    // 진행률을 표시 해주는 함수 정의
    function imagesProgress () {
        // HTML 요소의 jQuery 객체화(변수화)
        var $container      =   $( '#progress' ),                     // 1
            $progressBar    =   $container.find( '.progress-bar' ),   // 2
            $progressText   =   $container.find( '.progress-txt' ),   // 3
            // 1. 진행률 표시 전체 컨테이너
            // 2. 진행률 표시 막대 그래프
            // 3. 진행률 표시 텍스트(0% ~ 100%)
            /*
                전체 이미지 개수와 로딩이 완료된 이미지 개수의 실시간 파악을 위해
                imagesLoaded 플러그인(imagesloaded.pkgd.min.js)을 이용해서
                이미지 로딩 현황을 모니터링 하고, 진행률 표시
            */
            // body 요소의 이미지 로딩 상황 모니터링
            // body 요소의 전체 이미지 개수를 저장
            imgLoad     =   imagesLoaded( 'body'),
            imgTotal    =   imgLoad.images.length,
            // 로딩 완료된 이미지 개수
            // 현재 로딩 진행률에 해당하는 수치 저장(초기값은 0)
            imgLoaded   =   0,
            current     =   0,
            // 이미지 로딩 현황 계산 : 1/60초(1초에 60회)
            progressTimer   =   setInterval( updateProgress, 1000/60 );
        // imagesLoaded 플러그인으로 이미지를 로딩할 때마다 1개씩 카운트
        imgLoad.on( 'progress', function () {
           imgLoaded++;
        } );
        /*
            이미지 로딩 상황을 로딩 진행률 표시에 반영(업데이트)
            updateProgress() 함수 정의
        */
        // 이미지의 로드 상황을 기준으로 진행 표시 업데이트
        // setInterval() 메소드에 의해서 1초에 60번씩 호출(실행)
        function updateProgress () {
            // 로딩 완료된 이미지의 비율 계산 후 target 변수에 저장
            // 로딩된 이미지 개수: imgLoaded, 전체 이미지 개수: imgTotal
            var target = ( imgLoaded / imgTotal ) * 100;
            // 현재 위치(current)와 최종 목적(target)의 거리차 기준 여백
            current = current + ( target - current ) * 0.1
            // 표시된 바의 폭과 텍스트에 현재 위치 값(current) 반영
            $progressBar.css( { width: current + '%' } );
            // 텍스트의 경우(진행상황을 나타내는 숫자(%) : current)
            // 소수점 이하를 버리고 정수로 표현 : Math.floor
            $progressText.text( Math.floor(current) + '%' );
            /*
                로딩 진행률 표시 종료(완료)
                current 의 값이 100을 넘어가는 순간 실행
            */
            if ( current >= 100 ) {
                // 진행률 표시 업데이트 중지
                clearInterval( progressTimer );
                // progress-complete 클래스 추가
                // .addClass() : 클래스 추가 메소드
                $container.addClass( 'progress-complete' );
                // progressBar와 progressText를 그룹화해서
                // 진행률 막대와 텍스트를 동시에 애니메이션 적용
                $progressBar.add( $progressText )
                    // 0.5초(500밀리초) 대기, 1000ms = 1s
                    .delay( 500 )
                    // 0.25초(250밀리초) 동안 투명도를 0으로
                    .animate( { opacity: 0 }, 250, function () {
                        // 1초(1000밀리초) 동안 $container를 위쪽으로 슬라이드
                        $container.animate( { top: '-100%' }, 1000, 'easeInOutQuint' );
                } );
            }
            // current 가 99.9보다 클 경우 100으로 인식
            if ( current > 99.9 ) {
                current = 100;
								$container.style.display = "none";
            }
        }
    }
} );