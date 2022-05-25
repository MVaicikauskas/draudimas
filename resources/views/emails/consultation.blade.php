@component('mail::message')
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <h1> Registracija Konsultacijai sėkminga!</h1>
    <br>
    <p>Konsultacijos laikas:  {{ $details['consultation_date'] }}.</p>
    <br>
    <p>Iškilus neatidėliotiniems klausimams prašome susisiekti su administracija. </p>
    <br>
    <p>Gražios dienos ir iki susitikimo konsultacijos metu! </p>

</body>
</html>
@endcomponent
