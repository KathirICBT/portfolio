<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suresh Kumar | CMS Admin - Edit Category</title>
    
    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Premium CMS Color Tokens */
        :root {
            --sidebar-bg: #050e1b;
            --main-bg: #081426;
            --card-bg: #0d1b2e;
            --card-bg-hover: #12243d;
            --color-gold: #d9b054;
            --color-gold-muted: rgba(217, 176, 84, 0.15);
            --color-gold-hover: #c5a059;
            --color-text-primary: #ffffff;
            --color-text-muted: #8892b0;
            --color-text-light: #ccd6f6;
            --border-muted: rgba(255, 255, 255, 0.05);
            --border-gold-subtle: rgba(217, 176, 84, 0.15);
            --border-gold-focus: rgba(217, 176, 84, 0.6);
            --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            
            --success-color: #52b788;
            --success-bg: rgba(82, 183, 136, 0.12);
            --danger-color: #e63946;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: var(--main-bg);
            color: var(--color-text-light);
            font-family: var(--font-sans);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        /* ----------------------------------
         * ADMIN SIDEBAR
         * ---------------------------------- */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-muted);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            z-index: 100;
        }
        .sidebar-header {
            padding: 1.5rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid var(--border-muted);
        }
        .logo-badge {
            background: var(--color-gold);
            color: #050e1b;
            font-weight: 700;
            font-size: 1.15rem;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(217, 176, 84, 0.2);
        }
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        .logo-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--color-text-primary);
            letter-spacing: 0.5px;
        }
        .logo-subtitle {
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--color-gold);
            letter-spacing: 1px;
            margin-top: 0.1rem;
        }
        .sidebar-menu {
            padding: 1.5rem 0;
            flex-grow: 1;
            overflow-y: auto;
        }
        .menu-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0 1.5rem 0.5rem 1.5rem;
        }
        .menu-list {
            list-style: none;
            margin-bottom: 1.75rem;
        }
        .menu-item a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1.5rem;
            font-size: 0.88rem;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: var(--transition-smooth);
            border-left: 3px solid transparent;
        }
        .menu-item a:hover {
            color: var(--color-text-primary);
            background: rgba(255, 255, 255, 0.02);
        }
        .menu-item.active a {
            color: var(--color-text-primary);
            background: var(--color-gold-muted);
            border-left-color: var(--color-gold);
            font-weight: 500;
        }
        .menu-item i {
            width: 18px;
            height: 18px;
            opacity: 0.8;
        }
        .menu-item.active i {
            color: var(--color-gold);
            opacity: 1;
        }
        /* ----------------------------------
         * MAIN DASHBOARD AREA
         * ---------------------------------- */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        /* Dash Top Navigation Header */
        .dash-header {
            height: 70px;
            border-bottom: 1px solid var(--border-muted);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgba(8, 20, 38, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .header-title-area {
            display: flex;
            flex-direction: column;
        }
        .header-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }
        .header-subtitle {
            font-size: 0.75rem;
            color: var(--color-text-muted);
            margin-top: 0.15rem;
        }
        .header-controls {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }
        .btn-preview {
            background: transparent;
            border: 1px solid var(--color-gold);
            color: var(--color-gold);
            padding: 0.5rem 1.1rem;
            border-radius: 4px;
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
        }
        .btn-preview:hover {
            background: var(--color-gold);
            color: var(--sidebar-bg);
            box-shadow: 0 0 15px rgba(217, 176, 84, 0.25);
        }
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
        }
        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--color-gold);
            color: #050e1b;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }
        .profile-name {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--color-text-primary);
        }
        /* ----------------------------------
         * FORM WORKSPACE
         * ---------------------------------- */
        .workspace {
            padding: 2.25rem 2rem;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .back-link {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: var(--transition-smooth);
            width: fit-content;
        }
        .back-link:hover {
            color: var(--color-gold);
        }
        .form-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-gold-subtle);
            border-radius: 6px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            position: relative;
        }
        .form-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(217, 176, 84, 0.03), transparent 70%);
            border-radius: 6px;
            pointer-events: none;
        }
        .form-title {
            font-family: var(--font-sans);
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--color-text-primary);
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 1rem;
        }
        /* Form Inputs */
        .form-group {
            margin-bottom: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--color-text-light);
            letter-spacing: 0.2px;
        }
        .form-label span.required {
            color: var(--danger-color);
            margin-left: 0.15rem;
        }
        .form-input, .form-textarea, .form-select {
            width: 100%;
            background: rgba(5, 14, 27, 0.6);
            border: 1px solid var(--border-gold-subtle);
            border-radius: 4px;
            padding: 0.75rem 1rem;
            color: var(--color-text-primary);
            font-family: var(--font-sans);
            font-size: 0.88rem;
            outline: none;
            transition: var(--transition-smooth);
        }
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            border-color: var(--color-gold);
            background: rgba(5, 14, 27, 0.9);
            box-shadow: 0 0 10px rgba(217, 176, 84, 0.15);
        }
        .form-textarea {
            resize: vertical;
            min-height: 120px;
            line-height: 1.5;
        }
        .form-desc-tip {
            font-size: 0.75rem;
            color: var(--color-text-muted);
            margin-top: 0.15rem;
        }
        /* Custom Icon Grid Selector */
        .icon-grid-selector {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 0.5rem;
            margin-top: 0.25rem;
        }
        .icon-option {
            background: rgba(5, 14, 27, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--color-text-muted);
            height: 46px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-smooth);
        }
        .icon-option:hover {
            border-color: rgba(217, 176, 84, 0.4);
            color: var(--color-gold);
        }
        .icon-option.selected {
            background: var(--color-gold-muted);
            border-color: var(--color-gold);
            color: var(--color-gold);
            box-shadow: 0 0 10px rgba(217, 176, 84, 0.1);
        }
        /* Modern Slider Switch Toggle */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(5, 14, 27, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.02);
            padding: 1rem 1.25rem;
            border-radius: 4px;
            margin-top: 0.5rem;
        }
        .toggle-info {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }
        .toggle-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }
        .toggle-desc {
            font-size: 0.75rem;
            color: var(--color-text-muted);
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 26px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: var(--color-text-muted);
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: var(--color-gold-muted);
            border-color: var(--color-gold);
        }
        input:checked + .slider:before {
            transform: translateX(22px);
            background-color: var(--color-gold);
        }
        /* Action Buttons Row */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 2rem;
            margin-top: 2.5rem;
        }
        .btn-cancel {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--color-text-light);
            padding: 0.65rem 1.5rem;
            border-radius: 4px;
            font-family: var(--font-sans);
            font-weight: 500;
            font-size: 0.85rem;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition-smooth);
        }
        .btn-cancel:hover {
            border-color: rgba(255, 255, 255, 0.2);
            color: var(--color-text-primary);
            background: rgba(255, 255, 255, 0.02);
        }
        .btn-gold {
            background: var(--color-gold);
            color: #050e1b;
            border: none;
            padding: 0.65rem 1.6rem;
            border-radius: 4px;
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(217, 176, 84, 0.2);
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-gold:hover {
            background: var(--color-gold-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(217, 176, 84, 0.35);
        }
        /* Responsive */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR PANEL -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-badge">SK</div>
            <div class="logo-text">
                <span class="logo-title">Suresh Kumar</span>
                <span class="logo-subtitle">CMS ADMIN</span>
            </div>
        </div>
        <div class="sidebar-menu">
            <span class="menu-section-label">Overview</span>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="#dashboard">
                        <i data-lucide="layout-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
            <span class="menu-section-label">Content</span>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="#hero-sliders">
                        <i data-lucide="sliders"></i>
                        <span>Hero Sliders</span>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="{{ route('categories.index') }}">
                        <i data-lucide="folder-tree"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#services">
                        <i data-lucide="sparkles"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#testimonials">
                        <i data-lucide="message-square"></i>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#profiles">
                        <i data-lucide="users"></i>
                        <span>Network Profiles</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#logos">
                        <i data-lucide="shield-check"></i>
                        <span>Clients & Logos</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#gallery">
                        <i data-lucide="image"></i>
                        <span>Gallery</span>
                    </a>
                </li>
            </ul>
            <span class="menu-section-label">Pages</span>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="#sections">
                        <i data-lucide="layout"></i>
                        <span>Page Sections</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#counters">
                        <i data-lucide="bar-chart-3"></i>
                        <span>Stats & Counters</span>
                    </a>
                </li>
            </ul>
            <span class="menu-section-label">Assets</span>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="#media">
                        <i data-lucide="images"></i>
                        <span>Media Library</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- MAIN RIGHT CONTAINER -->
    <div class="main-content">
        <!-- TOP CONTROL BAR -->
        <header class="dash-header">
            <div class="header-title-area">
                <h1 class="header-title">Store Categories</h1>
                <span class="header-subtitle">Edit classification taxonomy settings</span>
            </div>
            <div class="header-controls">
                <a href="#shop-preview" class="btn-preview" target="_blank">
                    <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                    <span>Preview Site</span>
                </a>
                <div class="admin-profile">
                    <div class="profile-avatar">S</div>
                    <span class="profile-name">Suresh Kumar</span>
                    <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: var(--color-text-muted);"></i>
                </div>
            </div>
        </header>
        <!-- FORM WORKSPACE -->
        <main class="workspace">
            <!-- Back Navigation -->
            <a href="{{ route('categories.index') }}" class="back-link">
                <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i>
                <span>Back to List</span>
            </a>
            <!-- Form Card Container -->
            <div class="form-card">
                <h2 class="form-title">Edit Category</h2>
                <!-- Pre-populated dynamic form fields mapped to active Laravel model category -->
                <form action="{{ route('categories.update', $category->id) }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    <!-- Name Field -->
                    <div class="form-group">
                        <label class="form-label" for="category_name">
                            Category Name <span class="required">*</span>
                        </label>
                        <input class="form-input" type="text" name="name" id="category_name" value="{{ $category->name }}" placeholder="e.g. Organic Syrups" required autocomplete="off">
                        <span class="form-desc-tip">The visible display name of the product category.</span>
                    </div>
                    <!-- Slug Field -->
                    <div class="form-group">
                        <label class="form-label" for="category_slug">
                            Category Slug <span class="required">*</span>
                        </label>
                        <input class="form-input" type="text" name="slug" id="category_slug" value="{{ $category->slug }}" placeholder="e.g. organic-syrups" required>
                        <span class="form-desc-tip">URL slug used for clean navigation links (auto-generates from name).</span>
                    </div>
                    <!-- Icon Grid Selector -->
                    <div class="form-group">
                        <label class="form-label">
                            Display Icon
                        </label>
                        <input type="hidden" name="image" id="selected_icon" value="{{ $category->image ?? 'package' }}">
                        <div class="icon-grid-selector">
                            <div class="icon-option {{ ($category->image ?? 'package') == 'package' ? 'selected' : '' }}" data-icon="package" title="Package"><i data-lucide="package"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'droplet' ? 'selected' : '' }}" data-icon="droplet" title="Droplet"><i data-lucide="droplet"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'coffee' ? 'selected' : '' }}" data-icon="coffee" title="Coffee"><i data-lucide="coffee"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'leaf' ? 'selected' : '' }}" data-icon="leaf" title="Leaf"><i data-lucide="leaf"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'award' ? 'selected' : '' }}" data-icon="award" title="Award"><i data-lucide="award"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'sparkles' ? 'selected' : '' }}" data-icon="sparkles" title="Sparkles"><i data-lucide="sparkles"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'wine' ? 'selected' : '' }}" data-icon="wine" title="Wine/Glass"><i data-lucide="wine"></i></div>
                            <div class="icon-option {{ ($category->image ?? '') == 'box' ? 'selected' : '' }}" data-icon="box" title="Box"><i data-lucide="box"></i></div>
                        </div>
                        <span class="form-desc-tip">Choose a visual icon representing this taxonomy on catalog grids.</span>
                    </div>
                    <!-- Description Field -->
                    <div class="form-group">
                        <label class="form-label" for="category_description">
                            Description
                        </label>
                        <textarea class="form-textarea" name="description" id="category_description" placeholder="Provide a summary explaining the types of products included...">{{ $category->description }}</textarea>
                        <span class="form-desc-tip">Brief overview detailing this category's catalog items for SEO descriptions.</span>
                    </div>
                    <!-- Active Toggle Switch -->
                    <div class="form-group">
                        <label class="form-label">Visibility Status</label>
                        <div class="toggle-row">
                            <div class="toggle-info">
                                <span class="toggle-title">Publish Status</span>
                                <span class="toggle-desc">Active categories are publicly visible on storefront collection listings.</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="status" value="active" id="status_checkbox" {{ ($category->status ?? 'active') == 'active' ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="form-actions">
                        <a href="{{ route('categories.index') }}" class="btn-cancel">Cancel</a>
                        <button type="submit" class="btn-gold">
                            <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <!-- Interactivity scripts -->
    <script>
        // Init Lucide
        lucide.createIcons();
        // Autogenerate URL Slug from Category Name
        const nameInput = document.getElementById('category_name');
        const slugInput = document.getElementById('category_slug');
        nameInput.addEventListener('input', () => {
            const val = nameInput.value;
            slugInput.value = val
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_]+/g, '-')
                .replace(/^-+|-+$/g, '');
        });
        // Custom Icon Selection Logic
        const iconOptions = document.querySelectorAll('.icon-option');
        const selectedIconInput = document.getElementById('selected_icon');
        iconOptions.forEach(opt => {
            opt.addEventListener('click', () => {
                iconOptions.forEach(el => el.classList.remove('selected'));
                opt.classList.add('selected');
                
                const iconName = opt.getAttribute('data-icon');
                selectedIconInput.value = iconName;
            });
        });
    </script>
</body>
</html>
