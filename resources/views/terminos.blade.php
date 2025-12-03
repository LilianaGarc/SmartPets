<x-guest-layout>
    @section('title', 'Términos y Condiciones')

    <div style="max-width: 900px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h1 style="color: #333; border-bottom: 2px solid #ff7f50; padding-bottom: 10px;"><strong>Términos y Condiciones</strong></h1>
        <p style="color: #666;">Última actualización: {{ date('d/m/Y') }}</p>
        <hr style="margin: 20px 0;">

        <div style="line-height: 1.6;">
            <h2 style="color: #333; margin-top: 20px;">1. Aceptación de los términos</h2>
            <p style="color: #555;">
                Al crear una cuenta y utilizar nuestro sitio, usted acepta cumplir con estos términos.
                Si no está de acuerdo, por favor no utilice la plataforma.
            </p>

            <h2 style="color: #333; margin-top: 20px;">2. Uso permitido</h2>
            <p style="color: #555;">
                El usuario se compromete a utilizar el sitio únicamente para fines legítimos y respetuosos.
            </p>

            <h2 style="color: #333; margin-top: 20px;">3. Protección de datos</h2>
            <p style="color: #555;">
                Sus datos personales serán tratados de acuerdo con nuestra política de privacidad.
                Nunca serán vendidos ni compartidos sin consentimiento.
            </p>

            <h2 style="color: #333; margin-top: 20px;">4. Seguridad</h2>
            <p style="color: #555;">
                El usuario es responsable de mantener la confidencialidad de su contraseña y de cualquier
                acción realizada dentro de su cuenta.
            </p>

            <h2 style="color: #333; margin-top: 20px;">5. Modificaciones</h2>
            <p style="color: #555;">
                Nos reservamos el derecho de modificar estos términos en cualquier momento, notificando
                los cambios por los canales habituales de comunicación.
            </p>

            <h2 style="color: #333; margin-top: 20px;">6. Contacto</h2>
            <p style="color: #555;">
                Para dudas sobre estos términos, puede contactarnos mediante la sección de soporte.
            </p>
        </div>

        <br>
        <a href="{{ route('login') }}" style="color: #ff7f50; font-weight:bold; text-decoration:none; display:inline-block; margin-top: 20px;">
            ← Volver al inicio de sesión
        </a>
    </div>
</x-guest-layout>
