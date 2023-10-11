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
    INDEX: [1, 5, 10, 20, 40, 50, 100, 200, 400, 500, 1000],
    KISS_CUT_A4: [6, 6, 4, 4, 4, 3, 2.5, 2.5, 2.5, 2.5, 1],
    KISS_CUT_A3: [6, 6, 4, 4, 4, 3, 2.5, 2.5, 2.5, 2.5, 1],
    DIE_CUT: [24, 24, 16, 16, 16, 14, 12, 12, 12, 12, 8,]
}

const MATERIAL_PRICE = {
    INDEX: [1, 5, 10, 20, 40, 50, 100, 200, 400, 500, 1000],
    PAPER_STICKER: [40, 40, 30, 28, 25, 15, 14, 13, 13, 13, 13],
    PAPER_STICKER_LAMINATED: [80, 64, 49, 45, 42, 29, 26, 25, 25, 25, 25],
    PAPER_STICKER_SOFT_TOUCH: [120, 110, 90, 68, 65, 45, 39, 33, 33, 33, 33],
    PET_STICKER: [110, 83, 83, 77, 77, 75, 72, 69, 69, 69, 69],
    CLEAR_PET_STICKER: [115, 85, 85, 79, 79, 76, 74, 71, 71, 71, 71],
    CLEAR_MATT_PET_STICKER: [105, 78, 78, 73, 73, 70, 68, 65, 65, 65, 65],
    PVC_STICKER: [55, 50, 45, 40, 40, 35, 30, 30, 30, 30, 30],
    PVC_CLEAR_STICKER: [55, 50, 45, 40, 40, 35, 30, 30, 30, 30, 30],
    PVC_STICKER_LAMINATED: [125, 90, 85, 80, 80, 70, 60, 60, 60, 60, 60]
}

const CUT_NAMES = {
    KISS_CUT_A4: "Контурна на А4 (порізані по контуру на аркуші)",
    KISS_CUT_A3: "Контурна на А3 (порізані по контуру на аркуші)",
    DIE_CUT: "Кожна наліпка окремо"
}

const MATERIAL_NAMES = {
    PAPER_STICKER: "Паперова самоклейка (Raflatac)",
    PAPER_STICKER_LAMINATED: "Паперова самоклейка з ламінацією",
    PAPER_STICKER_SOFT_TOUCH: "Паперова самоклейка з ламінацією SoftTouch",
    PET_STICKER: "ПЕТ самоклейка (Raflatac)",
    CLEAR_PET_STICKER: "Прозора ПЕТ (Raflatac)",
    CLEAR_MATT_PET_STICKER: "Крафтова самоклейка (Raflatac)",
    PVC_STICKER: "Вінілова самоклейка (Ritrama)",
    PVC_CLEAR_STICKER: "Вінілова самоклейка (Ritrama)",
    PVC_STICKER_LAMINATED: "Вінілова самоклейка з ламінацією"
}

const PRINT_AREA = {
    KISS_CUT_A4: { x: 300, y: 210, bleed: 1, multiplier: 2 },
    KISS_CUT_A3: { x: 302, y: 428, bleed: 1, multiplier: 1 },
    DIE_CUT: { x: 280, y: 410, bleed: 2, multiplier: 1 }
}

const sizeInput = document.getElementById("rcal_size");
const amountInput = document.getElementById("rcal_amount");
const materialSelect = document.getElementById("rcal_material");
const cutSelect = document.getElementById("rcal_cut");
const sizeLabel = document.getElementById("size_label");
const amountLabel = document.getElementById("amount_label");
const resultCnt = document.getElementById("rcal_result");
const copyButton = document.getElementById("copy_to_clipboard_btn");

sizeInput.addEventListener("input", e => {
    roundSticker.diameter = Number(e.target.value);
    render();
})

sizeInput.addEventListener("change", e => {
    roundSticker.diameter = Number(e.target.value);
    setTimeout(() => {

        amountInput.value = roundSticker.stickersAtSheet;
        amountLabel.innerHTML = `Кількість: ${roundSticker.stickersAtSheet} шт`;

    }, 0);
    Calculator.calculate();
})

amountInput.addEventListener("input", e => {
    roundSticker.targetAmount = Number(e.target.value);
    Calculator.calculate();
})

materialSelect.addEventListener("change", e => {
    roundSticker.material = e.target.value;
    Calculator.calculate();
})

cutSelect.addEventListener("change", e => {
    roundSticker.cutType = e.target.value;
    Calculator.calculate();
})

copyButton.addEventListener("click", e => {

    let resultText = `
        - ${MATERIAL_NAMES[roundSticker.material]}
        - Кругла діаметр ${roundSticker.diameter} мм.
        - Порізка: ${CUT_NAMES[roundSticker.cutType]}
        - Кількість: ${roundSticker.amount} шт.
        - Друк (${roundSticker.sheetsAtPrintingRun} арк.) - ${roundSticker.printPrice} грн, порізка (${roundSticker.cutAtPrintingRun} м.п.) - ${roundSticker.cutPrice} грн.`;

    if (navigator.clipboard) {
        navigator.clipboard.writeText(resultText).then(function () {
            copyButton.innerText = "Параметри копійовані!"
        }).catch(function (err) {
            copyButton.innerText = "Не вдалось скопіюавати"
        });
    } else {
        console.error('Clipboard API not supported in this browser/environment.');
    }

    setTimeout(() => {
        copyButton.innerText = "Скопіювати обрані параметри!"
    }, 3000);
})

class Calculator {
    static calcStickersAtSheet() {
        // =if((rounddown($D$49/($D40+$F$49*2)) * rounddown($E$49/($D40+$F$49*2))) * $G$49)
        const printArea = PRINT_AREA[roundSticker.cutType];

        roundSticker.stickersAtSheet =
            Math.floor(printArea.x / (roundSticker.diameter + printArea.bleed * 2)) *
            Math.floor(printArea.y / (roundSticker.diameter + printArea.bleed * 2)) *
            printArea.multiplier;
        amountInput.step = roundSticker.stickersAtSheet;
        amountInput.min = roundSticker.stickersAtSheet;
        amountInput.max = roundSticker.stickersAtSheet * 200;
    }

    static calcCutAtSheet() {
        // =roundup(0,00314*D40*K40)
        roundSticker.cutAtSheet =
            Math.ceil(0.00314 * roundSticker.diameter * roundSticker.stickersAtSheet);
    }

    static calcSheetsInOrder() {
        // =if(I40>0; if(H40>1;roundup(G40/K40) * H40;roundup(G40/K40));1)
        roundSticker.sheetsAtPrintingRun =
            Math.ceil(roundSticker.targetAmount / roundSticker.stickersAtSheet);

        roundSticker.amount = roundSticker.sheetsAtPrintingRun * roundSticker.stickersAtSheet;
    }

    static calcCutInOrder() {
        // =M40*N40
        roundSticker.cutAtPrintingRun =
            roundSticker.cutAtSheet * roundSticker.sheetsAtPrintingRun;
    }

    static calculate() {
        Calculator.calcStickersAtSheet();
        Calculator.calcCutAtSheet();
        Calculator.calcSheetsInOrder();
        Calculator.calcCutInOrder();

        let i = CUT_PRICE.INDEX.reverse().findIndex(element => roundSticker.cutAtPrintingRun >= element)
        let j = MATERIAL_PRICE.INDEX.reverse().findIndex(element => {
            console.log("test");

            if (roundSticker.sheetsAtPrintingRun >= element) {
                return true;
            }
            return false;
        })

        roundSticker.cutPrice = CUT_PRICE[roundSticker.cutType][i] * roundSticker.cutAtPrintingRun;
        roundSticker.printPrice = MATERIAL_PRICE[roundSticker.material][j] * roundSticker.sheetsAtPrintingRun;
        // console.log(MATERIAL_PRICE[roundSticker.material], j, MATERIAL_PRICE[roundSticker.material][j]);
        render(MATERIAL_PRICE[roundSticker.material][j]);
    }
}

function render() {
    sizeLabel.innerHTML = `Діаметр: ${roundSticker.diameter} мм`;
    amountLabel.innerHTML = `Кількість: ${roundSticker.amount} шт`;
    resultCnt.innerHTML = `
    <span style="font-size: 24px">Вартість: ${roundSticker.printPrice + roundSticker.cutPrice} грн.<br>
    <span style="font-size: 14px">(Друк: ${roundSticker.sheetsAtPrintingRun} арк. - ${roundSticker.printPrice} грн., порізка: ${roundSticker.cutAtPrintingRun} м.п. - ${roundSticker.cutPrice} грн.)</span></span>`

}