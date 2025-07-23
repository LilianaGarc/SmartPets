<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<footer class="piepagina">
    <div class="contenedor-piepagina">
        <div class="columnas-piepagina">
            <div class="columna-piepagina">
                <h3 class="titulo-columna-pie"><span>SmartPets</span></h3>
                <nav class="menu-piepagina">
                    <ul class="lista-enlaces-pie">
                        <li class="item-enlace-pie">
                            <a href="{{route('publicaciones.index')}}" class="enlace-piepagina">Publicaciones</a>
                        </li>
                        <li class="item-enlace-pie">
                            <a href="{{route('adopciones.index')}}" class="enlace-piepagina">Adopciones</a>
                        </li>
                        <li class="item-enlace-pie">
                            <a href="{{route('veterinarias.index')}}" class="enlace-piepagina">Veterinarias</a>
                        </li>
                        <li class="item-enlace-pie">
                            <a href="{{route('chatbot.index')}}" class="enlace-piepagina">Mascota ideal</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="columna-piepagina">
                <h3 class="titulo-columna-pie"><span>‎ </span></h3>
                <nav class="menu-piepagina">
                    <ul class="lista-enlaces-pie">
                        <li class="item-enlace-pie">
                            <a href="{{ route('chats.index') }}" class="enlace-piepagina">PetChat</a>
                        </li>
                        <li class="item-enlace-pie">
                            <a href="{{route('eventos.index')}}" class="enlace-piepagina">Eventos</a>
                        </li>
                        <li class="item-enlace-pie">
                            <a href="{{route('productos.index')}}" class="enlace-piepagina">PetShop</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="columna-piepagina">
                <h3 class="titulo-columna-pie"><span>‎ </span></h3>
                <nav class="menu-piepagina">
                    <ul class="lista-enlaces-pie">
                        <li class="item-enlace-pie">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=smartpetsunah@gmail.com&su=Consulta&body=Hola,%20me%20gustaría%20saber%20más%20sobre..." class="enlace-piepagina" target="_blank">smartpetsunah@gmail.com</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="derechos-piepagina">
            <p>&copy; 2025 DevStorm. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<style>

    .piepagina {
        position: relative;
        padding: 1.5rem 5%;
        color: white;
        background-color: #172d57;
        width: 100%;
        font-family: 'Arial', sans-serif;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin-top: 22rem;
    }

    .contenedor-piepagina {
        width: 100%;
        padding: 0 0.5rem;
        box-sizing: border-box;
    }

    .columnas-piepagina {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .columna-piepagina {
        width: 30%;
        box-sizing: border-box;
        padding: 0.5rem;
    }

    .titulo-columna-pie {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        font-weight: bold;
        text-align: start;
        color: white;
    }

    .piepagina a {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .piepagina a:hover {
        color: #ff7c40;
    }

    .lista-enlaces-pie {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
        list-style: none;
        padding-left: 0;
    }

    .item-enlace-pie {
        font-size: 1.2rem;
    }

    .enlace-piepagina {
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .enlace-piepagina:hover {
        transform: translateX(3px);
    }

    .derechos-piepagina {
        padding-top: 1.5rem;
        margin-top: 1.5rem;
        text-align: center;
        font-size: 1rem;
    }

    .derechos-piepagina p {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .derechos-piepagina a {
        margin-left: 0.3rem;
        color: white;
    }
    .titulo-columna-pie span {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.8rem;
        letter-spacing: 1.5px;
        color: #ff7c40;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }


    @media (max-width: 600px) {
        .columnas-piepagina .columna-piepagina:last-child {
            display: none;
        }

        .piepagina {
            font-size: 1rem;
        }

        .titulo-columna-pie {
            font-size: 1.1rem;
        }

        .piepagina a,
        .item-enlace-pie {
            font-size: 1rem;
        }

        .derechos-piepagina {
            font-size: 0.8rem;
            padding-top: 1rem;
            margin-top: 1rem;
        }
    }


</style>
