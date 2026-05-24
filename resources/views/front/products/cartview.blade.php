@php
/**
 * Elegant Products & Cart blade view for Suresh Kumar Consulting theme.
 * Loaded dynamically using Eloquent models from the database.
 */
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium artisanal products designed for luxury tastes. Organic oils, teas, coffees, and spices.">
    <title>Suresh Kumar | Premium Artisanal Collection</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Modern Premium Dark CSS Design Tokens */
        :root {
            --bg-primary: #0a192f;
            --bg-secondary: #0c1b30;
            --bg-card: rgba(23, 42, 69, 0.7);
            --bg-card-hover: rgba(35, 53, 84, 0.9);
            --color-gold: #d9b054;
            --color-gold-hover: #c5a059;
            --color-gold-glow: rgba(217, 176, 84, 0.35);
            --color-text-primary: #ffffff;
            --color-text-muted: #8892b0;
            --color-text-light: #ccd6f6;
            --font-heading: 'Cormorant Garamond', Georgia, serif;
            --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
            --border-gold: 1px solid rgba(217, 176, 84, 0.2);
            --border-gold-focus: 1px solid rgba(217, 176, 84, 0.7);
            --transition-smooth: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            --shadow-premium: 0 15px 35px rgba(0, 0, 0, 0.5), 0 5px 15px rgba(0, 0, 0, 0.3);
            --shadow-gold: 0 0 25px rgba(217, 176, 84, 0.15);
        }
        /* Base Reset & Core Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
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
        /* STUNNING HEADER */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(10, 25, 47, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: var(--transition-smooth);
        }
        header.scrolled {
            background: rgba(8, 20, 38, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid rgba(217, 176, 84, 0.15);
        }
        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 2rem;
        }
        .logo-box {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .logo-badge {
            background: var(--color-gold);
            color: #0c1b30;
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.3rem;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            box-shadow: 0 0 15px rgba(217, 176, 84, 0.3);
        }
        .logo-text {
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 1.15rem;
            color: var(--color-text-primary);
            letter-spacing: 0.5px;
        }
        nav ul {
            display: flex;
            list-style: none;
            gap: 2.2rem;
        }
        nav ul li a {
            font-size: 0.92rem;
            font-weight: 400;
            color: var(--color-text-light);
            position: relative;
            padding: 0.5rem 0;
        }
        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1.5px;
            background-color: var(--color-gold);
            transition: var(--transition-smooth);
        }
        nav ul li a:hover {
            color: var(--color-gold);
        }
        nav ul li a:hover::after {
            width: 100%;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .phone-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--color-text-muted);
        }
        .phone-link:hover {
            color: var(--color-gold);
        }
        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--color-text-primary);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-smooth);
        }
        .theme-toggle-btn:hover {
            border-color: var(--color-gold);
            color: var(--color-gold);
            box-shadow: 0 0 10px rgba(217, 176, 84, 0.2);
        }
        .cart-toggle-btn {
            background: linear-gradient(135deg, var(--color-gold), #b8923a);
            color: #0c1b30;
            border: none;
            padding: 0.7rem 1.4rem;
            border-radius: 4px;
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(217, 176, 84, 0.3);
            transition: var(--transition-smooth);
            position: relative;
        }
        .cart-toggle-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(217, 176, 84, 0.5), var(--shadow-gold);
        }
        .cart-badge {
            background: #e63946;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            position: absolute;
            top: -7px;
            right: -7px;
            border: 2px solid var(--bg-primary);
            animation: pop 0.3s ease-out;
        }
        @keyframes pop {
            0% { transform: scale(0.6); }
            80% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        /* HERO AREA */
        .hero-section {
            padding: 10rem 2rem 5rem 2rem;
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
            padding: 2rem 2rem 8rem 2rem;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 2.5rem;
        }
        /* STUNNING PRODUCT CARD */
        .product-card {
            background: var(--bg-card);
            border: var(--border-gold);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: var(--transition-smooth);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            height: 100%;
        }
        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(217, 176, 84, 0.08), transparent 60%);
            z-index: 0;
            pointer-events: none;
        }
        .product-card:hover {
            transform: translateY(-8px);
            border-color: rgba(217, 176, 84, 0.45);
            background: var(--bg-card-hover);
            box-shadow: var(--shadow-premium), 0 0 30px rgba(217, 176, 84, 0.05);
        }
        .card-header-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(10, 25, 47, 0.85);
            border: 1px solid rgba(217, 176, 84, 0.3);
            color: var(--color-gold);
            font-family: var(--font-sans);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 0.3rem 0.75rem;
            border-radius: 3px;
            z-index: 10;
            backdrop-filter: blur(5px);
        }
        .card-sku-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.07);
            color: var(--color-text-light);
            font-family: var(--font-sans);
            font-size: 0.72rem;
            font-weight: 500;
            padding: 0.3rem 0.6rem;
            border-radius: 3px;
            z-index: 10;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .product-image-container {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: #081426;
        }
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .product-card:hover .product-image {
            transform: scale(1.08);
        }
        .product-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(10, 25, 47, 0.9) 100%);
            pointer-events: none;
        }
        .product-content {
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            position: relative;
            z-index: 2;
        }
        .product-category {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--color-gold);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .product-name {
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 1.25;
            margin-bottom: 0.85rem;
            color: var(--color-text-primary);
        }
        .product-description{
            font-size:13px;
            color:#aab4c3;
            margin:6px 0 10px;
            line-height:1.4;
        }
        .product-pricing {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .currency {
            color: var(--color-gold);
            font-size: 1rem;
            font-family: var(--font-sans);
            font-weight: 600;
        }
        .price-value {
            font-size: 1.8rem;
            font-family: var(--font-heading);
            font-weight: 700;
            color: var(--color-text-primary);
            transition: var(--transition-smooth);
        }
        .price-suffix {
            font-family: var(--font-sans);
            color: var(--color-text-muted);
            font-size: 0.8rem;
            margin-left: 0.25rem;
        }
        .selector-label {
            font-family: var(--font-sans);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--color-text-light);
            margin-bottom: 0.65rem;
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
        .unit-selector {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .unit-pill {
            background: rgba(10, 25, 47, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--color-text-light);
            padding: 0.5rem 0;
            text-align: center;
            font-family: var(--font-sans);
            font-size: 0.8rem;
            font-weight: 500;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition-smooth);
            user-select: none;
        }
        .unit-pill.active {
            background: var(--color-gold);
            border-color: var(--color-gold);
            color: #0c1b30;
            font-weight: 600;
            box-shadow: 0 0 10px rgba(217, 176, 84, 0.2);
        }
        .purchase-controls {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 0.75rem;
            margin-top: auto;
        }
        .quantity-selector {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: var(--border-gold);
            background: rgba(10, 25, 47, 0.5);
            border-radius: 4px;
            overflow: hidden;
            height: 48px;
            padding: 0 0.5rem;
        }
        .qty-btn {
            background: none;
            border: none;
            color: var(--color-text-light);
            cursor: pointer;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition-smooth);
        }
        .qty-btn:hover {
            background: rgba(217, 176, 84, 0.15);
            color: var(--color-gold);
        }
        .qty-input {
            width: 32px;
            border: none;
            background: transparent;
            color: var(--color-text-primary);
            text-align: center;
            font-family: var(--font-sans);
            font-size: 0.95rem;
            font-weight: 600;
            outline: none;
        }
        .add-to-cart-btn {
            background: transparent;
            border: 1px solid var(--color-gold);
            color: var(--color-gold);
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.5px;
            border-radius: 4px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .add-to-cart-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(217, 176, 84, 0.25), transparent);
            transition: 0.6s;
            z-index: -1;
        }
        .add-to-cart-btn:hover::before {
            left: 100%;
        }
        .add-to-cart-btn:hover {
            background: var(--color-gold);
            color: #0c1b30;
            box-shadow: 0 4px 15px var(--color-gold-glow);
            transform: translateY(-1px);
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
        /* FOOTER */
        footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: #081426;
            padding: 4rem 2rem;
            text-align: center;
            color: var(--color-text-muted);
            font-size: 0.9rem;
        }
        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .footer-logo .badge {
            background: var(--color-gold);
            color: #0c1b30;
            font-family: var(--font-heading);
            font-weight: 700;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 3px;
        }
        .footer-logo .text {
            color: var(--color-text-primary);
            font-family: var(--font-sans);
            font-weight: 600;
        }
        .footer-copyright {
            margin-top: 1.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        @media (max-width: 991px) {
            .hero-title {
                font-size: 3rem;
            }
            nav ul {
                display: none;
            }
        }
        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.3rem;
            }
            .product-grid {
                grid-template-columns: 1fr;
            }
            .purchase-controls {
                grid-template-columns: 100px 1fr;
            }
            .cart-drawer {
                max-width: 100%;
                right: -100%;
            }
        }
    </style>
