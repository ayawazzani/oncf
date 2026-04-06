@extends('master_page')

@section('title', 'Recherche des voyages')

@section('content')
<style>
    .search-container {
        max-width: 900px;
        margin: 0 auto;
    }
    .page-title {
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 30px;
    }
    .search-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 35px;
        margin-bottom: 40px;
    }
    .form-label {
        font-weight: 600;
        color: #4a4a4a;
        font-size: 0.9rem;
    }
    .form-select, .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #e1e5eb;
        background-color: #fafbfc;
        font-size: 0.95rem;
    }
    .form-select:focus, .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        background-color: #fff;
    }
    .btn-search {
        background-color: #1a1a1a;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 24px;
        width: 100%;
        border: none;
        transition: all 0.3s;
        height: 50px;
    }
    .btn-search:hover {
        background-color: #333;
        transform: translateY(-2px);
    }
    
    .results-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .table-custom th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid #e9ecef;
    }
    .table-custom td {
        padding: 15px;
        vertical-align: middle;
        font-weight: 500;
        color: #2b2b2b;
        border-bottom: 1px solid #f0f2f5;
    }
    .voyage-time {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a1a;
    }
    .price-tag {
        font-size: 1.1rem;
        font-weight: 700;
        color: #198754;
    }
    .btn-add {
        background-color: #e0f8e9;
        color: #198754;
        font-weight: 600;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        transition: all 0.2s;
    }
    .btn-add:hover {
        background-color: #198754;
        color: white;
    }
    .qte-input {
        width: 60px;
        text-align: center;
        border-radius: 6px;
        border: 1px solid #e1e5eb;
    }
</style>

<div class="search-container mt-4 mb-5">
    <div class="text-center">
        <h2 class="page-title"><i class="fa-solid fa-magnifying-glass me-2 text-primary"></i> Rechercher un voyage</h2>
    </div>

    <div class="search-card">
        <form action="{{ route('voyage.search') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="ville_depart" class="form-label"><i class="fa-solid fa-location-dot me-1 text-danger"></i> Ville de départ</label>
                <select name="ville_depart" id="ville_depart" class="form-select" required>
                    <option value="">Où êtes-vous ?</option>
                    @foreach ($villesDepart as $ville)
                        <option value="{{ $ville }}" {{ (isset($vd) && $vd == $ville) ? 'selected' : '' }}>
                            {{ $ville }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <label for="ville_arrivee" class="form-label"><i class="fa-solid fa-location-dot me-1 text-success"></i> Ville d'arrivée</label>
                <select name="ville_arrivee" id="ville_arrivee" class="form-select" required>
                    <option value="">Où allez-vous ?</option>
                    @foreach ($villesArrivee as $ville)
                        <option value="{{ $ville }}" {{ (isset($va) && $va == $ville) ? 'selected' : '' }}>
                            {{ $ville }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn-search">Rechercher</button>
            </div>
        </form>
    </div>

    @if (isset($voyages))
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0">Résultats disponibles</h4>
            <span class="badge bg-light text-dark border">{{ $voyages->count() }} voyage(s) trouvé(s)</span>
        </div>

        @if ($voyages->count() > 0)
            <div class="results-card table-responsive">
                <table class="table table-custom table-borderless m-0">
                    <thead>
                        <tr>
                            <th>Horaires</th>
                            <th>Trajet</th>
                            <th>Prix</th>
                            <th>Réserver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voyages as $voyage)
                            <tr>
                                <td>
                                    <div class="voyage-time">{{ $voyage->heureDepart }}</div>
                                    <div class="small text-muted"><i class="fa-solid fa-arrow-down mx-1"></i></div>
                                    <div class="voyage-time">{{ $voyage->heureDarrivee }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $voyage->villeDepart }}</div>
                                    <div class="text-muted small">Vers</div>
                                    <div class="fw-bold">{{ $voyage->villeDarrivee }}</div>
                                    <div class="badge bg-light text-secondary mt-1"><i class="fa-solid fa-hashtag me-1"></i>{{ $voyage->code_voyage }}</div>
                                </td>
                                <td>
                                    <div class="price-tag">{{ $voyage->prixVoyage }} DH</div>
                                </td>
                                <td>
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center gap-2 m-0">
                                        @csrf
                                        <input type="hidden" name="id_voyage" value="{{ $voyage->id }}">
                                        <div class="d-flex align-items-center">
                                            <label class="small text-muted me-2 mb-0">Qté</label>
                                            <input type="number" name="qte" class="form-control qte-input p-1" min="1" value="1" required>
                                        </div>
                                        <button type="submit" class="btn-add"><i class="fa-solid fa-plus me-1"></i> Ajouter</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center p-4 rounded-3">
                <i class="fa-solid fa-triangle-exclamation fs-3 me-3 text-warning"></i>
                <div>
                    <h5 class="fw-bold m-0 text-dark">Aucun voyage disponible</h5>
                    <p class="m-0 text-muted">Nous n'avons trouvé aucun trajet correspondant à votre recherche. Veuillez modifier les gares de départ ou d'arrivée.</p>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection