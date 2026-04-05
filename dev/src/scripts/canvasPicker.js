console.log("canvasPicker.js");

const MATERIAL_KEYS = ['cotton', 'cotton-lak', 'syntetic-glossy', 'syntetic'];

const DEFAULT_MATERIAL = 'cotton-lak';
const DEFAULT_SIZE = '40х60';

const product = {
    material: DEFAULT_MATERIAL,
    size: DEFAULT_SIZE,
};

// ─── DOM refs ──────────────────────────────────────────────────────────────
const selectMaterial = document.getElementById('canvas-material');
const selectSize = document.getElementById('canvas-size');
const priceLabel = document.getElementById('canvas-price-label');
const canvasImage = document.getElementById('canvas-image');
const productLink = document.getElementById('canvas-product-link');
const calculator = document.getElementById('canvas-calculator');
const loader = calculator.closest('.relative')?.querySelector('.loader');

// ─── Helpers ───────────────────────────────────────────────────────────────
function findProduct(data) {
    const list = data[product.material] ?? [];
    return list.find(p => p.size === product.size) ?? null;
}

function updateUI(data) {
    const found = findProduct(data);
    if (!found) return;

    product.price = found.price;
    product.image = found.image;
    product.productLink = found.productLink;

    priceLabel.textContent = `${found.price} ₴`;
    canvasImage.src = found.image;
    productLink.href = found.productLink;

    console.log('product:', { ...product });
}

function populateSizes(data) {
    const list = data[product.material] ?? [];
    const sizes = list.map(p => p.size);

    selectSize.innerHTML = sizes
        .map(s => `<option value="${s}"${s === DEFAULT_SIZE ? ' selected' : ''}>${s} см</option>`)
        .join('');

    // якщо поточний розмір присутній у новому списку — лишаємо, інакше перший
    product.size = sizes.includes(product.size) ? product.size : (sizes[0] ?? '');
    selectSize.value = product.size;
}

function populateMaterials(data) {
    selectMaterial.innerHTML = MATERIAL_KEYS
        .map(key => {
            const label = data[key]?.[0]?.material ?? key;
            return `<option value="${key}"${key === DEFAULT_MATERIAL ? ' selected' : ''}>${label}</option>`;
        })
        .join('');
    selectMaterial.value = DEFAULT_MATERIAL;
}

// ─── Init ──────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const startTime = Date.now();

    fetch('./products.json')
        .then(res => {
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            return res.json();
        })
        .then(data => {
            populateMaterials(data);
            populateSizes(data);
            updateUI(data);

            const elapsed = Date.now() - startTime;
            const remaining = Math.max(0, 500 - elapsed);
            setTimeout(() => {
                loader?.classList.add('hidden');
                console.log("hidden", loader);
            }, 500);

            // ─── Single delegated listener ──────────────────────────────────
            calculator.addEventListener('change', e => {
                switch (e.target.id) {

                    case 'canvas-material':
                        product.material = e.target.value;
                        console.log('canvas-material:', product.material);
                        populateSizes(data);
                        break;

                    case 'canvas-size':
                        product.size = e.target.value;
                        console.log('canvas-size:', product.size);
                        break;

                    default:
                        return;
                }

                updateUI(data);
            });
        })
        .catch(err => console.error('canvasPicker: не вдалося завантажити products.json', err));
});