</head>
<body>
    <header id="mainHeader">
        <div class="nav-container">
            <div class="logo-box">
                <div class="logo-badge">SK</div>
                <div class="logo-text">Suresh Kumar</div>
            </div>
            
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#network">Network</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="tel:4168187444" class="phone-link">
                    <i data-lucide="phone" style="width: 16px; height: 16px;"></i>
                    <span>416-818-7444</span>
                </a>
                
                <button class="theme-toggle-btn" aria-label="Toggle Theme">
                    <i data-lucide="sun" style="width: 18px; height: 18px;"></i>
                </button>
                <button class="cart-toggle-btn" id="cartToggle">
                    <i data-lucide="shopping-bag" style="width: 18px; height: 18px;"></i>
                    <span>Cart</span>
                    <div class="cart-badge" id="cartBadgeCount" style="display: none;">0</div>
                </button>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="hero-subtitle">Curated Collection</div>
        <h1 class="hero-title">Artisanal <span>Goods & Oils</span></h1>
        <p class="hero-desc">Discover our premium range of organic essentials, hand-picked and verified for the ultimate standards of taste, health, and purity.</p>
    </section>

    <main class="catalog-container">
        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card" data-product-id="{{ $product->id }}" data-base-price="{{ $product->price }}">
                    <span class="card-header-badge">{{ $product->category->name ?? 'Unassigned' }}</span>
                    <span class="card-sku-badge">#{{ $product->product_number }}</span>
                    
                    <div class="product-image-container">
                        <img class="product-image" src="{{ $product->image ?? 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=600' }}" alt="{{ $product->product_name }}" loading="lazy">
                        <div class="product-image-overlay"></div>
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
                            <span>Select Portion</span>
                            <span class="unit-type">{{ $product->unit_type ?? 'Standard' }}</span>
                        </div>
                        
                        <div class="unit-selector">
                            <div class="unit-pill active" 
                                 data-label="{{ $product->unit_value }} {{ $product->unit_type }}" 
                                 data-multiplier="1.0"
                                 onclick="selectUnit({{ $product->id }}, this)">
                                {{ $product->unit_value }} {{ $product->unit_type }}
                            </div>
                        </div>
                        
                        <div class="purchase-controls">
                            <div class="quantity-selector">
                                <button class="qty-btn" type="button" onclick="adjustQty({{ $product->id }}, -1)" aria-label="Decrease Quantity">
                                    <i data-lucide="minus" style="width: 14px; height: 14px;"></i>
                                </button>
                                <input class="qty-input" type="text" id="qty-{{ $product->id }}" value="1" readonly>
                                <button class="qty-btn" type="button" onclick="adjustQty({{ $product->id }}, 1)" aria-label="Increase Quantity">
                                    <i data-lucide="plus" style="width: 14px; height: 14px;"></i>
                                </button>
                            </div>
                            <button class="add-to-cart-btn" type="button" onclick="addToCart({{ $product->id }})">
                                <i data-lucide="shopping-cart" style="width: 16px; height: 16px;"></i>
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

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

    <footer>
        <div class="footer-logo">
            <div class="badge">SK</div>
            <div class="text">Suresh Kumar</div>
        </div>
        <p style="max-width: 500px; margin: 0 auto 1.5rem auto; line-height: 1.6;">Providing bespoke strategic advisory and wellness solutions to elevate personal and professional growth.</p>
        <div class="footer-copyright">
            &copy; {{ date('Y') }} Suresh Kumar. All Rights Reserved. Designed in premium dark mode.
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Product Catalog Data Map parsed dynamically from Eloquent models for JS actions
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

        window.addEventListener('scroll', () => {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        const cartToggle = document.getElementById('cartToggle');
        const closeCart = document.getElementById('closeCart');
        const cartOverlay = document.getElementById('cartOverlay');

        cartToggle.addEventListener('click', () => {
            cartOverlay.classList.add('open');
        });
        closeCart.addEventListener('click', () => {
            cartOverlay.classList.remove('open');
        });
        cartOverlay.addEventListener('click', (e) => {
            if (e.target === cartOverlay) {
                cartOverlay.classList.remove('open');
            }
        });

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
            const qty = parseInt(qtyInput.value) || 1;
            const priceDisplay = document.getElementById(`price-display-${productId}`);
            const dynamicPrice = product.basePrice * product.selectedMultiplier * qty;
            priceDisplay.textContent = dynamicPrice.toFixed(2);
        }

        function adjustQty(productId, amount) {
            const qtyInput = document.getElementById(`qty-${productId}`);
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
            const quantityToAdd = parseInt(qtyInput.value) || 1;
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
            qtyInput.value = 1;
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
            const itemNodes = container.querySelectorAll('.cart-item');
            itemNodes.forEach(node => node.remove());

            let totalCartUnits = 0;
            let subtotal = 0;

            if (cart.length === 0) {
                emptyState.style.display = 'flex';
                badgeCount.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
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
                badgeCount.textContent = totalCartUnits;
                badgeCount.style.display = 'flex';
            }
            subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
            totalEl.textContent = `$${subtotal.toFixed(2)}`;
            lucide.createIcons();
        }

        function showNotification(productName, portion, qty) {
            const container = document.getElementById('toastContainer');
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
</body>
</html>