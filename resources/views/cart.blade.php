@extends('master_page')

@section('title', 'Panier')

@section('content')
<style>
    .cart-container {
        max-width: 900px;
        margin: 0 auto;
    }
    .page-title {
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 30px;
    }
    .cart-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        padding: 30px;
        margin-bottom: 25px;
    }
    .table-custom th {
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 15px;
    }
    .table-custom td {
        vertical-align: middle;
        padding: 15px 5px;
        color: #2b2b2b;
        font-weight: 500;
        border-bottom: 1px solid #f0f2f5;
    }
    .table-custom tr:last-child td {
        border-bottom: none;
    }
    .btn-action {
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 8px 16px;
    }
    .total-row strong {
        font-size: 1.25rem;
        color: #1a1a1a;
    }
    .btn-primary-custom {
        background-color: #0d6efd;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 24px;
        border: none;
        transition: all 0.3s;
    }
    .btn-primary-custom:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        color: white;
    }
    .btn-outline-custom {
        border: 2px solid #e1e5eb;
        color: #4a4a4a;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 24px;
        transition: all 0.3s;
    }
    .btn-outline-custom:hover {
        background-color: #f7f9fc;
        color: #1a1a1a;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }
    .qte-input {
        width: 70px;
        text-align: center;
        border-radius: 6px;
        border: 1px solid #e1e5eb;
        padding: 5px;
    }
</style>

<div class="cart-container mt-4 mb-5">
    <h2 class="page-title text-center"><i class="fa-solid fa-cart-shopping me-2 text-primary"></i> Mon Panier</h2>

    @if(count($cart) > 0)
        <div class="cart-card">
            <div class="table-responsive">
                <table class="table table-custom table-borderless">
                    <thead>
                        <tr>
                            <th>Trajet</th>
                            <th>Code</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp

                        @foreach($cart as $id => $item)
                            @php $sousTotal = $item['prix'] * $item['qte']; @endphp
                            @php $total += $sousTotal; @endphp

                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $item['villeDepart'] }} <i class="fa-solid fa-arrow-right mx-1 text-muted"></i> {{ $item['villeDarrivee'] }}</div>
                                </td>
                                <td class="text-muted">{{ $item['code_voyage'] }}</td>
                                <td>{{ $item['prix'] }} DH</td>
                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2 m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id_voyage" value="{{ $id }}">
                                        <input type="number" name="qte" value="{{ $item['qte'] }}" min="1" class="qte-input">
                                        <button type="submit" class="btn btn-warning btn-action btn-sm"><i class="fa-solid fa-rotate"></i></button>
                                    </form>
                                </td>
                                <td class="fw-bold text-success">{{ $sousTotal }} DH</td>
                                <td class="text-end">
                                    <form action="{{ route('cart.remove') }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id_voyage" value="{{ $id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-action"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="4" class="text-end text-muted pt-4">Total à payer :</td>
                            <td colspan="2" class="pt-4 text-primary"><strong>{{ $total }} DH</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('voyage.form') }}" class="btn btn-outline-custom text-decoration-none">
                <i class="fa-solid fa-arrow-left me-2"></i> Continuer la recherche
            </a>
            <a href="{{ route('voyageurs.form') }}" class="btn btn-primary-custom text-decoration-none">
                Passer au paiement <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
    @else
        <div class="empty-state">
            <i class="fa-solid fa-basket-shopping"></i>
            <h4 class="fw-bold text-dark">Votre panier est vide</h4>
            <p class="text-muted mb-4">Vous n'avez sélectionné aucun voyage pour le moment.</p>
            <a href="{{ route('voyage.form') }}" class="btn btn-primary-custom text-decoration-none">
                Rechercher un voyage
            </a>
        </div>
    @endif
</div>
@endsection