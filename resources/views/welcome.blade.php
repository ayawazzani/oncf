@extends('master_page')

@section('title', 'Accueil - ONCF')

@section('content')
<style>
    .premium-home {
        background: #f5f7fb;
        margin: -1.5rem -0.75rem 0;
        padding-bottom: 70px;
    }

    .premium-hero {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 20% 20%, rgba(255,255,255,0.10), transparent 20%),
            radial-gradient(circle at 80% 10%, rgba(255,255,255,0.08), transparent 18%),
            linear-gradient(135deg, #0f2ea6 0%, #1a47d7 55%, #0e36b8 100%);
        color: #fff;
        padding: 90px 20px 150px;
    }

    .premium-hero::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        top: -180px;
        right: -120px;
        filter: blur(8px);
    }

    .premium-hero::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255,43,43,0.14);
        bottom: -120px;
        left: -80px;
        filter: blur(10px);
    }

    .hero-inner {
        max-width: 980px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .hero-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.15);
        color: #f6f7ff;
        padding: 10px 20px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 26px;
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .hero-title {
        font-size: 4.2rem;
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -2px;
        margin-bottom: 22px;
    }

    .hero-title .accent {
        color: #ff3636;
    }

    .hero-subtitle {
        max-width: 760px;
        margin: 0 auto 34px;
        font-size: 1.24rem;
        line-height: 1.8;
        color: rgba(255,255,255,0.92);
    }

    .hero-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 26px;
    }

    .btn-premium-main {
        background: linear-gradient(135deg, #ff1f1f 0%, #df0000 100%);
        color: #fff;
        padding: 15px 28px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        border: none;
        box-shadow: 0 16px 30px rgba(223, 0, 0, 0.28);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-premium-main:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 18px 34px rgba(223, 0, 0, 0.34);
    }

    .btn-premium-soft {
        background: rgba(255,255,255,0.10);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.14);
        padding: 15px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-premium-soft:hover {
        color: #fff;
        background: rgba(255,255,255,0.15);
    }

    .hero-mini-stats {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 6px;
    }

    .mini-stat {
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 16px;
        padding: 14px 18px;
        min-width: 170px;
        text-align: left;
    }

    .mini-stat strong {
        display: block;
        font-size: 1.1rem;
        margin-bottom: 3px;
    }

    .mini-stat span {
        font-size: 0.92rem;
        color: rgba(255,255,255,0.82);
    }

    .search-wrapper {
        max-width: 1040px;
        margin: -78px auto 0;
        position: relative;
        z-index: 5;
        padding: 0 14px;
    }

    .search-card-premium {
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(255,255,255,0.50);
        backdrop-filter: blur(12px);
        border-radius: 28px;
        padding: 34px;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.12);
    }

    .search-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .search-top h3 {
        margin: 0;
        font-size: 1.9rem;
        font-weight: 800;
        color: #101828;
    }

    .search-top p {
        margin: 6px 0 0;
        color: #667085;
    }

    .quick-badge {
        background: #eef4ff;
        color: #1849a9;
        border-radius: 999px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 700;
    }

    .search-label {
        font-size: 0.95rem;
        font-weight: 700;
        color: #344054;
        margin-bottom: 9px;
    }

    .search-card-premium .form-select {
        height: 58px;
        border-radius: 16px;
        border: 1px solid #d0d5dd;
        box-shadow: none;
        font-weight: 500;
    }

    .search-card-premium .form-select:focus {
        border-color: #1d4ed8;
        box-shadow: 0 0 0 4px rgba(29,78,216,0.10);
    }

    .search-btn-premium {
        height: 58px;
        border: none;
        width: 100%;
        border-radius: 16px;
        background: linear-gradient(135deg, #ff1f1f 0%, #df0000 100%);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 14px 28px rgba(223,0,0,0.22);
        transition: all 0.3s ease;
    }

    .search-btn-premium:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 30px rgba(223,0,0,0.28);
    }

    .section-premium {
        max-width: 1180px;
        margin: 72px auto 0;
        padding: 0 14px;
    }

    .section-heading {
        text-align: center;
        margin-bottom: 36px;
    }

    .section-heading .mini {
        color: #c0102f;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.82rem;
        margin-bottom: 10px;
    }

    .section-heading h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 12px;
    }

    .section-heading p {
        color: #667085;
        max-width: 720px;
        margin: 0 auto;
        font-size: 1.08rem;
    }

    .features-premium {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .feature-premium-card {
        background: #fff;
        border-radius: 24px;
        padding: 28px 24px;
        box-shadow: 0 12px 30px rgba(15,23,42,0.05);
        border: 1px solid #edf1f7;
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-premium-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 38px rgba(15,23,42,0.08);
    }

    .feature-icon-premium {
        width: 68px;
        height: 68px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 18px;
    }

    .bg-soft-red {
        background: #ffe9ee;
        color: #df002f;
    }

    .bg-soft-blue {
        background: #e8f0ff;
        color: #1d4ed8;
    }

    .bg-soft-green {
        background: #e7f8ec;
        color: #16a34a;
    }

    .feature-premium-card h4 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 10px;
    }

    .feature-premium-card p {
        color: #667085;
        line-height: 1.75;
        margin-bottom: 0;
    }

    .bottom-cta {
        margin-top: 34px;
        background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #eaecf0;
        border-radius: 24px;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        box-shadow: 0 10px 25px rgba(15,23,42,0.04);
    }

    .bottom-cta h3 {
        font-size: 1.7rem;
        font-weight: 800;
        color: #101828;
        margin-bottom: 8px;
    }

    .bottom-cta p {
        margin-bottom: 0;
        color: #667085;
    }

    .bottom-cta .btn-premium-main {
        white-space: nowrap;
    }

    @media (max-width: 991px) {
        .hero-title {
            font-size: 2.9rem;
            letter-spacing: -1px;
        }

        .features-premium {
            grid-template-columns: 1fr;
        }

        .bottom-cta {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .premium-home {
            margin: -1.5rem -0.75rem 0;
        }

        .premium-hero {
            padding: 70px 16px 120px;
        }

        .hero-title {
            font-size: 2.35rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .search-card-premium {
            padding: 22px;
            border-radius: 22px;
        }

        .search-top h3 {
            font-size: 1.5rem;
        }

        .section-heading h2 {
            font-size: 2rem;
        }

        .mini-stat {
            width: 100%;
        }
    }
</style>

<div class="premium-home">
    <div class="premium-hero">
        <div class="hero-inner">
            <div class="hero-pill">
                <i class="fa-solid fa-train-subway"></i>
                AL BORAQ · Train à Grande Vitesse
            </div>

            <h1 class="hero-title">
                Voyagez avec <span class="accent">AL BORAQ</span>
            </h1>

            <p class="hero-subtitle">
                Réservez vos billets de train en quelques clics avec une expérience rapide,
                élégante et sécurisée pour voyager partout au Maroc.
            </p>

            <div class="hero-actions">
                <a href="{{ route('voyage.form') }}" class="btn-premium-main">
                    Rechercher un billet
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="{{ route('cart.show') }}" class="btn-premium-soft">
                    Voir mon panier
                </a>
            </div>

            <div class="hero-mini-stats">
                <div class="mini-stat">
                    <strong>320 km/h</strong>
                    <span>Grande vitesse</span>
                </div>
                <div class="mini-stat">
                    <strong>100%</strong>
                    <span>Paiement sécurisé</span>
                </div>
                <div class="mini-stat">
                    <strong>24/7</strong>
                    <span>Réservation en ligne</span>
                </div>
            </div>
        </div>
    </div>

    <div class="search-wrapper">
        <div class="search-card-premium">
            <div class="search-top">
                <div>
                    <h3>Rechercher un billet</h3>
                    <p>Trouvez rapidement votre trajet selon votre ville de départ et d’arrivée.</p>
                </div>

                <div class="quick-badge">
                    Recherche instantanée
                </div>
            </div>

            <form action="{{ route('voyage.search') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label class="search-label">Ville de départ</label>
                    <select name="ville_depart" class="form-select" required>
                        <option value="">Choisir une ville</option>
                        @foreach ($villesDepart as $ville)
                            <option value="{{ $ville }}">{{ $ville }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="search-label">Ville d’arrivée</label>
                    <select name="ville_arrivee" class="form-select" required>
                        <option value="">Choisir une ville</option>
                        @foreach ($villesArrivee as $ville)
                            <option value="{{ $ville }}">{{ $ville }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="search-btn-premium">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    <div class="section-premium">
        <div class="section-heading">
            <div class="mini">Pourquoi choisir ONCF</div>
            <h2>Une expérience moderne, rapide et confortable</h2>
            <p>
                Profitez d’un service premium avec des trajets rapides,
                un confort de haut niveau et une réservation simple à tout moment.
            </p>
        </div>

        <div class="features-premium">
            <div class="feature-premium-card">
                <div class="feature-icon-premium bg-soft-red">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h4>Rapidité</h4>
                <p>
                    Voyagez à grande vitesse entre les principales villes du Maroc
                    avec une expérience fluide et optimisée.
                </p>
            </div>

            <div class="feature-premium-card">
                <div class="feature-icon-premium bg-soft-blue">
                    <i class="fa-solid fa-train"></i>
                </div>
                <h4>Confort premium</h4>
                <p>
                    Profitez de sièges confortables, d’un espace agréable
                    et d’un voyage pensé pour votre bien-être.
                </p>
            </div>

            <div class="feature-premium-card">
                <div class="feature-icon-premium bg-soft-green">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4>Sécurité</h4>
                <p>
                    Réservez en toute confiance grâce à un système fiable,
                    sécurisé et simple à utiliser.
                </p>
            </div>
        </div>

        <div class="bottom-cta">
            <div>
                <h3>Prêt pour votre prochain trajet ?</h3>
                <p>
                    Recherchez votre billet, ajoutez-le au panier et finalisez votre réservation en quelques minutes.
                </p>
            </div>

            <a href="{{ route('voyage.form') }}" class="btn-premium-main">
                Commencer maintenant
            </a>
        </div>
    </div>
</div>
@endsection