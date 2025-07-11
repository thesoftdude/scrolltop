/* Scroll to Top Plugin - Source File */
(function() {    
    // Get settings from the backend (injected by PHP)
    const settings = window.scrolltopSettings || {
        // Enable/disable
        enabled: true,
        
        // Button appearance
        buttonText: '↑',
        buttonColor: '#222222',
        buttonHoverColor: '#444444',
        textColor: '#ffffff',
        buttonSize: 48,
        opacity: 0.7,
        hoverOpacity: 1.0,
        borderRadius: '50%',
        boxShadow: '0 2px 8px rgba(0,0,0,0.2)',
        zIndex: 9999,
        
        // Position and spacing
        position: 'bottom-right',
        bottomDistance: 30,
        rightDistance: 30,
        
        // Behavior
        scrollThreshold: 200,
        enableAnimation: true,
        animationSpeed: 'smooth',
        
        // Icon options
        iconType: 'arrow',
        customSvg: '',
    };

    // Don't create button if disabled
    if (!settings.enabled) {
        return;
    }

    // Icon definitions
    const icons = {
        arrow: '↑',
        chevron: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>',
        doubleArrow: '⇑',
        triangle: '▲',
        caret: '⌃',
        arrowUp: '↑',
        chevronUp: '⌃',
        home: '⌂',
        top: 'TOP'
    };

    // Create button
    const btn = document.createElement('button');
    btn.id = 'scrolltop-btn';
    
    // Set button content based on icon type
    if (settings.iconType === 'custom' && settings.customSvg) {
        btn.innerHTML = settings.customSvg;
    } else if (settings.iconType === 'text') {
        btn.innerHTML = settings.buttonText;
    } else if (icons[settings.iconType]) {
        btn.innerHTML = icons[settings.iconType];
    } else {
        btn.innerHTML = settings.buttonText;
    }
    
    document.body.appendChild(btn);

    // Apply styles
    btn.style.position = 'fixed';
    btn.style.width = settings.buttonSize + 'px';
    btn.style.height = settings.buttonSize + 'px';
    btn.style.border = 'none';
    btn.style.borderRadius = settings.borderRadius;
    btn.style.background = settings.buttonColor;
    btn.style.color = settings.textColor;
    btn.style.fontSize = (settings.buttonSize * 0.4) + 'px';
    btn.style.boxShadow = settings.boxShadow;
    btn.style.cursor = 'pointer';
    btn.style.zIndex = settings.zIndex;
    btn.style.opacity = settings.opacity;
    btn.style.transition = 'opacity 0.2s, background 0.2s';
    btn.style.display = 'none'; // Start hidden
    btn.style.alignItems = 'center';
    btn.style.justifyContent = 'center';
    btn.style.fontFamily = 'inherit';

    // Position the button
    if (settings.position.includes('bottom')) {
        btn.style.bottom = settings.bottomDistance + 'px';
    } else {
        btn.style.top = settings.bottomDistance + 'px';
    }
    
    if (settings.position.includes('right')) {
        btn.style.right = settings.rightDistance + 'px';
    } else {
        btn.style.left = settings.rightDistance + 'px';
    }

    // Hover effects
    btn.addEventListener('mouseenter', function() {
        btn.style.opacity = settings.hoverOpacity;
        btn.style.background = settings.buttonHoverColor;
    });

    btn.addEventListener('mouseleave', function() {
        btn.style.opacity = settings.opacity;
        btn.style.background = settings.buttonColor;
    });

    // Scroll detection
    window.addEventListener('scroll', function () {
        const shouldShow = window.scrollY > settings.scrollThreshold;
        btn.style.display = shouldShow ? 'flex' : 'none';
    });

    // Click to scroll
    btn.addEventListener('click', function () {
        if (settings.enableAnimation) {
            let behavior = 'smooth';
            if (settings.animationSpeed === 'fast') {
                behavior = 'auto';
            } else if (settings.animationSpeed === 'slow') {
                scrollToTopSlow();
                return;
            }
            window.scrollTo({ top: 0, behavior: behavior });
        } else {
            window.scrollTo(0, 0);
        }
    });

    // Custom slow scroll function
    function scrollToTopSlow() {
        const scrollStep = -window.scrollY / (1000 / 15); // 1000ms duration
        const scrollInterval = setInterval(function() {
            if (window.scrollY !== 0) {
                window.scrollBy(0, scrollStep);
            } else {
                clearInterval(scrollInterval);
            }
        }, 15);
    }

    // Initial check (in case page is already scrolled)
    if (window.scrollY > settings.scrollThreshold) {
        btn.style.display = 'flex';
    }
})(); 