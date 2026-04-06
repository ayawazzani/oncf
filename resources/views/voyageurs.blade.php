@extends('master_page')

@section('title', 'Paiement')

@section('content')
<style>
    .payment-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 40px;
        max-width: 700px;
        width: 100%;
        margin: 0 auto;
    }
    .subtitle {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        font-weight: 500;
    }
    .title {
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 30px;
    }
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2b2b2b;
        margin-bottom: 20px;
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
    }
    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #e1e5eb;
        font-size: 0.95rem;
        background-color: #fafbfc;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        background-color: #fff;
    }
    .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #4a4a4a;
    }
    .btn-pay {
        background-color: #0d6efd;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        padding: 14px;
        width: 100%;
        border: none;
        transition: all 0.3s ease;
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .btn-pay:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
    .card-icons i {
        font-size: 28px;
        margin-left: 10px;
    }
    .visa-icon { color: #1a1f71; }
    .mastercard-icon { color: #eb001b; }
</style>

<div class="payment-card mb-5 mt-3">
    <div class="text-center">
        <div class="subtitle">Saisie des informations des voyageurs</div>
        <h2 class="title">Code Voyage : {{ $premierVoyage['code_voyage'] ?? '---' }}</h2>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('voyageurs.store') }}" method="POST">
        @csrf

        <!-- Voyageur Section -->
        <div class="mb-4 mt-4">
            @for($i = 0; $i < $totalBillets; $i++)
                <h5 class="section-title mt-4">
                    <i class="fa-solid fa-user me-2 text-primary"></i> Voyageur {{ $i + 1 }}
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="voyageurs[{{ $i }}][nom]" class="form-control" value="{{ old("voyageurs.$i.nom") }}" placeholder="Ex: FullStack2034" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Numéro de passeport / CIN</label>
                        <input type="text" name="voyageurs[{{ $i }}][passport]" class="form-control" value="{{ old("voyageurs.$i.passport") }}" placeholder="Ex: KF123" required>
                    </div>
                </div>
            @endfor
        </div>

        <!-- Paiement Section -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h5 class="section-title border-0 mb-0">
                    <i class="fa-solid fa-credit-card me-2 text-primary"></i> Paiement par carte
                </h5>
                <div class="card-icons">
                    <i class="fa-brands fa-cc-visa visa-icon"></i>
                    <i class="fa-brands fa-cc-mastercard mastercard-icon"></i>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Numéro de carte</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-regular fa-credit-card text-secondary"></i></span>
                        <input type="text" name="numero_carte" class="form-control border-start-0 ps-0" placeholder="0000 0000 0000 0000" value="{{ old('numero_carte') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date d'expiration</label>
                    <input type="text" name="date_expiration" class="form-control" placeholder="MM/AA" value="{{ old('date_expiration') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CVV</label>
                    <input type="text" name="cvv" class="form-control" placeholder="123" value="{{ old('cvv') }}" required>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-pay">
            Valider et Générer les billets <i class="fa-solid fa-arrow-right"></i>
        </button>
    </form>
</div>
@endsection