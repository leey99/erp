//�ε� �ִϸ��̼� �����ϴ� jQuery
$( function () {
    // �Լ� ȣ��(����)
    imagesProgress();
    // ������� ǥ�� ���ִ� �Լ� ����
    function imagesProgress () {
        // HTML ����� jQuery ��üȭ(����ȭ)
        var $container      =   $( '#progress' ),                     // 1
            $progressBar    =   $container.find( '.progress-bar' ),   // 2
            $progressText   =   $container.find( '.progress-txt' ),   // 3
            // 1. ����� ǥ�� ��ü �����̳�
            // 2. ����� ǥ�� ���� �׷���
            // 3. ����� ǥ�� �ؽ�Ʈ(0% ~ 100%)
            /*
                ��ü �̹��� ������ �ε��� �Ϸ�� �̹��� ������ �ǽð� �ľ��� ����
                imagesLoaded �÷�����(imagesloaded.pkgd.min.js)�� �̿��ؼ�
                �̹��� �ε� ��Ȳ�� ����͸� �ϰ�, ����� ǥ��
            */
            // body ����� �̹��� �ε� ��Ȳ ����͸�
            // body ����� ��ü �̹��� ������ ����
            imgLoad     =   imagesLoaded( 'body'),
            imgTotal    =   imgLoad.images.length,
            // �ε� �Ϸ�� �̹��� ����
            // ���� �ε� ������� �ش��ϴ� ��ġ ����(�ʱⰪ�� 0)
            imgLoaded   =   0,
            current     =   0,
            // �̹��� �ε� ��Ȳ ��� : 1/60��(1�ʿ� 60ȸ)
            progressTimer   =   setInterval( updateProgress, 1000/60 );
        // imagesLoaded �÷��������� �̹����� �ε��� ������ 1���� ī��Ʈ
        imgLoad.on( 'progress', function () {
           imgLoaded++;
        } );
        /*
            �̹��� �ε� ��Ȳ�� �ε� ����� ǥ�ÿ� �ݿ�(������Ʈ)
            updateProgress() �Լ� ����
        */
        // �̹����� �ε� ��Ȳ�� �������� ���� ǥ�� ������Ʈ
        // setInterval() �޼ҵ忡 ���ؼ� 1�ʿ� 60���� ȣ��(����)
        function updateProgress () {
            // �ε� �Ϸ�� �̹����� ���� ��� �� target ������ ����
            // �ε��� �̹��� ����: imgLoaded, ��ü �̹��� ����: imgTotal
            var target = ( imgLoaded / imgTotal ) * 100;
            // ���� ��ġ(current)�� ���� ����(target)�� �Ÿ��� ���� ����
            current = current + ( target - current ) * 0.1
            // ǥ�õ� ���� ���� �ؽ�Ʈ�� ���� ��ġ ��(current) �ݿ�
            $progressBar.css( { width: current + '%' } );
            // �ؽ�Ʈ�� ���(�����Ȳ�� ��Ÿ���� ����(%) : current)
            // �Ҽ��� ���ϸ� ������ ������ ǥ�� : Math.floor
            $progressText.text( Math.floor(current) + '%' );
            /*
                �ε� ����� ǥ�� ����(�Ϸ�)
                current �� ���� 100�� �Ѿ�� ���� ����
            */
            if ( current >= 100 ) {
                // ����� ǥ�� ������Ʈ ����
                clearInterval( progressTimer );
                // progress-complete Ŭ���� �߰�
                // .addClass() : Ŭ���� �߰� �޼ҵ�
                $container.addClass( 'progress-complete' );
                // progressBar�� progressText�� �׷�ȭ�ؼ�
                // ����� ����� �ؽ�Ʈ�� ���ÿ� �ִϸ��̼� ����
                $progressBar.add( $progressText )
                    // 0.5��(500�и���) ���, 1000ms = 1s
                    .delay( 500 )
                    // 0.25��(250�и���) ���� ������ 0����
                    .animate( { opacity: 0 }, 250, function () {
                        // 1��(1000�и���) ���� $container�� �������� �����̵�
                        $container.animate( { top: '-100%' }, 1000, 'easeInOutQuint' );
                } );
            }
            // current �� 99.9���� Ŭ ��� 100���� �ν�
            if ( current > 99.9 ) {
                current = 100;
								$container.style.display = "none";
            }
        }
    }
} );