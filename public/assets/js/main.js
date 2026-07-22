/* -------------------------------------------------------------
 * Main JS Script for Ghoza Himma Al Farizqi Portfolio
 * Vanilla JS implementations of interactive website features
 * ------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', () => {
    // 1. PAGE LOADER INITIALIZATION
    const loader = document.getElementById('page-loader');
    if (loader) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                loader.classList.add('fade-out');
            }, 300); // Small delay to feel smooth
        });
        
        // Fallback in case window load event already fired
        if (document.readyState === 'complete') {
            setTimeout(() => {
                loader.classList.add('fade-out');
            }, 300);
        }
    }

    // 2. LIGHT / DARK THEME MANAGER (Dark Default)
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = themeToggleBtn ? themeToggleBtn.querySelector('i') : null;
    const currentTheme = localStorage.getItem('theme') || 'dark';

    // Apply initial theme
    document.documentElement.setAttribute('data-theme', currentTheme);
    updateThemeIcon(currentTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const activeTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }

    function updateThemeIcon(theme) {
        if (!themeIcon) return;
        if (theme === 'dark') {
            themeIcon.className = 'bi bi-sun-fill';
            themeIcon.setAttribute('aria-hidden', 'true');
        } else {
            themeIcon.className = 'bi bi-moon-fill';
            themeIcon.setAttribute('aria-hidden', 'true');
        }
    }

    // 3. STICKY NAVBAR SHADOW, SCROLL STATES & SCROLL SPY
    const navbar = document.querySelector('.navbar-custom');
    const backToTopBtn = document.getElementById('back-to-top');
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    // Scroll Spy active indicator tracking
    function scrollSpy() {
        let currentSectionId = '';
        const scrollPosition = window.scrollY + 100; // offset for nav bar height

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            link.classList.remove('active');
            link.removeAttribute('aria-current');
            if (currentSectionId && (href.endsWith('#' + currentSectionId) || href === '#' + currentSectionId)) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');
            }
        });
    }

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            if (navbar) navbar.classList.add('scrolled');
            if (backToTopBtn) backToTopBtn.classList.add('show');
        } else {
            if (navbar) navbar.classList.remove('scrolled');
            if (backToTopBtn) backToTopBtn.classList.remove('show');
        }
        
        // Trigger counters when scrolled into view
        checkCounters();
        
        // Trigger scroll spy active indicator
        scrollSpy();
    });

    // Run once on load to set initial state
    scrollSpy();

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // 4. TYPING ANIMATION (Vanilla JS)
    const typingElement = document.getElementById('typing-text');
    if (typingElement) {
        let words = ['Laravel Backend APIs', 'Flutter Mobile Products', 'Telemetry IoT Systems'];
        try {
            const attrWords = typingElement.getAttribute('data-words');
            if (attrWords) {
                const parsed = JSON.parse(attrWords);
                if (Array.isArray(parsed) && parsed.length > 0) {
                    words = parsed;
                }
            }
        } catch (e) {
            console.warn('Could not parse data-words for typing effect:', e);
        }
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 100;

        function type() {
            const currentWord = words[wordIndex];
            
            if (isDeleting) {
                typingElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
                typeSpeed = 40; // Deleting is faster
            } else {
                typingElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
                typeSpeed = 100; // Typing speed
            }

            if (!isDeleting && charIndex === currentWord.length) {
                // Pause at completion
                typeSpeed = 1800;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 400; // Pause before typing next word
            }

            setTimeout(type, typeSpeed);
        }

        // Start type script
        setTimeout(type, 800);
    }

    // 5. ANIMATED COUNTERS (Stat numbers)
    const counters = document.querySelectorAll('.counter-value');
    let countersAnimated = false;

    function checkCounters() {
        if (countersAnimated || counters.length === 0) return;

        const triggerHeight = window.innerHeight * 0.85;
        const rect = counters[0].getBoundingClientRect();

        if (rect.top < triggerHeight) {
            countersAnimated = true;
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 1200; // Animation duration in ms (snappier)
                const increment = target / (duration / 16); // 16ms per frame approx

                let currentValue = 0;
                const updateCounter = () => {
                    currentValue += increment;
                    if (currentValue < target) {
                        counter.textContent = Math.ceil(currentValue);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                updateCounter();
            });
        }
    }
    
    // Initial run check in case stats are already in view
    checkCounters();

    // 6. PORTFOLIO FILTERING (with server-side compatibility)
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const href = button.getAttribute('href');
            if (href) {
                return; // Allow standard link-based page reload for server-side pagination & filter queries
            }

            e.preventDefault();

            filterButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-selected', 'false');
            });
            button.classList.add('active');
            button.setAttribute('aria-selected', 'true');

            const filterValue = (button.getAttribute('data-filter') || '').toLowerCase();

            projectItems.forEach(item => {
                const techTags = (item.getAttribute('data-tech') || '').toLowerCase();
                const isFeatured = item.getAttribute('data-featured') === 'true';
                
                if (filterValue === 'all') {
                    item.classList.remove('hidden');
                } else if (filterValue === 'featured') {
                    if (isFeatured) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                } else if (techTags.includes(filterValue)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });

    // 7. PROJECT DETAILS MODAL BINDING WITH CASE STUDIES (Problem, Solution, Result & Gallery)
    const projectModal = document.getElementById('projectModal');
    if (projectModal) {
        projectModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            if (!button) return;
            
            // Extract details from data-* attributes
            const title = button.getAttribute('data-title');
            const role = button.getAttribute('data-role');
            const duration = button.getAttribute('data-duration');
            const shortDesc = button.getAttribute('data-short-desc');
            const description = button.getAttribute('data-desc');
            const problem = button.getAttribute('data-problem') || 'No problem statement defined.';
            const solution = button.getAttribute('data-solution') || 'No solution description defined.';
            const result = button.getAttribute('data-result') || 'No result metrics defined.';
            const image = button.getAttribute('data-img');
            const github = button.getAttribute('data-github');
            const demo = button.getAttribute('data-demo');
            const url = button.getAttribute('data-url');
            const tech = JSON.parse(button.getAttribute('data-tech') || '[]');
            const features = JSON.parse(button.getAttribute('data-features') || '[]');
            const gallery = JSON.parse(button.getAttribute('data-gallery') || '[]');

            // Update modal title, image, role, duration, description
            projectModal.querySelector('.modal-title').textContent = title;
            projectModal.querySelector('#modal-project-img').src = image;
            projectModal.querySelector('#modal-project-role').textContent = role || 'Developer';
            projectModal.querySelector('#modal-project-duration').textContent = duration || 'N/A';
            
            // Short desc wrap
            const shortDescWrap = projectModal.querySelector('#modal-project-short-desc-wrap');
            const shortDescElem = projectModal.querySelector('#modal-project-short-desc');
            if (shortDescWrap && shortDescElem) {
                if (shortDesc) {
                    shortDescElem.textContent = shortDesc;
                    shortDescWrap.style.display = 'block';
                } else {
                    shortDescWrap.style.display = 'none';
                }
            }

            projectModal.querySelector('#modal-project-desc').textContent = description;
            
            // Render Case Study Blocks safely
            const problemElem = projectModal.querySelector('#modal-project-problem');
            if (problemElem) problemElem.textContent = problem;
            const solutionElem = projectModal.querySelector('#modal-project-solution');
            if (solutionElem) solutionElem.textContent = solution;
            const resultElem = projectModal.querySelector('#modal-project-result');
            if (resultElem) resultElem.textContent = result;

            // Render Gallery Images
            const galleryWrap = projectModal.querySelector('#modal-project-gallery-wrap');
            const galleryContainer = projectModal.querySelector('#modal-project-gallery');
            if (galleryWrap && galleryContainer) {
                galleryContainer.innerHTML = '';
                if (Array.isArray(gallery) && gallery.length > 0) {
                    gallery.forEach(imgUrl => {
                        const imgFrame = document.createElement('div');
                        imgFrame.style.cssText = 'width: 90px; height: 60px; border-radius: 6px; overflow: hidden; border: 1px solid var(--border-color); cursor: pointer;';
                        imgFrame.innerHTML = `<img src="${imgUrl}" style="width: 100%; height: 100%; object-fit: cover;">`;
                        imgFrame.addEventListener('click', () => {
                            projectModal.querySelector('#modal-project-img').src = imgUrl;
                        });
                        galleryContainer.appendChild(imgFrame);
                    });
                    galleryWrap.style.display = 'block';
                } else {
                    galleryWrap.style.display = 'none';
                }
            }

            // Render Tech Tags (with toggle support)
            const techContainer = projectModal.querySelector('#modal-project-tech');
            techContainer.innerHTML = '';
            techContainer.className = 'project-tech-tags mb-0 toggle-tech-stack';
            techContainer.style.cursor = 'pointer';
            const techLimit = 4;
            tech.forEach((t, index) => {
                const span = document.createElement('span');
                span.className = 'project-tech-badge';
                if (index >= techLimit) {
                    span.classList.add('hidden-tech', 'd-none');
                }
                span.textContent = t;
                techContainer.appendChild(span);
            });
            if (tech.length > techLimit) {
                const moreSpan = document.createElement('span');
                moreSpan.className = 'project-tech-badge tech-more-badge';
                moreSpan.textContent = `+${tech.length - techLimit}`;
                techContainer.appendChild(moreSpan);
            }

            // Render Features list
            const featuresContainer = projectModal.querySelector('#modal-project-features');
            featuresContainer.innerHTML = '';
            features.forEach(f => {
                const li = document.createElement('li');
                li.textContent = f;
                featuresContainer.appendChild(li);
            });

            // Render Links
            const githubBtn = projectModal.querySelector('#modal-github-link');
            if (github && github !== '#') {
                githubBtn.href = github;
                githubBtn.style.display = 'inline-flex';
            } else {
                githubBtn.style.display = 'none';
            }

            const demoBtn = projectModal.querySelector('#modal-demo-link');
            if (demo && demo !== '#') {
                demoBtn.href = demo;
                demoBtn.style.display = 'inline-flex';
            } else {
                demoBtn.style.display = 'none';
            }

            const detailBtn = projectModal.querySelector('#modal-detail-link');
            if (detailBtn) {
                if (url) {
                    detailBtn.href = url;
                    detailBtn.style.display = 'inline-flex';
                } else {
                    detailBtn.style.display = 'none';
                }
            }
        });
    }

    // 8. TOAST NOTIFICATION UTILITY
    const customToast = document.getElementById('toast-container');
    
    function showToast(message, isSuccess = true) {
        if (!customToast) return;
        
        const toast = document.createElement('div');
        toast.className = 'toast-custom show';
        if (!isSuccess) {
            toast.style.borderLeftColor = 'var(--color-red-500)';
        }
        
        const iconClass = isSuccess ? 'bi bi-check-circle-fill text-success' : 'bi bi-exclamation-triangle-fill text-danger';
        
        toast.innerHTML = `
            <i class="${iconClass}" aria-hidden="true"></i>
            <div class="toast-body-text" style="font-size: 0.85rem; font-weight: 600;">${message}</div>
        `;
        
        customToast.appendChild(toast);

        // Slide down and fade out after 4 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 4000);
    }

    // 9. AJAX CONTACT FORM SUBMISSION
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Clear previous errors
            const inputs = contactForm.querySelectorAll('.form-control-custom');
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
                const feedback = input.parentNode.querySelector('.invalid-feedback');
                if (feedback) feedback.remove();
            });

            // Submit states
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...`;

            // Prepare Data
            const formData = new FormData(contactForm);
            
            fetch(contactForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => {
                return response.json().then(data => ({
                    status: response.status,
                    body: data
                }));
            })
            .then(res => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;

                if (res.status === 200 || res.status === 201) {
                    // Success!
                    showToast(res.body.message, true);
                    contactForm.reset();
                } else if (res.status === 422) {
                    // Validation Errors
                    const errors = res.body.errors;
                    Object.keys(errors).forEach(key => {
                        const input = contactForm.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            const feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback';
                            feedback.style.display = 'block';
                            feedback.style.fontSize = '0.75rem';
                            feedback.textContent = errors[key][0];
                            input.parentNode.appendChild(feedback);
                        }
                    });
                    showToast("Please fix the validation errors in the form.", false);
                } else {
                    // Other Server Errors
                    showToast(res.body.message || "An unexpected error occurred. Please try again later.", false);
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                showToast("Connection error. Please check your network and try again.", false);
                console.error('Submit Error:', error);
            });
        });
    }

    // Scroll Down Indicator click
    const scrollDownBtn = document.getElementById('scroll-down-indicator');
    if (scrollDownBtn) {
        scrollDownBtn.addEventListener('click', () => {
            const targetSection = document.getElementById('about');
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // Global event delegator for toggle-tech-stack click
    document.addEventListener('click', (e) => {
        const container = e.target.closest('.toggle-tech-stack');
        if (container) {
            const moreBadge = container.querySelector('.tech-more-badge');
            const hiddenBadges = container.querySelectorAll('.hidden-tech');
            if (moreBadge && !moreBadge.classList.contains('d-none')) {
                e.stopPropagation();
                hiddenBadges.forEach(badge => badge.classList.remove('d-none'));
                moreBadge.classList.add('d-none');
            }
        }
    });
});
