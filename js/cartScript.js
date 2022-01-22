function caseCount(caseId, val, subTotalId, unitPriceId){

    console.log(caseId);

    const caseCount = document.getElementById(caseId);
    const caseCountValueUnParse = caseCount.value;
    const caseCountValue = parseInt(caseCountValueUnParse);
    if(caseCountValue + val < 1){
        caseCountValue = 1;
        val = 0;
    }
    const newCaseCount = caseCountValue + val;
    caseCount.value = newCaseCount;
    updateSubtotalPrice(newCaseCount, unitPriceId, subTotalId);
}

function updateSubtotalPrice(caseCount, unitPriceId, subTotalId){
    const totalPriceUn = document.getElementById("total-price");
    const totalPriceUnParse = totalPriceUn.innerText;
    let totalPrice = parseInt(totalPriceUnParse);

    const subtotalPriceUn = document.getElementById(subTotalId);
    const subtotalPriceUnParse = subtotalPriceUn.innerText;
    const subtotalPrice = parseInt(subtotalPriceUnParse);

    const unitPriceUn = document.getElementById(unitPriceId);
    const unitPriceUnParse = unitPriceUn.innerText;
    const unitPrice = parseInt(unitPriceUnParse);

    totalPrice -= subtotalPrice;
    const newSubtotal = caseCount * unitPrice;
    subtotalPriceUn.innerText = newSubtotal;
    totalPrice += newSubtotal;
    totalPriceUn.innerText = totalPrice;
}