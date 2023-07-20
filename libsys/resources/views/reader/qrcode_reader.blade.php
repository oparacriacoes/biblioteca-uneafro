<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let scanner;
    let videoContainer = document.getElementById('videoContainer');
    let btnShowVideo = document.getElementById('btnShowVideo');

    function initializeScanner() {
        scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                videoContainer.style.display = 'block'; // Exibe o vídeo quando a câmera estiver disponível
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (content) {
            document.getElementById('slBook').value = content;
        });
    }

    // Ao clicar no botão, inicializa o scanner e exibe o vídeo
    btnShowVideo.addEventListener('click', function () {
        initializeScanner();
    });

    // Inicializa o scanner automaticamente quando a página é carregada
    $(document).ready(function() {
        initializeScanner();
    });
</script>
