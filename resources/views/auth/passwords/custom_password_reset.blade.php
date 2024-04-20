
@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-top: 20px;">
    <p>Estás recibiendo este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.</p>
    <a href="{{ $url }}" class="btn btn-primary" style="display: inline-block; margin: 15px auto; text-decoration: none; padding: 5px 15px; background-color: #000000; color: white; border-radius: 5px;">Restablecer Contraseña</a>
    <p style="margin-top: 20px;">Este enlace para restablecer la contraseña expirará en 5 minutos.</p>
    <p>Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna acción adicional.</p>
    <p style="margin-top: 20px;">Saludos, ByteGamers</p>
</div>
@endsection
