@extends('master_page')

@section('title', 'Bienvenue - AL BORAQ')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #2b2b2b 100%);
        border-radius: 24px;
        padding: 80px 40px;
        text-align: center;
        color: white;
        margin-top: 50px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(209,18,66,0.15) 0%, rgba(0,0,0,0) 50%);
        pointer-events: none;
    }

    .hero-title {
        font-weight: 800;
        font-size: 3.5rem;
        margin-bottom: 20px;
        letter-spacing: -1px;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: #e1e5eb;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-hero {
        background-color: #d11242;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 16px 40px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        display: inline-block;
        box-shadow: 0 10px 20px rgba(209, 18, 66, 0.3);
    }

    .btn-hero:hover {
        background-color: #b00f36;
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(209, 18, 66, 0.4);
        color: white;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 60px;
    }

    .feature-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        text-align: center;
        transition: transform 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f7f9fc;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #0d6efd;
        margin: 0 auto 20px auto;
    }

    .feature-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .feature-text {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .features-grid {
            grid-template-columns: 1fr;
        }
        .hero-title {
            font-size: 2.5rem;
        }
    }
</style>

<div class="container pb-5">
    <div class="hero-section">
        <div class="fs-1 mb-3" style="color: #d11242;"><i class="fa-solid fa-train-subway"></i></div>
        <h1 class="hero-title">Voyagez avec AL BORAQ</h1>
        <p class="hero-subtitle">Réservez vos billets en ligne rapidement et profitez de nos trains à grande vitesse pour traverser le Maroc en un temps record.</p>
        <a href="{{ route('voyage.form') }}" class="btn-hero">
            Rechercher un billet <i class="fa-solid fa-arrow-right ms-2"></i>
        </a>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-bolt text-warning"></i></div>
            <h3 class="feature-title">Ultra Rapide</h3>
            <p class="feature-text">Gagnez du temps précieux. Voyagez entre Tanger et Casablanca en seulement 2h10.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-couch text-success"></i></div>
            <h3 class="feature-title">Confort Absolu</h3>
            <p class="feature-text">Des sièges spacieux, une climatisation parfaite et un service à bord de qualité.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-shield-halved text-primary"></i></div>
            <h3 class="feature-title">Paiement Sécurisé</h3>
            <p class="feature-text">Vos transactions sont 100% sécurisées grâce à notre système de paiement certifié.</p>
        </div>
    </div>
</div>
@endsection
