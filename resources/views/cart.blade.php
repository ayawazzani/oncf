@extends('master_page')

@section('title', 'Mon Panier')

@section('content')
<style>
    .cart-page-wrap {
        background: #f5f7fb;
        margin: -1.5rem -0.75rem 0;
        padding: 40px 0 70px;
        min-height: 100vh;
    }

    .cart-container {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 14px;
    }

    .cart-hero {
        background: linear-gradient(135deg, #0f2ea6 0%, #1a47d7 55%, #0e36b8 100%);
        color: white;
        border-radius: 26px;
        padding: 34px;
        margin-bottom: 28px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
    }

    .cart-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .cart-hero p {
        margin: 0;
        color: rgba(255,255,255,0.92);
    }

    .cart-card {
        background: white;
        border: 1px solid #eceff5;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(15,23,42,0.05);
    }

    .cart-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .cart-table thead th {
        background: #f8faff;
        color: #344054;
        font-weight: 700;
        font-size: 0.92rem;
        padding: 16px 14px;
        border-bottom: 1px solid #e4e7ec;
    }

    .cart-table tbody td {
        padding: 16px 14px;
        border-color: #eef2f7;
    }

    .cart-voyage-code {
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

    .subtotal-badge {
        display: inline-block;
        background: #eefcf2;
        color: #16a34a;
        font-weight: 800;
        padding: 8px 12px;
        border-radius: 12px;
        min-width: 90px;
        text-align: center;
    }

    .qty-input {
        width: 90px;
        height: 46px;
        border-radius: 12px;
        border: 1px solid #d0d5dd;
        box-shadow: none;
    }

    .btn-update {
        border: none;
        background: #f59e0b;
        color: white;
        padding: 10px 14px;
        border-radius: 12px;
        font-weight: 700;
    }

    .btn-remove {
        border: none;
        background: #dc2626;
        color: white;
        padding: 10px 14px;
        border-radius: 12px;
        font-weight: 700;
    }

    .cart-total-box {
        margin-top: 24px;
        background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #eaecf0;
        border-radius: 20px;
        padding: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .cart-total-box h3 {
        margin: 0;
        font-size: 1.45rem;
        font-weight: 800;
        color: #101828;
    }

    .cart-total-amount {
        font-size: 1.6rem;
        font-weight: 900;
        color: #1d4ed8;
    }

    .cart-actions {
        margin-top: 22px;
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn-premium-primary {
        background: linear-gradient(135deg, #ff1f1f 0%, #df0000 100%);
        color: #fff;
        padding: 14px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        border: none;
        box-shadow: 0 14px 28px rgba(223,0,0,0.18);
    }

    .btn-premium-dark {
        background: #101828;
        color: #fff;
        padding: 14px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        border: none;
    }

    .empty-cart {
        text-align: center;
        padding: 50px 20px;
        border: 1px dashed #d0d5dd;
        border-radius: 20px;
        background: #fafbfd;
    }

    .empty-cart i {
        font-size: 42px;
        color: #98a2b3;
        margin-bottom: 14px;
    }

    .empty-cart h4 {
        font-weight: 800;
        color: #101828;
    }

    .empty-cart p {
        color: #667085;
        margin-bottom: 22px;
    }

    @media (max-width: 768px) {
        .cart-page-wrap {
            padding-top: 22px;
        }

        .cart-hero,
        .cart-card {
            border-radius: 18px;
            padding: 20px;
        }
    }
</style>

<div class="cart-page-wrap">
    <div class="cart-container">
        <div class="cart-hero">
            <h1>Mon Panier</h1>
            <p>Vérifiez vos voyages, modifiez les quantités et passez au paiement en toute simplicité.</p>
        </div>

        <div class="cart-card">
            @if(count($cart) > 0)
                <div class="table-responsive">
                    <table class="table cart-table align-middle">
                        <thead>
                            <tr>
                                <th>Code Voyage</th>
                                <th>Ville Départ</th>
                                <th>Ville Arrivée</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Sous-total</th>
                                <th>Action</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp

                            @foreach($cart as $id => $item)
                                @php $sousTotal = $item['prix'] * $item['qte']; @endphp
                                @php $total += $sousTotal; @endphp

                                <tr>
                                    <td class="cart-voyage-code">{{ $item['code_voyage'] }}</td>
                                    <td>{{ $item['villeDepart'] }}</td>
                                    <td>{{ $item['villeDarrivee'] }}</td>
                                    <td>
                                        <span class="price-badge">{{ $item['prix'] }} DH</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex gap-2 align-items-center">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id_voyage" value="{{ $id }}">
                                            <input type="number" name="qte" value="{{ $item['qte'] }}" min="1" class="form-control qty-input">
                                    </td>
                                    <td>
                                        <span class="subtotal-badge">{{ $sousTotal }} DH</span>
                                    </td>
                                    <td>
                                            <button type="submit" class="btn-update">Modifier</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_voyage" value="{{ $id }}">
                                            <button type="submit" class="btn-remove">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-total-box">
                    <h3>Total général</h3>
                    <div class="cart-total-amount">{{ $total }} DH</div>
                </div>

                <div class="cart-actions">
                    <a href="{{ route('voyage.form') }}" class="btn-premium-dark">Continuer la recherche</a>
                    <a href="{{ route('voyageurs.form') }}" class="btn-premium-primary">Passer au paiement</a>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <h4>Votre panier est vide</h4>
                    <p>Ajoutez d’abord un voyage depuis la page de recherche pour continuer.</p>
                    <a href="{{ route('voyage.form') }}" class="btn-premium-dark">Rechercher un voyage</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection