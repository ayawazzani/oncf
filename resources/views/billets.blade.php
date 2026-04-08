@extends('master_page')

@section('title', 'Billets')

@section('content')
<style>
    .ticket-page-wrap {
        background: #f5f7fb;
        margin: -1.5rem -0.75rem 0;
        padding: 40px 0 70px;
        min-height: 100vh;
    }

    .ticket-container {
        max-width: 980px;
        margin: 0 auto;
        padding: 0 14px;
    }

    .ticket-header-box {
        background: linear-gradient(135deg, #0f2ea6 0%, #1a47d7 55%, #0e36b8 100%);
        color: #fff;
        border-radius: 26px;
        padding: 34px;
        margin-bottom: 28px;
        box-shadow: 0 18px 40px rgba(15,23,42,0.12);
    }

    .ticket-header-box h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .ticket-header-box p {
        margin: 0;
        color: rgba(255,255,255,0.92);
    }

    .ticket-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 24px;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 14px 34px rgba(15,23,42,0.05);
    }

    .ticket-grid {
        display: grid;
        grid-template-columns: 1.25fr 0.75fr;
        gap: 24px;
        align-items: start;
    }

    .ticket-label-title {
        font-size: 1rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 10px;
    }

    .ticket-info p {
        margin-bottom: 10px;
        color: #344054;
        font-size: 1rem;
    }

    .ticket-code {
        display: inline-block;
        background: #eef4ff;
        color: #1849a9;
        font-weight: 800;
        padding: 8px 12px;
        border-radius: 12px;
        margin-bottom: 14px;
    }

    .ticket-logo-box {
        background: linear-gradient(135deg, #f8faff 0%, #ffffff 100%);
        border: 1px solid #eaecf0;
        border-radius: 20px;
        padding: 22px;
        text-align: center;
    }

    .logo-shape-red {
        width: 170px;
        height: 24px;
        margin: 0 auto 8px;
        background: #df002f;
        border-radius: 50px 12px 50px 12px;
        transform: skewX(-20deg);
    }

    .logo-shape-green {
        width: 170px;
        height: 24px;
        margin: 0 auto 10px;
        background: #16a34a;
        border-radius: 12px 50px 12px 50px;
        transform: skewX(-20deg);
    }

    .brand-name {
        font-size: 2rem;
        font-weight: 900;
        font-style: italic;
        color: #101828;
        margin-bottom: 18px;
    }

    .qr-box {
        width: 110px;
        height: 110px;
        border: 6px solid #000;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 2px;
        padding: 4px;
        margin: 0 auto;
    }

    .qr-box span {
        background: #000;
        display: block;
    }

    .ticket-actions {
        margin-top: 26px;
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-print-premium {
        border: none;
        background: linear-gradient(135deg, #ff1f1f 0%, #df0000 100%);
        color: white;
        padding: 14px 24px;
        border-radius: 14px;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 14px 28px rgba(223,0,0,0.18);
    }

    .btn-back-premium {
        border: none;
        background: #101828;
        color: white;
        padding: 14px 24px;
        border-radius: 14px;
        font-weight: 800;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .ticket-grid {
            grid-template-columns: 1fr;
        }

        .ticket-page-wrap {
            padding-top: 22px;
        }

        .ticket-header-box,
        .ticket-card {
            border-radius: 18px;
            padding: 20px;
        }
    }

    @media print {
        nav, .ticket-actions {
            display: none !important;
        }

        .ticket-page-wrap {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .ticket-header-box {
            display: none !important;
        }

        .ticket-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            break-inside: avoid;
        }
    }
</style>

<div class="ticket-page-wrap">
    <div class="ticket-container">
        <div class="ticket-header-box">
            <h1>Billets de réservation</h1>
            <p>Commande #{{ $commandeId }} — Vos billets sont prêts à être imprimés.</p>
        </div>

        @php $indexVoyageur = 0; @endphp

        @foreach($cart as $id => $item)
            @for($j = 0; $j < $item['qte']; $j++)
                @if(isset($voyageurs[$indexVoyageur]))
                    <div class="ticket-card">
                        <div class="ticket-grid">
                            <div class="ticket-info">
                                <div class="ticket-code">{{ $item['code_voyage'] }}</div>

                                <div class="ticket-label-title">Informations du voyageur :</div>
                                <p><strong>Nom :</strong> {{ $voyageurs[$indexVoyageur]['nom'] }}</p>
                                <p><strong>Prénom :</strong> {{ $voyageurs[$indexVoyageur]['prenom'] }}</p>
                                <p><strong>Passport :</strong> {{ $voyageurs[$indexVoyageur]['passport'] }}</p>

                                <div class="ticket-label-title mt-4">Informations du voyage :</div>
                                <p><strong>Code de Voyage :</strong> {{ $item['code_voyage'] }}</p>
                                <p><strong>Prix :</strong> {{ $item['prix'] }} DH</p>
                                <p><strong>Départ :</strong> {{ $item['villeDepart'] }}</p>
                                <p><strong>Arrivée :</strong> {{ $item['villeDarrivee'] }}</p>
                                <p><strong>Date :</strong> {{ now()->toDateString() }}</p>
                            </div>

                            <div class="ticket-logo-box">
                                <div class="logo-shape-red"></div>
                                <div class="logo-shape-green"></div>
                                <div class="brand-name">Al Boraq</div>

                                <div class="qr-box">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span style="background:#fff"></span><span></span><span style="background:#fff"></span><span></span>
                                    <span></span><span></span><span style="background:#fff"></span><span></span><span></span>
                                    <span></span><span style="background:#fff"></span><span></span><span style="background:#fff"></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @php $indexVoyageur++; @endphp
            @endfor
        @endforeach

        <div class="ticket-actions">
            <button onclick="window.print()" class="btn-print-premium">Imprimer</button>
            <a href="{{ route('voyage.form') }}" class="btn-back-premium">Retour</a>
        </div>
    </div>
</div>
@endsection