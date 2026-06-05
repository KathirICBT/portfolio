@extends('front.layouts.app')

@section('content')
<style>
    /* Modern Premium Dark CSS Design Tokens */
    :root {
        --bg-primary: #0a192f;
        --bg-secondary: #0c1b30;
        --bg-card: #0d1e36;
        --bg-card-hover: #112644;
        --color-gold: #d9b054;
        --color-gold-hover: #c5a059;
        --color-gold-glow: rgba(217, 176, 84, 0.15);
        --color-text-primary: #ffffff;
        --color-text-muted: #8892b0;
        --color-text-light: #ccd6f6;
        --font-heading: 'Cormorant Garamond', Georgia, serif;
        --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
        --border-gold: 1px solid rgba(217, 176, 84, 0.25);
        --border-gold-focus: 1px solid rgba(217, 176, 84, 0.7);
        --transition-smooth: all 0.45s cubic-bezier(0.25, 1, 0.33, 1);
        --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.6);
    }
    
    body {
        background-color: var(--bg-primary);
        color: var(--color-text-light);
        font-family: var(--font-sans);
        line-height: 1.6;
        overflow-x: hidden;
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(12, 27, 48, 0.8) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(217, 176, 84, 0.03) 0%, transparent 50%);
        background-attachment: fixed;
    }
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: var(--bg-primary);
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(217, 176, 84, 0.3);
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: var(--color-gold);
    }
    /* Typography */
    h1, h2, h3, h4, h5, h6 {
        font-family: var(--font-heading);
        color: var(--color-text-primary);
        font-weight: 600;
        letter-spacing: 0.02em;
    }
    a {
        color: inherit;
        text-decoration: none;
        transition: var(--transition-smooth);
    }
    
    /* HERO AREA */
    .hero-section {
        padding: 12rem 2rem 7rem 2rem;
        text-align: center;
        position: relative;
        background: linear-gradient(to bottom, rgba(12, 27, 48, 0.5), transparent);
    }
    .hero-subtitle {
        font-family: var(--font-sans);
        color: var(--color-gold);
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-bottom: 1.25rem;
        display: inline-block;
        position: relative;
    }
    .hero-subtitle::before {
        content: '';
        position: absolute;
        left: -40px;
        top: 50%;
        width: 25px;
        height: 1px;
        background: var(--color-gold);
    }
    .hero-subtitle::after {
        content: '';
        position: absolute;
        right: -40px;
        top: 50%;
        width: 25px;
        height: 1px;
        background: var(--color-gold);
    }
    .hero-title {
        font-size: 4rem;
        font-weight: 300;
        line-height: 1.15;
        margin-bottom: 1.5rem;
    }
    .hero-title span {
        font-style: italic;
        color: var(--color-gold);
        font-weight: 400;
    }
    .hero-desc {
        max-width: 600px;
        margin: 0 auto;
        color: var(--color-text-muted);
        font-size: 1.1rem;
        font-weight: 300;
    }
    
    /* PRODUCT CATALOG SECTION */
    .catalog-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 6rem 2rem 8rem 2rem;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 6.5rem 2.5rem;
    }
    
    /* HIGH END ARTIFACT PRODUCT CARD WITH REVEAL FRAMEWORKS */
    .product-card {
        background: var(--bg-card);
        border: var(--border-gold);
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        position: relative;
        transition: var(--transition-smooth);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        height: 100%;
        padding-top: 100px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }
    .product-card:hover {
        transform: translateY(-8px);
        border-color: rgba(217, 176, 84, 0.5);
        background: var(--bg-card-hover);
        box-shadow: var(--shadow-premium), 0 0 40px rgba(217, 176, 84, 0.08);
    }
    
    /* THE LAYERED OVERLAP SYSTEM (FIXED ABSOLUTE ALIGNMENT) */
    .product-image-frame {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%) translateY(-40%);
        width: 100%;
        height: 180px; 
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5;
    }
    
    /* Elegant Abstract Geometrical Sphere Background Placement */
    .product-image-frame::before {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(23, 42, 69, 0.9) 0%, rgba(10, 25, 47, 0.4) 70%, transparent 100%);
        border: 1px dashed rgba(217, 176, 84, 0.25);
        z-index: 1;
        transition: var(--transition-smooth);
        box-shadow: inset 0 0 20px rgba(217, 176, 84, 0.05);
    }
    .product-card:hover .product-image-frame::before {
        transform: scale(1.08) rotate(15deg);
        border-color: rgba(217, 176, 84, 0.5);
        box-shadow: 0 0 30px var(--color-gold-glow), inset 0 0 25px rgba(217, 176, 84, 0.1);
    }
    
    .product-image-wrapper {
        position: relative;
        width: 170px;
        height: 170px; 
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        background: #081426;
        border: 1px solid rgba(217, 176, 84, 0.15);
        cursor: zoom-in;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-smooth);
        transform: scale(1);
    }
    .product-card:hover .product-image {
        transform: scale(1.1);
        filter: saturate(1.05);
    }
    
    /* Modern Micro badges */
    .card-header-badge {
        position: absolute;
        bottom: -15px;
        left: 1.5rem;
        background: rgba(10, 25, 47, 0.85);
        border: 1px solid rgba(217, 176, 84, 0.25);
        color: var(--color-gold);
        font-family: var(--font-sans);
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 0.3rem 0.7rem;
        border-radius: 4px;
        z-index: 6;
        backdrop-filter: blur(5px);
    }
    .card-sku-badge {
        position: absolute;
        bottom: -12px;
        right: 1.5rem;
        color: var(--color-text-muted);
        font-family: var(--font-sans);
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        z-index: 6;
    }

    .product-content {
        padding: 1.5rem 1.75rem 1.75rem 1.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        position: relative;
        z-index: 3;
    }
    .product-category {
        font-family: var(--font-sans);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--color-gold);
        margin-bottom: 0.4rem;
        font-weight: 600;
    }
    .product-name {
        font-size: 1.6rem;
        font-weight: 400;
        line-height: 1.3;
        margin-bottom: 0.75rem;
        color: var(--color-text-primary);
    }
    .product-description {
        font-size: 13px;
        color: #aab4c3;
        margin: 4px 0 14px;
        line-height: 1.45;
    }
    .product-pricing {
        display: flex;
        align-items: baseline;
        gap: 0.4rem;
        margin-bottom: 0.5rem;
    }
    .currency {
        color: var(--color-gold);
        font-size: 0.95rem;
        font-family: var(--font-sans);
        font-weight: 600;
    }
    .price-value {
        font-size: 1.75rem;
        font-family: var(--font-heading);
        font-weight: 700;
        color: var(--color-text-primary);
    }
    .price-suffix {
        font-family: var(--font-sans);
        color: var(--color-text-muted);
        font-size: 0.78rem;
        margin-left: 0.2rem;
    }
    .selector-label {
        font-family: var(--font-sans);
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--color-text-light);
        margin-top: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .selector-label span.unit-type {
        color: var(--color-gold);
        font-size: 0.72rem;
        background: rgba(217, 176, 84, 0.1);
        padding: 0.15rem 0.4rem;
        border-radius: 3px;
    }
    
    /* ULTRA ADAPTIVE LIGHTBOX MODAL SYSTEM */
    .image-lightbox-modal {
        position: fixed;
        inset: 0;
        background: rgba(5, 12, 23, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        z-index: 2000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.33, 1);
        padding: 2rem;
    }
    .image-lightbox-modal.active {
        opacity: 1;
        visibility: visible;
    }
    .lightbox-content-container {
        position: relative;
        max-width: 800px;
        max-height: 80vh;
        width: 100%;
        transform: scale(0.92);
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.33, 1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .image-lightbox-modal.active .lightbox-content-container {
        transform: scale(1);
    }
    .lightbox-expanded-image {
        max-width: 100%;
        max-height: 80vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 40px rgba(217, 176, 84, 0.1);
        border: 1px solid rgba(217, 176, 84, 0.2);
    }
    .lightbox-close-trigger {
        position: absolute;
        top: -3.5rem;
        right: 0;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--color-text-primary);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .lightbox-close-trigger:hover {
        background: #e63946;
        border-color: #e63946;
        transform: rotate(90deg);
    }

    /* LUXURY CART DRAWER OVERLAY */
    .cart-overlay {
        position: fixed;
        inset: 0;
        background: rgba(5, 12, 23, 0.8);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition-smooth);
    }
    .cart-overlay.open {
        opacity: 1;
        visibility: visible;
    }
    .cart-drawer {
        position: fixed;
        top: 0;
        right: -460px;
        bottom: 0;
        width: 100%;
        max-width: 460px;
        background: #0c1b30;
        border-left: 1px solid rgba(217, 176, 84, 0.25);
        z-index: 1000;
        box-shadow: -15px 0 35px rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        transition: right 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .cart-overlay.open .cart-drawer {
        right: 0;
    }
    .cart-header {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .cart-header-title {
        font-size: 1.8rem;
        font-weight: 400;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .cart-header-title span.title-accent {
        color: var(--color-gold);
        font-style: italic;
    }
    .close-cart-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--color-text-light);
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .close-cart-btn:hover {
        border-color: var(--color-gold);
        color: var(--color-gold);
        background: rgba(217, 176, 84, 0.05);
    }
    .cart-items-body {
        flex-grow: 1;
        overflow-y: auto;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .empty-cart-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: var(--color-text-muted);
        text-align: center;
        gap: 1.25rem;
    }
    .empty-cart-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(217, 176, 84, 0.05);
        border: 1px dashed rgba(217, 176, 84, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-gold);
        margin-bottom: 0.5rem;
    }
    .empty-cart-text {
        font-family: var(--font-heading);
        font-size: 1.4rem;
        color: var(--color-text-primary);
    }
    .cart-item {
        background: rgba(23, 42, 69, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 6px;
        padding: 1rem;
        display: flex;
        gap: 1rem;
        position: relative;
        animation: slideIn 0.3s ease-out;
        transition: var(--transition-smooth);
    }
    .cart-item:hover {
        border-color: rgba(217, 176, 84, 0.2);
        background: rgba(23, 42, 69, 0.6);
    }
    @keyframes slideIn {
        from { transform: translateX(20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .cart-item-image-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 4px;
        overflow: hidden;
        background: #081426;
        flex-shrink: 0;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .cart-item-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cart-item-details {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .cart-item-sku {
        font-size: 0.68rem;
        font-family: var(--font-sans);
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 0.15rem;
    }
    .cart-item-name {
        font-size: 1.05rem;
        font-family: var(--font-sans);
        font-weight: 500;
        color: var(--color-text-primary);
        line-height: 1.3;
        margin-bottom: 0.25rem;
    }
    .cart-item-meta {
        font-size: 0.78rem;
        color: var(--color-text-muted);
        margin-bottom: 0.5rem;
        display: flex;
        gap: 0.5rem;
    }
    .cart-item-meta span.item-unit {
        color: var(--color-text-light);
        font-weight: 600;
    }
    .cart-item-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }
    .cart-item-price {
        font-family: var(--font-heading);
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--color-text-primary);
    }
    .cart-item-qty {
        display: flex;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(10, 25, 47, 0.4);
        border-radius: 4px;
        padding: 0.15rem;
    }
    .cart-item-qty-btn {
        background: none;
        border: none;
        color: var(--color-text-light);
        cursor: pointer;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition-smooth);
    }
    .cart-item-qty-btn:hover {
        background: rgba(217, 176, 84, 0.2);
        color: var(--color-gold);
    }
    .cart-item-qty-input {
        width: 24px;
        border: none;
        background: transparent;
        color: var(--color-text-primary);
        text-align: center;
        font-family: var(--font-sans);
        font-size: 0.85rem;
        font-weight: 600;
        outline: none;
    }
    .remove-cart-item {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: none;
        border: none;
        color: var(--color-text-muted);
        cursor: pointer;
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .remove-cart-item:hover {
        color: #e63946;
    }
    .cart-footer {
        padding: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(10, 25, 47, 0.4);
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }
    .cart-summary-line {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        color: var(--color-text-muted);
    }
    .cart-summary-line.total {
        font-size: 1.25rem;
        color: var(--color-text-primary);
        font-weight: 600;
        border-top: 1px dashed rgba(255, 255, 255, 0.1);
        padding-top: 0.75rem;
    }
    .cart-summary-line.total span.total-price {
        font-family: var(--font-heading);
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--color-gold);
    }
    .checkout-btn {
        background: linear-gradient(135deg, var(--color-gold), #b8923a);
        color: #0c1b30;
        border: none;
        width: 100%;
        height: 52px;
        font-family: var(--font-sans);
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(217, 176, 84, 0.25);
        transition: var(--transition-smooth);
    }
    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(217, 176, 84, 0.4), var(--shadow-gold);
    }
    /* SUCCESS NOTIFICATION TOAST */
    .toast-container {
        position: fixed;
        bottom: 2rem;
        left: 2rem;
        z-index: 2000;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        pointer-events: none;
    }
    .toast-notification {
        background: #0c1b30;
        border-left: 4px solid var(--color-gold);
        border-top: 1px solid rgba(217, 176, 84, 0.1);
        border-right: 1px solid rgba(217, 176, 84, 0.1);
        border-bottom: 1px solid rgba(217, 176, 84, 0.1);
        box-shadow: var(--shadow-premium);
        color: var(--color-text-primary);
        padding: 1rem 1.5rem;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        pointer-events: auto;
        transform: translateY(50px);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .toast-notification.show {
        transform: translateY(0);
        opacity: 1;
    }
    .toast-icon {
        color: var(--color-gold);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .toast-content {
        font-family: var(--font-sans);
        font-size: 0.88rem;
    }
    .toast-content strong {
        color: var(--color-gold);
    }
    
    @media (max-width: 991px) {
        .hero-title {
            font-size: 3rem;
        }
    }
    @media (max-width: 576px) {
        .hero-title {
            font-size: 2.3rem;
        }
        .product-grid {
            grid-template-columns: 1fr;
            gap: 7.5rem 0;
        }
        .cart-drawer {
            max-width: 100%;
            right: -100%;
        }
    }
</style>

<section class="hero-section">
    <div class="hero-subtitle">Curated Collection</div>
    <h1 class="hero-title">Artisanal <span>Goods & Oils</span></h1>
    <p class="hero-desc">Discover our premium range of organic essentials, hand-picked and verified for the ultimate standards of taste, health, and purity.</p>
</section>

<main class="catalog-container">
    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card" data-product-id="{{ $product->id }}" data-base-price="{{ $product->price }}">
                
                <!-- COAXIAL IMAGE FRAME (HALF IN / HALF OUT SPHERE) -->
                <div class="product-image-frame">
                    <span class="card-header-badge">{{ $product->category->name ?? 'Unassigned' }}</span>
                    <span class="card-sku-badge">#{{ $product->product_number }}</span>
                    
                    <!-- Added onclick triggering the global lightbox view handler -->
                    <div class="product-image-wrapper" onclick="openImageLightbox('{{ $product->image ?? 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=600' }}')">
                        <img class="product-image" src="{{ $product->image ?? 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=600' }}" alt="{{ $product->product_name }}" loading="lazy">
                    </div>
                </div>
                
                <div class="product-content">
                    <div class="product-category">{{ $product->category->name ?? 'General' }}</div>
                    <h3 class="product-name">{{ $product->product_name }}</h3>
                    
                    @if($product->description)
                        <p class="product-description">
                            {{ Str::limit($product->description, 90) }}
                        </p>
                    @endif
                    <div class="product-pricing">
                        <span class="currency">$</span>
                        <span class="price-value" id="price-display-{{ $product->id }}">
                            {{ number_format($product->price, 2) }}
                        </span>
                        <span class="price-suffix">USD</span>
                    </div>
                    
                    <div class="selector-label">
                        <span>Portion</span>
                        <span class="unit-type">{{ $product->unit_type ?? 'Standard' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

<!-- HIGH SPEC PRODUCT LIGHTBOX CONTAINER -->
<div class="image-lightbox-modal" id="globalProductLightbox" onclick="closeImageLightbox(event)">
    <div class="lightbox-content-container">
        <button class="lightbox-close-trigger" onclick="forceCloseLightbox()" aria-label="Close Preview">
            <i data-lucide="x" style="width: 22px; height: 22px;"></i>
        </button>
        <img src="" id="lightboxTargetSource" class="lightbox-expanded-image" alt="Expanded Product Preview">
    </div>
</div>

<div class="cart-overlay" id="cartOverlay">
    <div class="cart-drawer">
        <div class="cart-header">
            <h2 class="cart-header-title">Your <span class="title-accent">Selection</span></h2>
            <button class="close-cart-btn" id="closeCart" aria-label="Close Cart">
                <i data-lucide="x" style="width: 20px; height: 20px;"></i>
            </button>
        </div>
        <div class="cart-items-body" id="cartItemsContainer">
            <div class="empty-cart-state" id="emptyCartState">
                <div class="empty-cart-icon-wrapper">
                    <i data-lucide="shopping-bag" style="width: 36px; height: 36px;"></i>
                </div>
                <h3 class="empty-cart-text">No items selected</h3>
                <p style="font-size: 0.85rem; max-width: 250px; line-height: 1.5;">Enhance your wellness with our premium curated collection.</p>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-summary-line">
                <span>Subtotal</span>
                <span id="cartSubtotal">$0.00</span>
            </div>
            <div class="cart-summary-line">
                <span>Shipping (Luxury Courier)</span>
                <span id="cartShipping" style="color: var(--color-gold);">Complimentary</span>
            </div>
            <div class="cart-summary-line total">
                <span>Total Estimated</span>
                <span class="total-price" id="cartTotal">$0.00</span>
            </div>
            
            <button class="checkout-btn" type="button" onclick="proceedToCheckout()">
                <i data-lucide="credit-card" style="width: 18px; height: 18px;"></i>
                <span>Proceed to Order</span>
            </button>
        </div>
    </div>
</div>

<div class="toast-container" id="toastContainer"></div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    const productsData = {
        @foreach ($products as $product)
            "{{ $product->id }}": {
                id: {{ $product->id }},
                sku: "{{ $product->product_number }}",
                name: "{!! addslashes($product->product_name) !!}",
                category: "{{ $product->category->name ?? 'General' }}",
                basePrice: {{ $product->price }},
                image: "{{ $product->image ?? 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=600' }}",
                selectedUnit: "{{ $product->unit_value }} {{ $product->unit_type }}",
                selectedMultiplier: 1.0
            },
        @endforeach
    };

    let cart = [];

    /* INTERACTIVE LIGHTBOX WINDOW LOGIC ENGINE */
    function openImageLightbox(imageSrc) {
        const lightbox = document.getElementById('globalProductLightbox');
        const lightboxImg = document.getElementById('lightboxTargetSource');
        if (lightbox && lightboxImg) {
            lightboxImg.src = imageSrc;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevents background body scrolling
        }
    }

    function closeImageLightbox(event) {
        const lightbox = document.getElementById('globalProductLightbox');
        // Closes only if clicking outside the core product image bounding area
        if (event.target === lightbox) {
            forceCloseLightbox();
        }
    }

    function forceCloseLightbox() {
        const lightbox = document.getElementById('globalProductLightbox');
        if (lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    window.addEventListener('scroll', () => {
        const header = document.getElementById('mainHeader');
        if (header) {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });

    const cartToggle = document.getElementById('cartToggle');
    const closeCart = document.getElementById('closeCart');
    const cartOverlay = document.getElementById('cartOverlay');

    if (cartToggle) {
        cartToggle.addEventListener('click', () => {
            cartOverlay.classList.add('open');
        });
    }
    if (closeCart) {
        closeCart.addEventListener('click', () => {
            cartOverlay.classList.remove('open');
        });
    }
    if (cartOverlay) {
        cartOverlay.addEventListener('click', (e) => {
            if (e.target === cartOverlay) {
                cartOverlay.classList.remove('open');
            }
        });
    }

    function selectUnit(productId, element) {
        const product = productsData[productId];
        if (!product) return;
        const siblings = element.parentNode.children;
        for (let i = 0; i < siblings.length; i++) {
            siblings[i].classList.remove('active');
        }
        element.classList.add('active');
        product.selectedUnit = element.getAttribute('data-label');
        product.selectedMultiplier = parseFloat(element.getAttribute('data-multiplier'));
        updateCardPrice(productId);
    }

    function updateCardPrice(productId) {
        const product = productsData[productId];
        const qtyInput = document.getElementById(`qty-${productId}`);
        const qty = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;
        const priceDisplay = document.getElementById(`price-display-${productId}`);
        if (priceDisplay) {
            const dynamicPrice = product.basePrice * product.selectedMultiplier * qty;
            priceDisplay.textContent = dynamicPrice.toFixed(2);
        }
    }

    function adjustQty(productId, amount) {
        const qtyInput = document.getElementById(`qty-${productId}`);
        if (!qtyInput) return;
        let currentVal = parseInt(qtyInput.value) || 1;
        currentVal += amount;
        if (currentVal < 1) currentVal = 1;
        if (currentVal > 50) currentVal = 50;
        qtyInput.value = currentVal;
        updateCardPrice(productId);
    }

    function addToCart(productId) {
        const product = productsData[productId];
        if (!product) return;
        const qtyInput = document.getElementById(`qty-${productId}`);
        const quantityToAdd = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;
        const singleItemPrice = product.basePrice * product.selectedMultiplier;
        const existingIndex = cart.findIndex(item => item.id === productId && item.portion === product.selectedUnit);
        
        if (existingIndex > -1) {
            cart[existingIndex].quantity += quantityToAdd;
        } else {
            cart.push({
                id: product.id,
                sku: product.sku,
                name: product.name,
                category: product.category,
                portion: product.selectedUnit,
                singlePrice: singleItemPrice,
                quantity: quantityToAdd,
                image: product.image
            });
        }
        if (qtyInput) qtyInput.value = 1;
        updateCardPrice(productId);
        updateCartUI();
        showNotification(product.name, product.selectedUnit, quantityToAdd);
    }

    function adjustCartItemQty(cartIndex, amount) {
        cart[cartIndex].quantity += amount;
        if (cart[cartIndex].quantity < 1) {
            cart.splice(cartIndex, 1);
        }
        updateCartUI();
    }

    function removeCartItem(cartIndex) {
        cart.splice(cartIndex, 1);
        updateCartUI();
    }

    function updateCartUI() {
        const container = document.getElementById('cartItemsContainer');
        const emptyState = document.getElementById('emptyCartState');
        const subtotalEl = document.getElementById('cartSubtotal');
        const totalEl = document.getElementById('cartTotal');
        const badgeCount = document.getElementById('cartBadgeCount');
        
        if (!container) return;
        const itemNodes = container.querySelectorAll('.cart-item');
        itemNodes.forEach(node => node.remove());

        let totalCartUnits = 0;
        let subtotal = 0;

        if (cart.length === 0) {
            if (emptyState) emptyState.style.display = 'flex';
            if (badgeCount) badgeCount.style.display = 'none';
        } else {
            if (emptyState) emptyState.style.display = 'none';
            cart.forEach((item, index) => {
                totalCartUnits += item.quantity;
                const itemTotalPrice = item.singlePrice * item.quantity;
                subtotal += itemTotalPrice;

                const cartItemHTML = `
                    <div class="cart-item">
                        <div class="cart-item-image-wrapper">
                            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        </div>
                        <div class="cart-item-details">
                            <span class="cart-item-sku">#${item.sku}</span>
                            <h4 class="cart-item-name">${item.name}</h4>
                            <div class="cart-item-meta">
                                <span>Portion:</span>
                                <span class="item-unit">${item.portion}</span>
                            </div>
                            <div class="cart-item-bottom">
                                <span class="cart-item-price">$${itemTotalPrice.toFixed(2)}</span>
                                <div class="cart-item-qty">
                                    <button class="cart-item-qty-btn" onclick="adjustCartItemQty(${index}, -1)" aria-label="Reduce">
                                        <i data-lucide="minus" style="width: 11px; height: 11px;"></i>
                                    </button>
                                    <input class="cart-item-qty-input" type="text" value="${item.quantity}" readonly>
                                    <button class="cart-item-qty-btn" onclick="adjustCartItemQty(${index}, 1)" aria-label="Increase">
                                        <i data-lucide="plus" style="width: 11px; height: 11px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button class="remove-cart-item" onclick="removeCartItem(${index})" aria-label="Remove Item">
                            <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                        </button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', cartItemHTML);
            });
            if (badgeCount) {
                badgeCount.textContent = totalCartUnits;
                badgeCount.style.display = 'flex';
            }
        }
        if (subtotalEl) subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
        if (totalEl) totalEl.textContent = `$${subtotal.toFixed(2)}`;
        lucide.createIcons();
    }

    function showNotification(productName, portion, qty) {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = `
            <div class="toast-icon">
                <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
            </div>
            <div class="toast-content">
                Added <strong>${qty}x</strong> of ${productName} (<em>${portion}</em>) to your selection.
            </div>
        `;
        container.appendChild(toast);
        lucide.createIcons();
        setTimeout(() => { toast.classList.add('show'); }, 50);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => { toast.remove(); }, 400);
        }, 3500);
    }

    function proceedToCheckout() {
        if (cart.length === 0) {
            alert('Your selection is empty. Please add items to your cart.');
            return;
        }
        alert('Proceeding to checkout with your live backend items!');
    }
</script>
@endsection