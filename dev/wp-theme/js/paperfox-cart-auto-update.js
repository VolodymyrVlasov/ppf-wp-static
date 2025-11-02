(function () {
    function getCartContentElement() {
        return document.querySelector('[data-cart-content]');
    }

    function bindQuantityListeners(root) {
        if (!root) {
            return;
        }

        root.querySelectorAll('.cart_item_quantity .qty').forEach(function (input) {
            input.removeEventListener('change', handleQuantityChange);
            input.addEventListener('change', handleQuantityChange);
        });

        root.querySelectorAll('[data-quantity-button]').forEach(function (button) {
            button.removeEventListener('click', handleQuantityButton);
            button.addEventListener('click', handleQuantityButton);
        });
    }

    function handleQuantityButton(event) {
        var button = event.currentTarget;
        var quantityContainer = button.closest('[data-cart-quantity]');

        if (!quantityContainer) {
            return;
        }

        var input = quantityContainer.querySelector('.qty');

        if (!input) {
            return;
        }

        var direction = button.getAttribute('data-quantity-button');

        if (direction === 'minus') {
            input.stepDown();
        } else {
            input.stepUp();
        }

        input.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function createLoaderMarkup() {
        var label = (PAPERFOX_CART && PAPERFOX_CART.loading_label) ? PAPERFOX_CART.loading_label : '';
        return '<span class="cart_price_loader" aria-hidden="true"></span>' +
            '<span class="screen-reader-text">' + label + '</span>';
    }

    function applyLoadingState(cartItemElement, wrapper) {
        var loaderMarkup = createLoaderMarkup();
        var affected = [];

        if (cartItemElement) {
            var itemPrice = cartItemElement.querySelector('.cart_item_price');
            if (itemPrice) {
                affected.push({ element: itemPrice, previous: itemPrice.innerHTML });
                itemPrice.innerHTML = loaderMarkup;
                itemPrice.classList.add('is-loading');
            }
        }

        if (wrapper) {
            wrapper.querySelectorAll('.cart_summary_card .woocommerce-Price-amount').forEach(function (amountEl) {
                affected.push({ element: amountEl, previous: amountEl.innerHTML });
                amountEl.innerHTML = loaderMarkup;
                amountEl.classList.add('is-loading');
            });
        }

        return affected;
    }

    function restorePricesOnError(affected) {
        if (!affected || !affected.length) {
            return;
        }

        affected.forEach(function (item) {
            if (!item.element) {
                return;
            }
            item.element.innerHTML = item.previous;
            item.element.classList.remove('is-loading');
        });
    }

    function handleQuantityChange(event) {
        if (typeof PAPERFOX_CART === 'undefined') {
            return;
        }

        var input = event.target;
        var wrapper = getCartContentElement();
        var cartItemElement = input.closest('[data-cart-item]');

        if (!cartItemElement) {
            return;
        }

        var cartItemKey = cartItemElement.getAttribute('data-cart-item');
        var quantity = input.value;

        if (!cartItemKey) {
            return;
        }

        if (quantity === '') {
            return;
        }

        if (wrapper) {
            wrapper.classList.add('is-updating');
        }

        var affectedElements = applyLoadingState(cartItemElement, wrapper);

        var formData = new FormData();
        formData.append('action', 'paperfox_update_cart_item');
        formData.append('cart_item_key', cartItemKey);
        formData.append('quantity', quantity);
        formData.append('nonce', PAPERFOX_CART.nonce);

        fetch(PAPERFOX_CART.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData,
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Network error');
                }
                return response.json();
            })
            .then(function (payload) {
                if (!payload || !payload.success || !payload.data || !payload.data.html) {
                    throw new Error(payload && payload.data && payload.data.message ? payload.data.message : 'Invalid response');
                }
                replaceCartContent(payload.data.html, payload.data.notices);
                if (window.jQuery) {
                    window.jQuery(document.body).trigger('wc_fragment_refresh').trigger('updated_wc_div');
                }
            })
            .catch(function (error) {
                console.error(error);
                restorePricesOnError(affectedElements);
                alert(PAPERFOX_CART.error_text);
            })
            .finally(function () {
                var updatedWrapper = getCartContentElement();
                if (updatedWrapper) {
                    updatedWrapper.classList.remove('is-updating');
                }
            });
    }

    function replaceCartContent(html, noticesHtml) {
        var parser = new DOMParser();
        var doc = parser.parseFromString(html, 'text/html');
        var newContent = doc.querySelector('[data-cart-content]');
        var current = getCartContentElement();

        if (!newContent || !current) {
            return;
        }

        current.replaceWith(newContent);
        bindQuantityListeners(newContent);

        if (typeof noticesHtml === 'string') {
            updateNotices(noticesHtml);
        }
    }

    function updateNotices(noticesHtml) {
        var container = document.querySelector('.paperfox-cart-section .woocommerce-notices-wrapper');
        var trimmed = noticesHtml.trim();

        if (container) {
            if (trimmed) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(noticesHtml, 'text/html');
                var newNotices = doc.querySelector('.woocommerce-notices-wrapper');
                if (newNotices) {
                    container.replaceWith(newNotices);
                } else {
                    container.innerHTML = '';
                }
            } else {
                container.innerHTML = '';
            }
        } else if (trimmed) {
            var sectionContainer = document.querySelector('.paperfox-cart-section .container');
            if (sectionContainer) {
                sectionContainer.insertAdjacentHTML('afterbegin', trimmed);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof PAPERFOX_CART === 'undefined') {
            return;
        }

        var wrapper = getCartContentElement();
        bindQuantityListeners(wrapper);
    });
})();
