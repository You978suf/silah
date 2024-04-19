
document.querySelector('.container').addEventListener('click', function(event) {
    if (event.target.tagName === 'BUTTON' && event.target.id.endsWith('_addToCart')) {     
        const priceColumn = event.target.parentNode;
        const planName = priceColumn.querySelector('p').textContent;
        var planPrice = parseFloat(priceColumn.querySelector('h3').textContent.replace('$', ''));
        sessionStorage.setItem('selectedPlan', planName);
        sessionStorage.setItem('selectedPrice', planPrice);
        window.location.href = 'checkout.html';
    }
});
document.getElementById('recieveDis').addEventListener('click', function() {
    displayDiscountProblem();
});

function displayDiscountProblem() {
    var imageUrl;
    switch (selectedPlan) {
        case "Student":
            imageUrl = "studentProblem.png"; // Path to the image for student plan
            break;
        case "Premium":
            imageUrl = "premiumProblem.jpg"; // Path to the image for premium plan
            break;
        case "Professional":
            imageUrl = "professionalProblem.png"; // Path to the image for professional plan (impossible question)
            break;
        default:
            break;
    }
    document.getElementById('mathQuestionImage').src = imageUrl;
    document.getElementById('discountModal').style.display = 'block';
}

// Close the modal when the user clicks on <span> (x)
document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('discountModal').style.display = "none";
}

function submitAnswer() {
    var userAnswer = document.getElementById('answerInput').value.trim();
    var correctAnswer;
    var discountPercentage;
    var responseMessage;
    var selectedPlan = sessionStorage.getItem('selectedPlan');
    var selectedPrice = parseFloat(sessionStorage.getItem('selectedPrice'));

    switch (selectedPlan) {
        case "Student":
            correctAnswer = "3";
            discountPercentage = 0.10; // 90% discount
            break;
        case "Premium":
            if (userAnswer === "cosx" || userAnswer === "cos(x)") {
                correctAnswer = userAnswer; // Accepting the user's input if it matches either
                discountPercentage = 0.50; // 50% discount
            }
            break;
        case "Professional":
            correctAnswer = null; // Impossible to solve
            break;
        default:
            correctAnswer = "undefined"; // No plan selected
            discountPercentage = 1; // No discount
            break;
    }

    if (correctAnswer === null) {
        responseMessage = "ويييييييو رح رح. باغي تخفيض باغي";
    } else if (userAnswer === correctAnswer) {
        responseMessage = "Correct answer! Discount applied.";
        selectedPrice *= discountPercentage; // Apply discount
        document.getElementById('selectedPrice').textContent = 'Price: $' + selectedPrice.toFixed(2); // Update the display
    } else {
        responseMessage = "Incorrect answer, please try again.";
    }

    alert(responseMessage);
    document.getElementById('discountModal').style.display = "none";
}


