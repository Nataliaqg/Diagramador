<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input id="id">
    <button onclick="conectar()">Conectar</button>

    <input id="idReceptor">
    <button onclick="enviarMsg()">Enviar mensaje</button>
    <script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
    <script>
        let socket;
        const id = document.getElementById('id');
        const idReceptor = document.getElementById('idReceptor');

        function conectar() {
            socket = io('http://localhost:8080',{
                transports:['websocket'],
                extraHeaders: {
                    'x-token': id.value
                }
            });
            
            socket.on('connect', () => {
                console.log('conectado')
            });

            socket.on('escucharMensaje',()=>{
                const idR=idReceptor.value
                 console.log('si escuche:',idR)                                 
            })
        }

        function enviarMsg(){
            const idR=idReceptor.value
            socket.emit('enviarMensaje',idR);
        }
    </script>
</body>
</html>