<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- // Fa funzionare il scss // --}}
@vite(['resources/js/app.js'])


<div class=" position-absolute top-50 start-50 translate-middle">
    <div class="d-flex">
        <div class="me-4 mt-2">
            <i class="fa-regular fa-hospital fs-1 brand-text-color-1"></i>
        </div>
        <div>
            <h2 class="brand-text-color-1">404 - PAGE NOT FOUND <i class="fa-solid fa-pills fs-3 brand-text-color-1"></i></h2>
            <p class="brand-text-color-1">La pagina a cui cerchi di accedere è stata eliminata, ha un nome diverso o non è al momento disponibile</p>
            <a class="btn btn-bd-primary mb-4" href="{{ route('admin.dashboard') }}">torna alla HomePage</a>
        </div>
    </div>
</div>
