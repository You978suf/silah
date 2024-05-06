// Add an event listener to the entire container to handle click events.
document.querySelector('.container').addEventListener('click', function(event) {
    // Check if the clicked element is a button and its ID ends with '_addToCart'
    if (event.target.tagName === 'BUTTON' && event.target.id.endsWith('_addToCart')) {     
        const priceColumn = event.target.parentNode; // Get the parent node of the clicked button, which is the column containing the plan details.
        const planName = priceColumn.querySelector('p').textContent; // Extract the name of the plan from the paragraph element in the column.
        var planPrice = parseFloat(priceColumn.querySelector('h3').textContent.replace('$', '')); // Extract and convert the price of the plan from the header element, removing the dollar sign.
        sessionStorage.setItem('selectedPlan', planName); // Store the selected plan name in sessionStorage.
        sessionStorage.setItem('selectedPrice', planPrice); // Store the selected plan price in sessionStorage.
        window.location.href = 'checkout.html'; // Redirect the user to the checkout page.
    }
});

// Add an event listener to a specific button for displaying a discount challenge.
document.getElementById('recieveDis').addEventListener('click', function() {
    displayDiscountProblem(); // Call the function to display the discount modal.
});

// Function to display the discount modal with a math question based on the selected plan.
function displayDiscountProblem() {
    var imageUrl;
    // Determine the image to display in the modal based on the selected plan stored in sessionStorage.
    switch (sessionStorage.getItem('selectedPlan')) {
        case "Student":
            imageUrl = "studentProblem.png"; // Image path for the student plan.
            break;
        case "Premium":
            imageUrl = "premiumProblem.jpg"; // Image path for the premium plan.
            break;
        case "Professional":
            imageUrl = "professionalProblem.png"; // Image path for the professional plan.
            break;
    }
    document.getElementById('mathQuestionImage').src = imageUrl; // Set the source of the image element to the selected image URL.
    document.getElementById('discountModal').style.display = 'block'; // Display the modal by changing its style to block.
}

// Function attached to the close button inside the modal for hiding it.
document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('discountModal').style.display = "none"; // Hide the modal by changing its display style to none.
}

// Function to submit the answer entered by the user and apply a discount if correct.
function submitAnswer() {
    var userAnswer = document.getElementById('answerInput').value.trim(); // Get the user's answer and trim whitespace.
    var correctAnswer; // Variable to hold the correct answer.
    var discountPercentage; // Variable to hold the discount percentage.
    var responseMessage; // Variable to hold the response message to the user.
    var selectedPlan = sessionStorage.getItem('selectedPlan'); // Retrieve the selected plan from sessionStorage.
    var selectedPrice = parseFloat(sessionStorage.getItem('selectedPrice')); // Retrieve the selected price from sessionStorage and convert it to a float.

    // Determine the correct answer and discount based on the selected plan.
    switch (selectedPlan) {
        case "Student":
            correctAnswer = "3"; // Correct answer for student plan.
            discountPercentage = 0.10; // 10% discount.
            break;
        case "Premium":
            if (userAnswer === "cosx" || userAnswer === "cos(x)") {
                correctAnswer = userAnswer; // Dynamic correct answer allowing for two variations.
                discountPercentage = 0.50; // 50% discount.
            }
            break;
        case "Professional":
            correctAnswer = null; // No correct answer possible for the professional plan.
            break;
    }

    // Check the user's answer against the correct answer and update the response accordingly.
    if (correctAnswer === null) {
        responseMessage = "ويييييييو رح رح. باغي تخفيض باغي"; // Message for an impossible question.
    } else if (userAnswer === correctAnswer) {
        responseMessage = "Correct answer! Discount applied."; // Successful discount application message.
        selectedPrice *= discountPercentage; // Apply the discount by multiplying the price by the discount percentage.
        document.getElementById('selectedPrice').textContent = 'Price: $' + selectedPrice.toFixed(2); // Update the displayed price.
    } else {
        responseMessage = "Incorrect answer, please try again."; // Message for incorrect answer.
    }

    alert(responseMessage); // Show an alert box with the response message.
    document.getElementById('discountModal').style.display = "none"; // Hide the discount modal.
}