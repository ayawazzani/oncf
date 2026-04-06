@extends('master_page')

@section('title', 'Billets')

@section('content')
<style>
    .ticket-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        max-width: 850px;
        width: 100%;
        display: flex;
        position: relative;
        overflow: hidden;
        margin: 0 auto 30px auto;
    }

    /* Perforated edge effect between sections */
    .ticket-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 65%;
        border-left: 2px dashed #e1e5eb;
        z-index: 1;
    }
    .circle-top, .circle-bottom {
        position: absolute;
        left: 65%;
        width: 40px;
        height: 40px;
        background-color: #f7f9fc;
        border-radius: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }
    .circle-top { top: -20px; }
    .circle-bottom { bottom: -20px; }

    .ticket-main {
        flex: 0 0 65%;
        padding: 40px;
    }
    .ticket-side {
        flex: 0 0 35%;
        background: #fafbfc;
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .brand-logo {
        font-size: 2rem;
        font-weight: 700;
        color: #d11242; /* Red accent for logo */
        letter-spacing: -1px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
    }

    .section-label {
        font-size: 0.75rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .journey-block {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 24px;
        margin-top: 15px;
        border: 1px solid #edf1f5;
    }

    .cities {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .city {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
    }

    .line {
        flex-grow: 1;
        height: 2px;
        background: #e1e5eb;
        margin: 0 15px;
        position: relative;
    }

    .line::after {
        content: '\f0da';
        font-family: 'FontAwesome';
        position: absolute;
        right: -2px;
        top: -10px;
        color: #d11242;
        font-size: 1.2rem;
    }

    .qr-placeholder {
        width: 140px;
        height: 140px;
        background: #fff;
        border: 1px solid #e1e5eb;
        border-radius: 8px;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(5, 1fr);
        gap: 2px;
        padding: 6px;
        margin-top: 15px;
    }
    .qr-block { background: #1a1a1a; border-radius: 1px;}
    .qr-empty { background: transparent; }

    .btn-print {
        background: #1a1a1a;
        color: white;
        padding: 14px 35px;
        border-radius: 30px;
        font-weight: 500;
        border: none;
        margin-top: 20px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .btn-print:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .btn-return {
        background: #6c757d;
        color: white;
        padding: 14px 35px;
        border-radius: 30px;
        font-weight: 500;
        border: none;
        margin-top: 20px;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-return:hover {
        background: #5c636a;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .ticket-wrapper {
            flex-direction: column;
        }
        .ticket-wrapper::after { display: none; }
        .circle-top, .circle-bottom { display: none; }
        .ticket-main, .ticket-side {
            flex: none;
            width: 100%;
        }
    }

    @media print {
        body {
            background: white !important;
            padding: 0;
        }
        .ticket-wrapper {
            box-shadow: none !important;
            border: 1px solid #dee2e6;
            break-inside: avoid;
        }
        .circle-top, .circle-bottom {
            background-color: white !important;
            border: 1px solid #dee2e6;
        }
        .circle-top { border-top: none; }
        .circle-bottom { border-bottom: none; }
        .navbar, .alert, .actions-container {
            display: none !important;
        }
    }
</style>

<div>
    @php $indexVoyageur = 0; @endphp

    @foreach($cart as $id => $item)
        @for($j = 0; $j < $item['qte']; $j++)
            @if(isset($voyageurs[$indexVoyageur]))
                <div class="ticket-wrapper mt-4">
                    <div class="circle-top"></div>
                    <div class="circle-bottom"></div>
                    
                    <!-- Informations Info (Left) -->
                    <div class="ticket-main">
                        <h5 class="fw-bold mb-4 border-bottom pb-2">Informations du voyageur</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="section-label">Nom Complet</div>
                                <div class="info-value">{{ $voyageurs[$indexVoyageur]['nom'] }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="section-label">Passeport / CIN</div>
                                <div class="info-value">{{ $voyageurs[$indexVoyageur]['passport'] }}</div>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 mt-3 border-bottom pb-2">Informations du voyage</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="section-label">Code Voyage</div>
                                <div class="info-value text-primary fs-4">{{ $item['code_voyage'] }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="section-label">Prix Total</div>
                                <div class="info-value fs-4 text-success">{{ $item['prix'] }}</div>
                            </div>
                        </div>

                        <div class="journey-block">
                            <div class="section-label mb-2">Trajet</div>
                            <div class="cities">
                                <div class="city">{{ $item['villeDepart'] }}</div>
                                <div class="line"></div>
                                <div class="city">{{ $item['villeDarrivee'] }}</div>
                            </div>
                            <div class="row mt-3 text-center">
                                <div class="col-12">
                                    <div class="section-label">Date du voyage</div>
                                    <div class="fw-semibold fs-5">{{ now()->toDateString() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logo & QR (Right) -->
                    <div class="ticket-side">
                        <div class="brand-logo">
                            <i class="fa-solid fa-train-subway"></i> AL BORAQ
                        </div>
                        
                        <div class="section-label mt-3">Billet Électronique</div>
                        <div class="text-muted small mb-2">Scannez ce code au contrôle</div>

                        <!-- Stylized Fake QR Code using CSS Grid -->
                        <div class="qr-placeholder">
                            <div class="qr-block"></div><div class="qr-block"></div><div class="qr-empty"></div><div class="qr-block"></div><div class="qr-block"></div>
                            <div class="qr-block"></div><div class="qr-empty"></div><div class="qr-block"></div><div class="qr-empty"></div><div class="qr-block"></div>
                            <div class="qr-empty"></div><div class="qr-block"></div><div class="qr-block"></div><div class="qr-block"></div><div class="qr-empty"></div>
                            <div class="qr-block"></div><div class="qr-block"></div><div class="qr-empty"></div><div class="qr-empty"></div><div class="qr-block"></div>
                            <div class="qr-block"></div><div class="qr-empty"></div><div class="qr-block"></div><div class="qr-block"></div><div class="qr-block"></div>
                        </div>
                    </div>
                </div>
            @endif

            @php $indexVoyageur++; @endphp
        @endfor
    @endforeach

    <div class="actions-container text-center mt-4 mb-5">
        <button onclick="window.print()" class="btn-print me-3">
            <i class="fa-solid fa-print me-2"></i> Imprimer le billet
        </button>
        <a href="{{ route('voyage.form') }}" class="btn-return">
            <i class="fa-solid fa-arrow-left me-2"></i> Retour
        </a>
    </div>
</div>
@endsection