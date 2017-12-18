@extends('layouts.main')

@section('styles')
    <!-- Estilo especial para la pagina inicial -->
    <link rel="stylesheet" href="assets/css/front-custom.css">
@endsection

@section('scripts')
@endsection

@section('content')
   
    @include('layouts.front-nav')

    <div class="highlight-phone" style="background: white; padding-top: 100px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="intro">
                        <h2>Usa Ticketter y valora tu tiempo</h2>
                        <p>Ticketter te permite obtener numeros de atencion de manera remota para los servicios que mas necesitas. No pierda mas tiempo haciendo filas y mantengase organizado. ¡Pruebe Ticketter ahora!</p><a class="btn btn-info" role="button"
                        href="/ingresar">Ingresar al sistema</a></div>
                </div>
                <div class="col-sm-4 hidden-xs">
                    <div class="iphone-mockup"><img src="assets/img/iphone.svg" class="device">
                        <div class="screen"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="features-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">¿Que hace Ticketter por mi?</h2>
                <p class="text-center">Ticketter es un avanzado sistema de manejo de colas, que entrega valor tanto a instituciones como a los usuarios finales de estas.</p>
            </div>
            <div class="row features">
                <div class="col-md-4 col-sm-6 item"><i class="fa fa-map-marker icon fa-fw"></i>
                    <h3 class="name">Tickets remotos</h3>
                    <p class="description">Ya no necesitas viajar 2 horas hasta la sucursal del tu banco para sacar un ticket de atencion. ¡Hazlo desde tu casa!</p>
                </div>
                <div class="col-md-4 col-sm-6 item"><i class="fa fa-clock-o icon fa-fw"></i>
                    <h3 class="name">Ahorra tiempo</h3>
                    <p class="description">No estes esperando dias haciendo filas. Obten un ticket, mira tu tiempo de espera y aprovecha el resto del tiempo.</p>
                </div>
                <div class="col-md-4 col-sm-6 item"><i class="fa fa-list-alt icon fa-fw"></i>
                    <h3 class="name">Adaptable </h3>
                    <p class="description">Completamente configurable. Ticketter se adapta a lo que tu necesitas y como tu lo necesites. ¿Quien mas lo hace por ti?.</p>
                </div>
                <div class="col-md-4 col-sm-6 item"><i class="fa fa-leaf icon fa-fw"></i>
                    <h3 class="name">Piensa en el ambiente</h3>
                    <p class="description">Cada ticket que sacas a traves de Ticketter es un pedazo de papel menos que se gasta. De nada naturaleza.</p>
                </div>
                <div class="col-md-4 col-sm-6 item"><i class="fa fa-bar-chart icon fa-fw"></i>
                    <h3 class="name">Registro de informacion</h3>
                    <p class="description">Ten guardada y siempre disponible la informacion relevante de tus usuarios para tu negocio.</p>
                </div>
                <div class="col-md-4 col-sm-6 item"><i class="fa fa-mobile-phone icon fa-fw"></i>
                    <h3 class="name">Pensado para moviles</h3>
                    <p class="description">Usalo desde moviles a traves de la aplicacion web. Te aseguramos que no necesitaras quimioterapia despues.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 item">
                        <h3>Integrantes </h3>
                        <ul>
                            <li><a href="#">Reinaldo Jerez</a></li>
                            <li><a href="#">Patricio Castro</a></li>
                            <li><a href="#">Darlyn Gonzalez</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-4 item">
                        <h3>Invitado</h3>
                        <ul>
                            <li><a href="#">Alejandro Naranjo</a></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-4 item">
                        <h3>Profesor </h3>
                        <ul>
                            <li><a href="#">Daniel Moreno</a></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-md-3 item social"><a href="#" style="visibility: hidden;"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">Tecnologias Web © 2017</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection