<head>
    <style>
        .container-filtros-prontos{
            position: absolute;
            top: 0;
            bottom: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgb(89 89 89); 
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius:10px;
            box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.3);
            max-width: 70%
        }

        .filtro{
            width: 210px;
            height: 210px;
            background-color: white;
            border-radius: 5px;
            margin: 20px;
            display:flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.3);
            transition: 0.5s all;
            cursor: pointer
        }

        .filtro:hover{
            transform: scale(1.05);
        }

        .h3-filtro{
            color: black;
        }


    </style>
</head>
<div class='container-filtros-prontos'>
    <div class='filtro borda'><img src="imagens/filtro-borda.png" style='width: 120px'/><h3 class='h3-filtro'>Detecção Bordas</h3></div>
    <div class='filtro nitidez'><img src="imagens/filtro-nitidez.png" style='width: 120px'/><h3 class='h3-filtro'>Filtro de Nitidez</h3></div>
    <div class='filtro destacarrelevo'><img src="imagens/filtro-destacar-relevo.png" style='width: 120px'/><h3 class='h3-filtro'>Destacar Relevo</h3></div>
</div>
<script>
        $(document).ready(function() {

            $('.filtro.borda').click(()=>{
                var filtroBorda = [-1, -1, -1, -1, 8, -1, -1, -1, -1];
                updateMatrizInputs(filtroBorda);
                $('.overlay').css('display','none');
                $('.carregar-pagina-filtros').empty();
            })

            $('.filtro.nitidez').click(()=>{
                var filtroNitidez = [ 0,-1,0,-1,5,-1,0,-1,0];
                updateMatrizInputs(filtroNitidez);
                $('.overlay').css('display','none');
                $('.carregar-pagina-filtros').empty();
            });

            $('.filtro.destacarrelevo').click(()=>{
                var filtroDestacarRelevo = [-2,-1,0,-1,1,1,0,1,2];
                updateMatrizInputs(filtroDestacarRelevo);
                $('.overlay').css('display','none');
                $('.carregar-pagina-filtros').empty();
            });
            
        })

</script>