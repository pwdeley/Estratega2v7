
@extends('../principal.app')

@section('tituloContacto')
    <section class="section bg-default section-md">
        <div class="container">
            <div class="row row-30">
                <div class="cool-md-6">
                    <h2 class="title-icon"><span class="icon icon-default mercury-icon-target-2"></span><span>Apreciamos<span class="text-light"> tu interés por nuestros servicios.</span></span></h2>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('contenidoContacto')
    <section class="section bg-default section-md">
        <div class="container">
            <div class="row row-30">
                <div class="col-md-6">

                    <div class="servicios">
                        <div class="textoservicios">

                            <form action="correo.php" method="post">
                                <input type="text" placeholder="Tu nombre..." name="nombre" required>
                                <input type="email" placeholder="Email de contacto" name="correo" required>
                                <h3><font size="5" color="white">..Día y hora en que deseas reunirte:</font></h3>
                                <input type="date" placeholder="Fecha de reunión" name="fecha" required>
                                <textarea placeholder="Aquí tu mensaje..." name="mensaje"></textarea>
                                <input type="submit" id="boton" value="Enviar Reunión Propuesta">
                            </form>

                            <p>

                                En un máximo de 24 horas un asesor se pondrá en contacto contigo.<br><br>
                                Nos puedes contactar también al email: gerencia@estrategacontable.com <br><br>
                                Atentos Saludos,<br>
                                ESTRATEGA CONTABLE<br><br><br><br>

                                <i>"Sólo una cosa vuelve un sueño imposible: el miedo a fracasar."<br>
                                    <strong>Paulo Coelho</strong></i>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
