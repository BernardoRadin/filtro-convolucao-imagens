<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>FILTRO CONVOLUCAO</title>
</head>
<body>
    <div class='div-principal'>
        <div class='overlay'></div>
        <div class='carregar-pagina-filtros'></div>
        <div class='carregando'><img src="imagens/image.gif" style='width: 150px'/></div>
        <div class='div-lateral'>
            <h3>Filtro de Convolução</h3>
            <form class='formulario-filtro'>
            <div class='div-range'>
                <label class='label-tmatriz'>Tamanho da Matriz:</label>
                <strong><p class='val-range' id="rangeValue">3</p></strong>
                <input class='input-range' id="rangeInput" type="range" name="tamanho" min="3" max="7" oninput="updateValueRange(this.value)" onchange="CriaInputs(this.value)" value="3"  required />
            </div>
                <div class='align-center'>
                    <div class='matriz-filtro'>
                    </div>
                </div>
                <div class="align-center" style='margin-top: 20px'>
                    <label class="control-label label-bordered" id="load-filtros-prontos">Filtros prontos</label>
                </div>
                <div class="align-center" style='margin-top: 20px'>
                    <label for="arquivo" class="label-bordered">Selecionar imagem</label>
                    <input type="file" id="arquivo" name="arquivo" class="input-file" required/>
                </div>
                <p class='file-name'></p>
                <div class="align-center">
                    <input type="submit" class="submit-file">
                </div>
            </form> 
            <!-- <div class='nomes'>
                <label class='nome'>Bernardo Radin</label></br>
                <label class='nome'>Mateus Alves</label></br>
                <label class='nome'>Gabriel Birck</label>
            </div> -->
        </div>
        <div class='meio'>
            <img class="imagem"/>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('#load-filtros-prontos').click(()=>{
                $('.overlay').css('display','flex');
                $('.carregar-pagina-filtros').load('filtros-prontos.php');
            })

            $('.overlay').click(()=>{
                $('.overlay').css('display','none');
                $('.carregar-pagina-filtros').empty();
            })

            $('.formulario-filtro').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    method: "POST",
                    url: "filtro-convolucao.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    beforeSend: function(){
                        $('.carregando').css('display','flex');
                    },
                    success: function(response){
                        $('.carregando').css('display','none');
                        var imageURL = URL.createObjectURL(response);
                        $('.imagem').attr('src', imageURL);
                    }
                });
            });
        });

        const file = document.querySelector('.input-file');
        file.addEventListener('change', (e) => {
            if(e.target.files.length > 0){
                const [file] = e.target.files;
                const { name: fileName, size } = file;
                const fileSize = (size / 1000).toFixed(2);
                const fileNameAndSize = `${fileName} - ${fileSize}KB`;
                document.querySelector('.file-name').textContent = fileNameAndSize;
            }else{
                document.querySelector('.file-name').textContent = '';
            }
        });

        function updateValueRange(val) {
            $('#rangeValue').text(val);
        }

        function CriaInputs(value) {
            var container = $('.matriz-filtro');
            container.empty(); // Clear existing inputs

            var width = 60;
            var height = 60;
            var margin = 2;

            var numeroinputs = value * value;
            for (var i = 0; i < numeroinputs; i++) {
                var input = $('<input>', {
                    type: 'text',
                    class: 'input-matriz',
                    name: 'matriz[]',
                    required: true
                });
                
                if(value > 3){
                    width /= 1.017;
                    height /= 1.017;
                    // margin -= 0.1;
                }
            
                container.append(input);
            }

            $('.input-matriz').css({
                width: width + 'px',
                height: height + 'px'
                // margin: margin + 'px'
            });
        }

        CriaInputs(3);

    </script>
</body>
</html>