@extends('master_page')

@section('title', 'Recherche des voyages')

@section('content')
<style>
    .search-page-wrap {
        background: #f5f7fb;
        margin: -1.5rem -0.75rem 0;
        padding: 40px 0 70px;
        min-height: 100vh;
    }

    .search-hero-mini {
        max-width: 1180px;
        margin: 0 auto 28px;
        padding: 0 14px;
    }

    .search-hero-card {
        background: linear-gradient(135deg, #0f2ea6 0%, #1a47d7 55%, #0e36b8 100%);
        border-radius: 26px;
        padding: 38px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
    }

    .search-hero-card::before {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        top: -80px;
        right: -60px;
    }

    .search-hero-card h1 {
        font-size: 2.4rem;
        font-weight: 800;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .search-hero-card p {
        margin: 0;
        color: rgba(255,255,255,0.92);
        font-size: 1.05rem;
        position: relative;
        z-index: 2;
    }

    .search-main-box {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 14px;
    }

    .search-form-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.05);
        margin-bottom: 28px;
    }

    .search-form-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 6px;
    }

    .search-form-subtitle {
        color: #667085;
        margin-bottom: 22px;
    }

    .search-label {
        font-size: 0.95rem;
        font-weight: 700;
        color: #344054;
        margin-bottom: 9px;
    }

    .search-form-card .form-select {
        height: 56px;
        border-radius: 16px;
        border: 1px solid #d0d5dd;
        box-shadow: none;
    }

    .search-form-card .form-select:focus,
    .search-form-card .form-control:focus {
        border-color: #1d4ed8;
        box-shadow: 0 0 0 4px rgba(29,78,216,0.10);
    }

    .search-submit-btn {
        height: 56px;
        width: 100%;
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, #ff1f1f 0%, #df0000 100%);
        color: white;
        font-weight: 700;
        box-shadow: 0 14px 28px rgba(223,0,0,0.18);
        transition: 0.3s ease;
    }

    .search-submit-btn:hover {
        transform: translateY(-1px);
    }

    .results-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.05);
    }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .results-header h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #101828;
        margin: 0;
    }

    .results-count {
        background: #eef4ff;
        color: #1849a9;
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 700;
    }

    .table-premium {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-premium thead th {
        background: #f8faff;
        color: #344054;
        border-bottom: 1px solid #e4e7ec;
        font-size: 0.92rem;
        font-weight: 700;
        padding: 16px 14px;
    }

    .table-premium tbody td {
        padding: 16px 14px;
        border-color: #eef2f7;
    }

    .voyage-code {
        font-weight: 800;
        color: #101828;
    }

    .price-badge {
        display: inline-block;
        background: #e8f0ff;
        color: #1d4ed8;
        font-weight: 800;
        padding: 8px 12px;
        border-radius: 12px;
        min-width: 90px;
        text-align: center;
    }

    .qty-input {
        min-width: 90px;
        height: 46px;
        border-radius: 12px;
        border: 1px solid #d0d5dd;
        box-shadow: none;
    }

    .btn-add-cart {
        border: none;
        background: #101828;
        color: #fff;
        padding: 11px 16px;
        border-radius: 12px;
        font-weight: 700;
        transition: 0.3s ease;
    }

    .btn-add-cart:hover {
        background: #0b1220;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        border: 1px dashed #d0d5dd;
        border-radius: 18px;
        background: #fafbfd;
    }

    .empty-state i {
        font-size: 42px;
        color: #98a2b3;
        margin-bottom: 12px;
    }

    .empty-state h4 {
        font-weight: 800;
        color: #101828;
        margin-bottom: 8px;
    }

    .empty-state p {
        margin-bottom: 0;
        color: #667085;
    }

    @media (max-width: 768px) {
        .search-page-wrap {
            padding-top: 22px;
        }

        .search-hero-card {
            padding: 24px;
        }

        .search-hero-card h1 {
            font-size: 1.9rem;
        }

        .search-form-card,
        .results-card {
            padding: 20px;
            border-radius: 18px;
        }
    }
</style>

<div class="search-page-wrap">
    <div class="search-hero-mini">
        <div class="search-hero-card">
            <h1>Rechercher votre trajet</h1>
            <p>
                Choisissez votre ville de départ et d’arrivée pour afficher les voyages disponibles.
            </p>
        </div>
    </div>

    <div class="search-main-box">
        <div class="search-form-card">
            <div class="search-form-title">Recherche des voyages</div>
            <div class="search-form-subtitle">
                Trouvez rapidement le bon billet et ajoutez-le directement à votre panier.
            </div>

            <form action="{{ route('voyage.search') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label class="search-label">Ville de départ</label>
                    <select name="ville_depart" class="form-select" required>
                        <option value="">Choisir une ville</option>
                        @foreach ($villesDepart as $ville)
                            <option value="{{ $ville }}" {{ (isset($vd) && $vd == $ville) ? 'selected' : '' }}>
                                {{ $ville }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="search-label">Ville d’arrivée</label>
                    <select name="ville_arrivee" class="form-select" required>
                        <option value="">Choisir une ville</option>
                        @foreach ($villesArrivee as $ville)
                            <option value="{{ $ville }}" {{ (isset($va) && $va == $ville) ? 'selected' : '' }}>
                                {{ $ville }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="search-submit-btn">Rechercher</button>
                </div>
            </form>
        </div>

        @if (isset($voyages))
            <div class="results-card">
                <div class="results-header">
                    <h2>Résultats de recherche</h2>
                    <div class="results-count">
                        {{ $voyages->count() }} voyage(s) trouvé(s)
                    </div>
                </div>

                @if ($voyages->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-premium align-middle">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Heure départ</th>
                                    <th>Ville départ</th>
                                    <th>Heure arrivée</th>
                                    <th>Ville arrivée</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voyages as $voyage)
                                    <tr>
                                        <td class="voyage-code">{{ $voyage->code_voyage }}</td>
                                        <td>{{ $voyage->heureDepart }}</td>
                                        <td>{{ $voyage->villeDepart }}</td>
                                        <td>{{ $voyage->heureDarrivee }}</td>
                                        <td>{{ $voyage->villeDarrivee }}</td>
                                        <td>
                                            <span class="price-badge">{{ $voyage->prixVoyage }} DH</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 align-items-center">
                                                @csrf
                                                <input type="hidden" name="id_voyage" value="{{ $voyage->id }}">
                                                <input type="number" name="qte" class="form-control qty-input" min="1" value="1" required>
                                        </td>
                                        <td>
                                                <button type="submit" class="btn-add-cart">Ajouter</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-train-subway"></i>
                        <h4>Aucun voyage trouvé</h4>
                        <p>Aucun voyage trouvé pour ce trajet. Essayez une autre combinaison de villes.</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection