helpers = ["Principal amount must be a non-negative number.",
               "Yearly interest rate must be non-negative and in decimal format (e.g., 0.08).",
               "Loan term must be in months and in integer format.",
               "Loan term must be at least 1 month.",
               "This box provides advice on filling out the form on this page. Put the mouse cursor over any input field to get advice."]

function messages(index) {
   document.getElementById("adviceBox").value = helpers[index]
}

function Calculate(principal, interest, term) {
    principal = document.getElementById("principal").value
    interest = document.getElementById("interest").value
    term = document.getElementById("term").value

    if (isNaN(principal) || principal < 0 || principal == "") {
        alert(helpers[0])
        return
    }

    if (isNaN(interest) || interest < 0 || interest > 1 ) {
        alert(helpers[1])
        return
    }

    if (isNaN(term) || term % 1 != 0) {
        alert(helpers[2])
        return
    }

    else if (0 < term < 1) {
        alert(helpers[3])
        return
    }

    principal = parseInt(principal)
    interest = parseFloat(interest)
    term = parseInt(term)
    interest = interest/12

    if (interest == 0) {
        monthlyPayment = principal/term
        totalPayment = principal
        totalInterest = 0
    }

    else {
        monthlyPayment = ((principal * interest)/(1 - (1/(1 + interest)**term)))
        totalPayment = (monthlyPayment * term)
        totalInterest = ((monthlyPayment * term) - principal)
    }

    document.getElementById("monthly").innerText = "Monthly payment | $" + monthlyPayment.toFixed(2)
    document.getElementById("total").innerText = "Sum of all payments | $" + totalPayment.toFixed(2)
    document.getElementById("totalInterest").innerText = "Total interest paid | $" + totalInterest.toFixed(2)
}

function Clear () {
    document.getElementById("monthly").innerText = "Monthly payment |"
    document.getElementById("total").innerText = "Sum of all payments |"
    document.getElementById("totalInterest").innerText = "Total interest paid |"
}