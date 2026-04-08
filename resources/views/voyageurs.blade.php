@extends('master_page')

@section('title', 'Paiement')

@section('content')
<style>
    .payment-page-wrap {
        background: #f5f7fb;
        margin: -1.5rem -0.75rem 0;
        padding: 40px 0 70px;
        min-height: 100vh;
    }

    .payment-container {
        max-width: 980px;
        margin: 0 auto;
        padding: 0 14px;
    }

    .payment-hero {
        background: linear-gradient(135deg, #0f2ea6 0%, #1a47d7 55%, #0e36b8 100%);
        color: #fff;
        border-radius: 26px;
        padding: 34px;
        margin-bottom: 28px;
        box-shadow: 0 18px 40px rgba(15,23,42,0.12);
    }

    .payment-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .payment-hero p {
        margin: 0;
        color: rgba(255,255,255,0.92);
    }

    .payment-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 14px 34px rgba(15,23,42,0.05);
    }

    .section-small-title {
        color: #667085;
        font-size: 0.95rem;
        margin-bottom: 5px;
    }

    .code-voyage-title {
        font-size: 2rem;
        font-weight: 900;
        color: #101828;
        margin-bottom: 24px;
    }

    .voyageur-block {
        border: 1px solid #eef2f7;
        border-radius: 20px;
        padding: 22px;
        margin-bottom: 18px;
        background: #fbfcfe;
    }

    .voyageur-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 14px;
    }

    .payment-label {
        font-size: 0.95rem;
        font-weight: 700;
        color: #344054;
        margin-bottom: 9px;
    }

    .payment-card .form-control {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #d0d5dd;
        box-shadow: none;
    }

    .payment-card .form-control:focus {
        border-color: #1d4ed8;
        box-shadow: 0 0 0 4px rgba(29,78,216,0.10);
    }

    .payment-method-box {
        margin-top: 24px;
        margin-bottom: 22px;
        padding: 20px;
        background: linear-gradient(135deg, #f8faff 0%, #ffffff 100%);
        border: 1px solid #e9eef7;
        border-radius: 18px;
    }

    .payment-method-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 10px;
    }

    .payment-logo {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 14px;
    }

    .pay-badge {
        padding: 8px 14px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.9rem;
    }

    .visa {
        background: #e8f0ff;
        color: #1d4ed8;
    }

    .mastercard {
        background: #fff1e8;
        color: #ea580c;
    }

    .btn-validate-premium {
        border: none;
        background: linear-gradient(135deg, #ff1f1f 0%, #df0000 100%);
        color: white;
        padding: 14px 24px;
        border-radius: 14px;
        font-weight: 800;
        box-shadow: 0 14px 28px rgba(223,0,0,0.18);
    }

    @media (max-width: 768px) {
        .payment-page-wrap {
            padding-top: 22px;
        }

        .payment-hero,
        .payment-card {
            border-radius: 18px;
            padding: 20px;
        }

        .code-voyage-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="payment-page-wrap">
    <div class="payment-container">
        <div class="payment-hero">
            <h1>Paiement & Informations voyageurs</h1>
            <p>Complétez les informations des passagers puis validez votre réservation.</p>
        </div>

        <div class="payment-card">
            <div class="section-small-title">Saisie des informations des voyageurs</div>
            <div class="code-voyage-title">
                Code Voyage : {{ $premierVoyage['code_voyage'] ?? '---' }}
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

                @for($i = 0; $i < $totalBillets; $i++)
                    <div class="voyageur-block">
                        <div class="voyageur-title">Voyageur {{ $i + 1 }}</div>

                        <div class="mb-3">
                            <label class="payment-label">Nom</label>
                            <input
                                type="text"
                                name="voyageurs[{{ $i }}][nom]"
                                class="form-control"
                                value="{{ old("voyageurs.$i.nom") }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="payment-label">Prénom</label>
                            <input
                                type="text"
                                name="voyageurs[{{ $i }}][prenom]"
                                class="form-control"
                                value="{{ old("voyageurs.$i.prenom") }}"
                                required
                            >
                        </div>

                        <div class="mb-0">
                            <label class="payment-label">Numéro de passeport</label>
                            <input
                                type="text"
                                name="voyageurs[{{ $i }}][passport]"
                                class="form-control"
                                value="{{ old("voyageurs.$i.passport") }}"
                                required
                            >
                        </div>
                    </div>
                @endfor

                <div class="payment-method-box">
                    <div class="payment-method-title">Paiement par carte</div>

                    <div class="payment-logo">
                        <span class="pay-badge visa">VISA</span>
                        <span class="pay-badge mastercard">MasterCard</span>
                    </div>

                    <div class="mb-3">
                        <label class="payment-label">Numéro de carte</label>
                        <input type="text" name="numero_carte" class="form-control" value="{{ old('numero_carte') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="payment-label">Date d'expiration</label>
                            <input type="text" name="date_expiration" class="form-control" placeholder="MM/AA" value="{{ old('date_expiration') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="payment-label">CVV</label>
                            <input type="text" name="cvv" class="form-control" value="{{ old('cvv') }}" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-validate-premium">
                    Valider et Générer les billets
                </button>
            </form>
        </div>
    </div>
</div>
@endsection