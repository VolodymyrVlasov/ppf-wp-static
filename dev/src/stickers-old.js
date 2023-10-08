const roundSticker = {
    diameter: 50,
    amount: 40,
    targetAmount: 40,
    material: "PAPER_STICKER",
    cutType: "KISS_CUT_A3",
    sheetsAtPrintingRun: 1,
    cutAtPrintingRun: 1,
    stickersAtSheet: 40,
    printPrice: 40,
    cutPrice: 40
}

const CUT_PRICE = {
    INDEX: [],
    KISS_CUT_A4: [],
    KISS_CUT_A3: [],
    DIE_CUT: []
}

const MATERIAL_PRICE = {
    INDEX: [],
    PAPER_STICKER: [],
    PAPER_STICKER_LAMINATED: [],
    PAPER_STICKER_SOFT_TOUCH: [],
    PET_STICKER: [],
    CLEAR_PET_STICKER: [],
    PET_STICKER: [],
    PVC_STICKER: [],
    PVC_CLEAR_STICKER: [],
    PVC_STICKER_LAMINATED: []
}

const PRINT_AREA = {
    KISS_CUT_A4: { x: 300, y: 210, bleed: 1, multiplier: 2 },
    KISS_CUT_A3: { x: 302, y: 428, bleed: 1, multiplier: 1 },
    DIE_CUT: { x: 280, y: 420, bleed: 2, multiplier: 1 }
}

const sizeInput = document.getElementById("size");
const amountInput = document.getElementById("amount");
const materialSelect = document.getElementById("material");
const cutSelect = document.getElementById("cut");

sizeInput.addEventListener("input", (e) => {
    roundSticker.targetAmount = e.target.value;
    {
        amountInput.value = amountInput.step = roundSticker.stickersAtSheet;
    }
})

amountInput.addEventListener("input", () => {
    roundSticker.targetAmount = e.target.value;
})


materialSelect.addEventListener("input", () => {

})

cutSelect.addEventListener("input", () => {

})

class Calculator {
    static stickersAtSheet() {
        // =if((rounddown($D$49/($D40+$F$49*2)) * rounddown($E$49/($D40+$F$49*2))) * $G$49)
        const printArea = PRINT_AREA[roundSticker.cutType];

        roundSticker.stickersAtSheet =
            Math.ceil(printArea.x / (roundSticker.diameter + printArea.bleed * 2)) *
            Math.ceil(printArea.y / (roundSticker.diameter + printArea.bleed * 2)) *
            printArea.multiplier;
    }

    static cutAtSheet() {
        // =roundup(0,00314*D40*K40)

        roundSticker.cutAtSheet =
            Math.ceil(0.00314 * roundSticker.diameter * roundSticker.stickersAtSheet);
    }

    static sheetsInOrder() {
        // =if(I40>0; if(H40>1;roundup(G40/K40) * H40;roundup(G40/K40));1)
    }

    static cutInOrder() {
        // =M40*N40
    }

    static calcPrice() {

    }

    render();
}

function render() {

}